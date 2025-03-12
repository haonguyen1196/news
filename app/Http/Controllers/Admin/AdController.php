<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAdUpdateRequest;
use App\Models\Ad;
use App\Traits\FileUpdateTrait;
use Illuminate\Http\Request;

class AdController extends Controller
{
    use FileUpdateTrait;
    public function __construct()
    {
        // Sử dụng middleware 'auth:admin' trước
        $this->middleware('auth:admin');

        $this->middleware(['permission:advertisement index'])->only('index');
        $this->middleware(['permission:advertisement update'])->only(['update']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ads = Ad::first();
        return view('admin.ad.index', compact('ads'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminAdUpdateRequest $request, string $id)
    {
        $home_top_bar_ad = $this->handleFileUpdate($request, 'home_top_bar_ad');
        $home_middle_bar_ad = $this->handleFileUpdate($request, 'home_middle_bar_ad');
        $views_page_ad = $this->handleFileUpdate($request, 'views_page_ad');
        $news_page_ad = $this->handleFileUpdate($request, 'news_page_ad');
        $side_bar_ad = $this->handleFileUpdate($request, 'side_bar_ad');
        $ad = Ad::first();

        Ad::updateOrCreate(
            ['id' => $id],
            [
                'home_top_bar_ad' => !empty($home_top_bar_ad) ? $home_top_bar_ad : $ad->home_top_bar_ad,
                'home_middle_bar_ad' => !empty($home_middle_bar_ad) ? $home_middle_bar_ad : $ad->home_middle_bar_ad,
                'views_page_ad' => !empty($views_page_ad) ? $views_page_ad : $ad->views_page_ad,
                'news_page_ad' => !empty($news_page_ad) ? $news_page_ad : $ad->news_page_ad,
                'side_bar_ad' => !empty($side_bar_ad) ? $side_bar_ad : $ad->side_bar_ad,
                'home_top_bar_ad_status' => $request->home_top_bar_ad_status == 1 ? 1 : 0,
                'home_middle_bar_ad_status' => $request->home_middle_bar_ad_status == 1 ? 1 : 0,
                'views_page_ad_status' => $request->views_page_ad_status == 1 ? 1 : 0,
                'news_page_ad_status' => $request->news_page_ad_status == 1 ? 1 : 0,
                'side_bar_ad_status' => $request->side_bar_ad_status == 1 ? 1 : 0,

                'home_top_bar_ad_url' => $request->home_top_bar_ad_url,
                'home_middle_bar_ad_url' => $request->home_middle_bar_ad_url,
                'views_page_ad_url' => $request->views_page_ad_url,
                'news_page_ad_url' => $request->news_page_ad_url,
                'side_bar_ad_url' => $request->side_bar_ad_url,
            ]
        );

        toast(__('admin.Updated Successfully'),'success')->width(350);

        return redirect()->route('admin.ad.index');
    }
}
