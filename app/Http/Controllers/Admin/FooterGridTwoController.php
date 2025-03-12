<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminFooterGridTwoStoreRequest;
use App\Models\FooterGridTwo;
use App\Models\FooterTitle;
use App\Models\Language;
use Illuminate\Http\Request;

class FooterGridTwoController extends Controller
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
        return view('admin.footer-grid-two.index', compact('langs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $langs = Language::latest()->get();
        return view('admin.footer-grid-two.create', compact('langs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminFooterGridTwoStoreRequest $request)
    {
        FooterGridTwo::create([
            'lang' => $request->lang,
            'name' => $request->name,
            'url' => $request->url,
            'status' => $request->status,
        ]);

        toast(__('admin.Created Successfully'),'success')->width(350);

        return redirect()->route('admin.footer-grid-two.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $langs = Language::latest()->get();
        $footerGridTwo = FooterGridTwo::findOrFail($id);
        return view('admin.footer-grid-two.edit', compact('footerGridTwo', 'langs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $footerGridTwo = FooterGridTwo::findOrFail($id);
        $footerGridTwo->update([
            'lang' => $request->lang,
            'name' => $request->name,
            'url' => $request->url,
            'status' => $request->status,
        ]);

        toast(__('admin.Updated Successfully'),'success')->width(350);

        return redirect()->route('admin.footer-grid-two.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $footerGridTwo = FooterGridTwo::findOrFail($id);
            $footerGridTwo->delete();

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
                'key' => 'grid_title_two',
                'lang' => $request->lang
            ],[
                'value' => $request->value
            ]

        );

        toast(__('admin.Updated Successfully'),'success')->width(350);

        return redirect()->route('admin.footer-grid-two.index');
    }
}
