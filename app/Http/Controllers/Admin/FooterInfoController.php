<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterInfo;
use App\Models\Language;
use App\Traits\FileUpdateTrait;
use Illuminate\Http\Request;

class FooterInfoController extends Controller
{
    use FileUpdateTrait;
    public function __construct()
    {
        // Sử dụng middleware 'auth:admin' trước
        $this->middleware('auth:admin');

        $this->middleware(['permission:footer setting index'])->only('index');
        $this->middleware(['permission:footer setting create'])->only(['store']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $langs = Language::all();
        return view('admin.footer-info.index', compact('langs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|max:3000',
            'description' => 'required|max:300',
            'copyright' => 'required|max:255'
        ]);

        $footerInfo = FooterInfo::where('lang' , $request->lang)->first();
        $imagePath = $this->handleFileUpdate($request, 'logo', is_null($footerInfo) ? null : $footerInfo->logo );
        FooterInfo::updateOrCreate(
            ['lang' => $request->lang],
            [
                'logo' => !empty($imagePath) ? $imagePath : $footerInfo->logo,
                'description' => $request->description,
                'copyright' => $request->copyright,
                'lang' => $request->lang
            ]
        );


        toast(__('admin.Updated Successfully'),'success')->width(350);

        return redirect()->route('admin.footer-info.index');
    }
}
