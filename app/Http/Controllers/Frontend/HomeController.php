<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\About;
use App\Models\Ad;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\HomeSectionSetting;
use App\Models\News;
use App\Models\RecivedMail;
use App\Models\SocialCount;
use App\Models\SocialLink;
use App\Models\Subscriber;
use App\Models\Tag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index()
    {
        $breakingNews = News::with(['category', 'author'])->where([
            'is_breaking_news' => 1,
        ])->activeEntries()->withLanguage()->latest()->get();

        $heroSliders = News::with(['category', 'author'])->where('show_at_slider', 1)
        ->activeEntries()->withLanguage()
        ->orderBy('id', 'desc')->take(7)->get();

        $recentNews = News::with(['category', 'author'])->activeEntries()->withLanguage()
        ->orderBy('id', 'desc')->take(6)->get();

        $popularNews = News::with(['category'])->where('show_at_popular', 1)->activeEntries()->withLanguage()
        ->orderBy('updated_at', 'desc')->take(4)->get();

        $homeSectionSetting = HomeSectionSetting::where('lang', getLanguage())->first();
        $categorySectionOnes = News::where('category_id', $homeSectionSetting->category_section_one)->activeEntries()->withLanguage()->orderBy('id', 'desc')->take(8)->get();
        $categorySectionTwos = News::where('category_id', $homeSectionSetting->category_section_two)->activeEntries()->withLanguage()->orderBy('id', 'desc')->take(8)->get();
        $categorySectionThrees = News::where('category_id', $homeSectionSetting->category_section_three)->activeEntries()->withLanguage()->orderBy('id', 'desc')->take(8)->get();
        $categorySectionFours = News::where('category_id', $homeSectionSetting->category_section_four)->activeEntries()->withLanguage()->orderBy('id', 'desc')->take(8)->get();
        $mostViewed = News::activeEntries()->withLanguage()->orderBy('view', 'desc')->take(3)->get();

        $socialCounts = SocialCount::where(['status' => 1, 'lang' => getLanguage()])->orderBy('id','desc')->get();
        $mostCommonTag = $this->mostCommonTag();

        $ads = Ad::first();

        return view('frontend.home',
                compact(
                    'breakingNews',
                    'heroSliders',
                    'recentNews',
                    'popularNews',
                    'categorySectionOnes',
                    'categorySectionTwos',
                    'categorySectionThrees',
                    'categorySectionFours',
                    'mostViewed',
                    'socialCounts',
                    'mostCommonTag',
                    'ads'
            ));
    }

    public function showDetails($slug)
    {
        $news = News::with(['author', 'category', 'tags', 'comments'])->where(['slug' => $slug])->activeEntries()->withLanguage()->orderByDesc('id')->first();
        $recentNews = News::with(['author', 'category', 'tags'])->where('slug', '!=', $slug)->activeEntries()->withLanguage()->latest()->take(4)->get();
        $this->countView($news);

        $mostCommonTag = $this->mostCommonTag();

        $nextNews = News::where('id', '>', $news->id)
        ->orderBy( 'id', 'asc')->activeEntries()->withLanguage()
        ->first();

        $prevNews = News::where('id', '<', $news->id)
        ->orderBy('id', 'desc')->activeEntries()->withLanguage()
        ->first();

        $relatedNews = News::where('slug', '!=', '$slug')->where('category_id', $news->category_id)->activeEntries()->withLanguage()->take(5)->get();

        $socialCounts = SocialCount::where(['status' => 1, 'lang' => getLanguage()])->orderBy('id','desc')->get();

        $ads = Ad::first();

        return view('frontend.news-details', compact('news', 'recentNews', 'mostCommonTag', 'nextNews', 'prevNews', 'relatedNews', 'socialCounts', 'ads'));
    }

    public function news(Request $request): View
    {
        $news = News::query();

        $news->when($request->has('category') && !empty($request->category), function($query) use ($request){
            $query->whereHas('category', function($query) use($request){
                $query->where('slug', $request->category);
            });
        });

        $news->when($request->has('search'), function($query) use ($request){
            $query->where(function($query) use ($request) {
                $query->where('title', 'like', '%'.$request->search.'%')
                ->orWhere('content', 'like', '%'.$request->search.'%');
            })->orWhereHas('category', function($query) use ($request) {
                $query->where('name', 'like', '%'.$request->search.'%');
            });
        });

        $news->when($request->has('tag'), function($query) use ($request){
            $query->whereHas('tags', function($query) use ($request){
                $query->where('name', $request->tag);
            });
        });

        $news = $news->activeEntries()->withLanguage()->paginate(6);

        $recentNews = News::with(['author', 'category'])->activeEntries()->withLanguage()->latest()->take(4)->get();

        $mostCommonTag = $this->mostCommonTag();

        $categories = Category::where(['status' => 1, 'lang' => getLanguage()])->orderBy('id','desc')->get();

        $ads = Ad::first();

        return view('frontend.news', compact('news', 'recentNews', 'mostCommonTag', 'categories', 'ads'));
    }

    public function about()
    {
        $about = About::where('lang', getLanguage())->first();
        return view('frontend.about', compact('about'));
    }

    public function contact()
    {
        $contact = Contact::where('lang', getLanguage())->first();
        $socialLinks = SocialLink::where('status', 1)->orderBy('id', 'desc')->get();
        return view('frontend.contact', compact('contact', 'socialLinks'));
    }

    //hàm đếm lượt view của bài viết, đảm bảo trong 1 phiên session sẽ chỉ lưu 1 view
    public function countView($news)
    {
        if(session()->has('viewed_posts')){
            $postIds = session('viewed_posts');

            if(!is_null($news) && !in_array($news->id, $postIds )){
                $postIds[] = $news->id;
                $news->increment('view');
            }

            session(['viewed_posts' => $postIds]);

        }else{
            session(['viewed_posts' => [$news->id]]);

            $news->increment('view');
        }
    }

    public function mostCommonTag()
    {
        return Tag::where('lang', getLanguage())
        ->withCount('news') // đếm số bản ghi news có liên quan
        ->orderByDesc('news_count') //sắp xếp từ lớn tới nhỏ theo thứ tự cột news_count do withCount tao ra
        ->get();
    }

    public function handleComment(Request $request)
    {
        $request->validate([
            'comment' => ['required', 'string', 'max:1000']
        ]);

        Comment::create([
            'comment' => $request->comment,
            'news_id' => $request->news_id,
            'parent_id' => $request->parent_id,
            'user_id' => Auth::user()->id,
        ]);
        toast(__('frontend.Comment Successfully'),'success')->width(350);

        return redirect()->back();
    }

    public function handleCommentReplay(Request $request)
    {
        $request->validate([
            'comment' => ['required', 'string', 'max:1000']
        ]);

        Comment::create([
            'comment' => $request->comment,
            'news_id' => $request->news_id,
            'parent_id' => $request->parent_id,
            'user_id' => Auth::user()->id,
        ]);
        toast(__('frontend.Comment Successfully'),'success')->width(350);

        return redirect()->back();
    }

    public function deleteComment(Request $request)
    {

        $cmt = Comment::findOrFail($request->id);

        if(Auth::user()->id = $cmt->user_id) {
            $cmt->delete();

            return response()->json([
                'status' => 'success',
                'message' => __('frontend.Deleted success!')
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => __('frontend.Something went wrong!')
        ]);
    }

    //handle submit news  letter
    public function subscribeNewsLetter(Request $request)
    {
        $request->validate(
            ['email' => 'required|email|max:255|unique:subscribers,email'],
            ['email:unique' => 'Email is already subscribed!']
        );

        Subscriber::create([
            'email' => $request->email,
        ]);

        return response()->json(['status' => 'success','message'=> __('frontend.Subscribed successfully!')]);
    }

    //handle contact email
    public function contactEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'subject' => 'required|max:255',
            'message' => 'required',
        ]);

        RecivedMail::create([
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        try{
            $contact = Contact::where('lang', 'en')->first();
            Mail::to($contact->email)->send(new ContactMail($request->subject, $request->message, $request->email));

            toast(__('frontend.Mail send successfully!'),'success')->width(350);

            return redirect()->back();
        }catch(Exception $e){
            toast(__($e->getMessage()),'error')->width(350);

            return redirect()->back();
        }
    }
}