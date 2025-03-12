<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminNewsCreateRequest;
use App\Http\Requests\AdminNewsUpdateRequest;
use App\Models\Category;
use App\Models\Language;
use App\Models\News;
use App\Models\Tag;
use App\Traits\FileUpdateTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    use FileUpdateTrait;
    public function __construct()
    {
        // Sử dụng middleware 'auth:admin' trước
        $this->middleware('auth:admin');

        $this->middleware(['permission:news index'])->only(['index', 'copyNews', 'toggleStatus']);
        $this->middleware(['permission:news create'])->only(['create', 'store']);
        $this->middleware(['permission:news update'])->only(['edit', 'update']);
        $this->middleware(['permission:news delete'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $langs = Language::all();
        return view('admin.news.index', compact('langs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $langs = Language::latest()->get();
        return view('admin.news.create', compact('langs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminNewsCreateRequest $request)
    {
        //handle image
        $imagePath = $this->handleFileUpdate($request, 'image');

        $news = News::create([
            'lang' => $request->lang,
            'category_id' => $request->category_id,
            'auther_id' => Auth::guard('admin')->user()->id,
            'image' => $imagePath,
            'title' => $request->title,
            'slug' => \Str::slug($request->title),
            'content' => $request->content,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'is_breaking_news' => $request->is_breaking_news == 1 ? 1 : 0,
            'show_at_slider' => $request->show_at_slider == 1 ? 1 : 0,
            'show_at_popular' => $request->show_at_popular == 1 ? 1 : 0,
            'status' => $request->status == 1 ? 1 : 0,
        ]);

        $tags = explode(',', $request->tags);
        $tagIds = [];

        foreach($tags as $tag) {
            $item = Tag::create([
                'name' => $tag,
                'lang' => $request->lang,
            ]);

            $tagIds[] = $item->id;
        }

        $news->tags()->attach($tagIds);

        toast(__('admin.Created Successfully'),'success')->width(350);

        return redirect()->route('admin.news.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $langs = Language::latest()->get();
        $news = News::findOrFail($id);
        $categories = Category::where('lang', $news->lang)->latest()->get();
        return view('admin.news.edit', compact('langs', 'news', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminNewsUpdateRequest $request, string $id)
    {
        $news = News::findOrFail($id);
        //handle image
        $imagePath = $this->handleFileUpdate($request, 'image');

        $news->update([
            'lang' => $request->lang,
            'category_id' => $request->category_id,
            'image' => !empty($imagePath) ? $imagePath : $news->image,
            'title' => $request->title,
            'slug' => \Str::slug($request->title),
            'content' => $request->content,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'is_breaking_news' => $request->is_breaking_news == 1 ? 1 : 0,
            'show_at_slider' => $request->show_at_slider == 1 ? 1 : 0,
            'show_at_popular' => $request->show_at_popular == 1 ? 1 : 0,
            'status' => $request->status == 1 ? 1 : 0,
        ]);

        $tags = explode(',', $request->tags);
        $tagIds = [];

        foreach ($tags as $tag) {
            $item = Tag::firstOrCreate(['name' => $tag, 'lang' => $request->lang]);
            $tagIds[] = $item->id;
        }

        // đồng gội dữ liệu trong bản trung gian
        $news->tags()->sync($tagIds);

        //xóa các record không còn dùng trong bản trung gian
        Tag::doesntHave('news')->delete();

        toast(__('admin.Updated Successfully'),'success')->width(350);

        return redirect()->route('admin.news.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $news = News::findOrFail($id);
            $this->deleteFile($news->image);
            $news->tags()->detach();
            $news->delete();

            Tag::doesntHave('news')->delete();

            return response()->json(['status' => 'success','message'=> __('admin.Deleted success!')]);
        }catch (\Exception $e){
            return response()->json(['status' => 'error','message'=> __('admin.Something went wrong!')]);
        }
    }

    /**
     * Fetch category depending on language
     */
    public function fetchCategory(Request $request)
    {
        $category = Category::where('lang', $request['lang'])->latest()->get();

        return $category;
    }

    public function toggleStatus(Request $request)
    {
        try{
            $news = News::findOrFail($request->id);
            $news->update([
                $request->name => $request->status
            ]);

            return response()->json(['status' => 'success', 'message' => __('admin.Updated status success!')]);
        }catch(Exception $e){
            return response()->json(['status' => 'error', 'message' => __('admin.Something went wrong!')]);
        }
    }

    public function copyNews($id)
    {
        // Bước 1: Tìm bản gốc của News và các thẻ liên kết
        $news = News::findOrFail($id);
        $tags = $news->tags()->pluck('tags.id')->toArray();
        // Bước 2: Tạo bản sao của bản ghi News
        $newNews = $news->replicate();
        $newNews->title .= ' (Copy)';
        // Thêm một số thông tin để phân biệt bản sao
        $newNews->save();
        // Bước 3: Gắn kết các thẻ với bản sao mới của News
        $newNews->tags()->sync($tags);

        return redirect()->back();

    }
}
