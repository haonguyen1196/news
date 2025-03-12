<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminHomeSectionSettingUpdateRequest;
use App\Models\HomeSectionSetting;
use App\Models\Language;
use Illuminate\Http\Request;

class HomeSectionSettingController extends Controller
{
    public function __construct()
    {
        // Sử dụng middleware 'auth:admin' trước
        $this->middleware('auth:admin');

        $this->middleware(['permission:home section index'])->only('index');
        $this->middleware(['permission:home section update'])->only(['update']);
    }
    public function index()
    {
        $langs = Language::all();
        return view('admin.home-section-setting.index', compact('langs'));
    }

    public function update(AdminHomeSectionSettingUpdateRequest $request)
    {
        HomeSectionSetting::updateOrCreate( [ 'lang' => $request->lang ],
        [
                    'category_section_one' => $request->category_section_one,
                    'category_section_two' => $request->category_section_two,
                    'category_section_three' => $request->category_section_three,
                    'category_section_four' => $request->category_section_four,
                ]);

        toast(__('admin.Saved Successfully'),'success')->width(350);

        return redirect()->back();
    }
}
