<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminSocialCountStoreRequest;
use App\Models\Language;
use App\Models\SocialCount;
use Illuminate\Http\Request;

class SocialCountController extends Controller
{
    public function __construct()
    {
        // Sử dụng middleware 'auth:admin' trước
        $this->middleware('auth:admin');

        $this->middleware(['permission:social count index'])->only('index');
        $this->middleware(['permission:social count create'])->only(['create', 'store']);
        $this->middleware(['permission:social count update'])->only(['edit', 'update']);
        $this->middleware(['permission:social count delete'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $langs = Language::all();
        return view('admin.social-count.index', compact('langs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $langs = Language::latest()->get();
        return view('admin.social-count.create', compact('langs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminSocialCountStoreRequest $request)
    {
        SocialCount::create([
            'lang' => $request->lang,
            'icon' => $request->icon,
            'fan_count' => $request->fan_count,
            'fan_type' => $request->fan_type,
            'button_text' => $request->button_text,
            'color' => $request->color,
            'url' => $request->url,
            'status' => $request->status,
        ]);

        toast(__('admin.Created Successfully'),'success')->width(350);

        return redirect()->route('admin.social-count.index');


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
        $socialCount = SocialCount::findOrFail($id);
        return view('admin.social-count.edit', compact('socialCount', 'langs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminSocialCountStoreRequest $request, string $id)
    {
        $socialCount = SocialCount::findOrFail($id);
        $socialCount->update([
            'lang' => $request->lang,
            'icon' => $request->icon,
            'fan_count' => $request->fan_count,
            'fan_type' => $request->fan_type,
            'button_text' => $request->button_text,
            'color' => $request->color,
            'url' => $request->url,
            'status' => $request->status,
        ]);

        toast(__('admin.Updated Successfully'),'success')->width(350);

        return redirect()->route('admin.social-count.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $socialCount = SocialCount::findOrFail($id);
            $socialCount->delete();

            return response()->json(['status' => 'success','message'=> __('admin.Deleted success!')]);
        }catch (\Exception $e){
            return response()->json(['status' => 'error','message'=> __('admin.Something went wrong!')]);
        }
    }
}
