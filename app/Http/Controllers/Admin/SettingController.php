<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminGeneralSettingUpdateRequest;
use App\Http\Requests\AdminSEOSettingUpdateRequest;
use App\Models\Setting;
use App\Traits\FileUpdateTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use FileUpdateTrait;
    public function __construct()
    {
        // Sử dụng middleware 'auth:admin' trước
        $this->middleware('auth:admin');

        $this->middleware(['permission:setting index'])->only('index');
        $this->middleware(['permission:setting update'])->only(['generalSettingUpdate', 'seoSettingUpdate', 'colorSettingUpdate']);
    }
    public function index()
    {
        return view('admin.setting.index');
    }

    public function generalSettingUpdate(AdminGeneralSettingUpdateRequest $request): RedirectResponse
    {
        $logoPath = $this->handleFileUpdate($request, 'site_logo');
        $faviconPath = $this->handleFileUpdate($request, 'site_favicon');

        Setting::updateOrCreate(
            ['key' => 'site_name'],
            ['value' => $request->site_name]
        );

        if(!empty($logoPath)){
            Setting::updateOrCreate(
                ['key' => 'site_logo'],
                ['value' => $logoPath]
            );
        }

        if(!empty($faviconPath)){
            Setting::updateOrCreate(
                ['key' => 'site_favicon'],
                ['value' => $faviconPath]
            );
        }

        toast(__('admin.Updated Successfully'),'success')->width(350);

        return redirect()->back();
    }

    public function seoSettingUpdate(AdminSEOSettingUpdateRequest $request) : RedirectResponse
    {
        Setting::updateOrCreate(
            ['key' => 'site_seo_title'],
            ['value' => $request->site_seo_title]
        );

        Setting::updateOrCreate(
            ['key' => 'site_seo_description'],
            ['value' => $request->site_seo_description]
        );

        Setting::updateOrCreate(
            ['key' => 'site_seo_keywords'],
            ['value' => $request->site_seo_keywords]
        );

        toast(__('admin.Updated Successfully'),'success')->width(350);

        return redirect()->back();
    }

    public function colorSettingUpdate(Request $request): RedirectResponse
    {
        $request->validate([
            'site_color' => 'required|max:30',
        ]);
        Setting::updateOrCreate(
            ['key' => 'site_color'],
            ['value' => $request->site_color]
        );

        toast(__('admin.Updated Successfully'),'success')->width(350);

        return redirect()->back();
    }

    public function microsoftApiSettingUpdate(Request $request): RedirectResponse
    {
        $request->validate([
            'site_microsoft_api_host' => 'required',
            'site_microsoft_api_key' => 'required',
        ]);


        Setting::updateOrCreate(
            ['key' => 'site_microsoft_api_host'],
            ['value' => $request->site_microsoft_api_host]
        );

        Setting::updateOrCreate(
            ['key' => 'site_microsoft_api_key'],
            ['value' => $request->site_microsoft_api_key]
        );

        toast(__('admin.Updated Successfully'),'success')->width(350);

        return redirect()->back();
    }
}