<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminCategoryStoreRequest;
use App\Http\Requests\AdminCategoryUpdateRequest;
use App\Models\Category;
use App\Models\Language;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        // Sử dụng middleware 'auth:admin' trước
        $this->middleware('auth:admin');

        $this->middleware(['permission:category index'])->only('index');
        $this->middleware(['permission:category create'])->only(['create', 'store']);
        $this->middleware(['permission:category update'])->only(['edit', 'update']);
        $this->middleware(['permission:category delete'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $langs = Language::all();
        return view('admin.category.index', compact('langs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $langs = Language::latest()->get();
        return view('admin.category.create', compact('langs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminCategoryStoreRequest $request)
    {
        Category::create([
            'name'=> $request->name,
            'slug' => \Str::slug($request->name),
            'lang' => $request->lang,
            'show_at_nav' => $request->show_at_nav,
            'status' => $request->status,
        ]);

        toast(__('admin.Created Successfully'),'success')->width(350);

        return redirect()->route('admin.category.index');
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
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('langs', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminCategoryUpdateRequest $request, string $id)
    {
        $category = Category::findOrFail($id);
        $category->update([
            'name'=> $request->name,
            'slug' => \Str::slug($request->name),
            'lang' => $request->lang,
            'show_at_nav' => $request->show_at_nav,
            'status' => $request->status,
        ]);

        toast(__('admin.Updated Successfully'),'success')->width(350);

        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $category = Category::findOrFail($id);
            $category->delete();

            return response()->json(['status' => 'success','message'=> __('admin.Deleted success!')]);
        }catch (\Exception $e){
            return response()->json(['status' => 'error','message'=> __('admin.Something went wrong!')]);
        }
    }
}
