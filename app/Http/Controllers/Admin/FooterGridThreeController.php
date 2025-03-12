<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminFooterGridThreeStoreRequest;
use App\Models\FooterGridThree;
use App\Models\FooterTitle;
use App\Models\Language;
use Illuminate\Http\Request;

class FooterGridThreeController extends Controller
{
    public function __construct()
    {
        // Sử dụng middleware 'auth:admin' trước
        $this->middleware('auth:admin');

        $this->middleware(['permission:footer setting index'])->only('index', 'handleTitle');
        $this->middleware(['permission:footer setting create'])->only(['create', 'store']);
        $this->middleware(['permission:footer setting update'])->only(['edit', 'update']);
        $this->middleware(['permission:footer setting delete'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $langs = Language::all();
        return view('admin.footer-grid-three.index', compact('langs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $langs = Language::latest()->get();
        return view('admin.footer-grid-three.create', compact('langs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminFooterGridThreeStoreRequest $request)
    {
        FooterGridThree::create([
            'lang' => $request->lang,
            'name' => $request->name,
            'url' => $request->url,
            'status' => $request->status,
        ]);

        toast(__('admin.Created Successfully'),'success')->width(350);

        return redirect()->route('admin.footer-grid-three.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $langs = Language::latest()->get();
        $footerGridThree = FooterGridThree::findOrFail($id);
        return view('admin.footer-grid-three.edit', compact('footerGridThree', 'langs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $footerGridThree = FooterGridThree::findOrFail($id);
        $footerGridThree->update([
            'lang' => $request->lang,
            'name' => $request->name,
            'url' => $request->url,
            'status' => $request->status,
        ]);

        toast(__('admin.Updated Successfully'),'success')->width(350);

        return redirect()->route('admin.footer-grid-three.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $footerGridThree = FooterGridThree::findOrFail($id);
            $footerGridThree->delete();

            return response()->json(['status' => 'success','message'=> __('admin.Deleted success!')]);
        }catch (\Exception $e){
            return response()->json(['status' => 'error','message'=> __('admin.Something went wrong!')]);
        }
    }

    public function handleTitle(Request $request)
    {
        $request->validate([
            'value' => 'required'
        ]);

        FooterTitle::updateOrCreate(
            [
                'key' => 'grid_title_three',
                'lang' => $request->lang
            ],[
                'value' => $request->value
            ]

        );

        toast(__('admin.Updated Successfully'),'success')->width(350);

        return redirect()->route('admin.footer-grid-three.index');
    }
}
