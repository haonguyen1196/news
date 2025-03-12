<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLanguageStoreRequest;
use App\Http\Requests\AdminLanguageUpdateRequest;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function __construct()
    {
        // Sử dụng middleware 'auth:admin' trước
        $this->middleware('auth:admin');

        $this->middleware(['permission:language index'])->only('index');
        $this->middleware(['permission:language create'])->only(['create', 'store']);
        $this->middleware(['permission:language update'])->only(['edit', 'update']);
        $this->middleware(['permission:language delete'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::latest()->get();
        return view('admin.language.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.language.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminLanguageStoreRequest $request)
    {
        $lang = Language::create([
            'name' => $request->name,
            'lang' => $request->lang,
            'slug' => $request->slug,
            'status' => $request->status,
            'default' => $request->default,
        ]);

        toast(__('admin.Created Successfully'),'success')->width(350);

        return redirect()->route('admin.language.index');
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
        $language = Language::findOrFail($id);
        return view('admin.language.edit', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminLanguageUpdateRequest $request, string $id)
    {
        $lang = Language::findOrFail($id);
        $lang->update([
            'name' => $request->name,
            'lang' => $request->lang,
            'slug' => $request->slug,
            'status' => $request->status,
            'default' => $request->default,
        ]);

        toast(__('admin.Updated Successfully'),'success')->width(350);

        return redirect()->route('admin.language.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $lang = Language::findOrFail($id);
            if($lang->lang == 'en') {
                return response()->json(['status' => 'error', 'message' => __('admin.Can\'t delete this one!')]);
            }
            $lang->delete();

            return response()->json(['status' => 'success','message'=> __('admin.Deleted success!')]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error','message'=> __('admin.Something went wrong!')]);
        }
    }
}
