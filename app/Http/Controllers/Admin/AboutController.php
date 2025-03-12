<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Language;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function __construct()
    {
        // Sử dụng middleware 'auth:admin' trước
        $this->middleware('auth:admin');

        $this->middleware(['permission:about index'])->only(['index']);
        $this->middleware(['permission:about update'])->only(['store']);
    }
    public function index()
    {
        $langs = Language::all();
        return view('admin.about-page.index', compact('langs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required'
        ]);

        About::updateOrCreate(
            ['lang' => $request->lang],
            [
                'content' => $request->content
            ]
        );

        toast(__('admin.Updated Successfully'),'success')->width(350);

        return redirect()->route('admin.about.index');
    }
}
