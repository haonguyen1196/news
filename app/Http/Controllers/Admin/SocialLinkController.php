<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminSocialLinkStoreRequest;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function __construct()
    {
        // Sử dụng middleware 'auth:admin' trước
        $this->middleware('auth:admin');

        $this->middleware(['permission:footer setting index'])->only('index');
        $this->middleware(['permission:footer setting create'])->only(['create', 'store']);
        $this->middleware(['permission:footer setting update'])->only(['edit', 'update']);
        $this->middleware(['permission:footer setting delete'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $socialLinks = SocialLink::orderBy('id', 'desc')->get();
        return view("admin.social-link.index", compact('socialLinks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.social-link.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminSocialLinkStoreRequest $request)
    {
        SocialLink::create([
            'icon' => $request->icon,
            'url' => $request->url,
            'status' => $request->status,
        ]);

        toast(__('admin.Created Successfully'),'success')->width(350);

        return redirect()->route('admin.social-link.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $socialLink = SocialLink::findOrFail($id);
        return view('admin.social-link.edit', compact('socialLink'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminSocialLinkStoreRequest $request, string $id)
    {
        $socialLink = SocialLink::findOrFail($id);
        $socialLink->update([
            'icon' => $request->icon,
            'url' => $request->url,
            'status' => $request->status,
        ]);

        toast(__('admin.Updated Successfully'),'success')->width(350);

        return redirect()->route('admin.social-link.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $socialLink = SocialLink::findOrFail($id);
            $socialLink->delete();

            return response()->json(['status' => 'success','message'=> __('admin.Deleted success!')]);
        }catch (\Exception $e){
            return response()->json(['status' => 'error','message'=> __('admin.Something went wrong!')]);
        }
    }
}
