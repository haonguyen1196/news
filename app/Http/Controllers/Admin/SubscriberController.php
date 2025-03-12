<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NewsLetter;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscriberController extends Controller
{
    public function __construct()
    {
        // Sử dụng middleware 'auth:admin' trước
        $this->middleware('auth:admin');

        $this->middleware(['permission:subscriber index'])->only('index');
        $this->middleware(['permission:subscriber create'])->only('store');
        $this->middleware(['permission:subscriber delete'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subs = Subscriber::orderBy("id","desc")->get();
        return view('admin.subscriber.index', compact('subs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|max:255',
            'message' => 'required',
        ]);

        $subscriber = Subscriber::pluck('email')->toArray();

        //sent mail
        Mail::to($subscriber)->send(new NewsLetter($request->subject, $request->message));

        toast(__('admin.Send mail successfully'),'success')->width(350);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $category = Subscriber::findOrFail($id);
            $category->delete();

            return response()->json(['status' => 'success','message'=> __('admin.Deleted success!')]);
        }catch (\Exception $e){
            return response()->json(['status' => 'error','message'=> __('admin.Something went wrong!')]);
        }
    }
}
