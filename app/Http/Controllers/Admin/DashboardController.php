<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Language;
use App\Models\News;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalNews = News::where(['status' => 1, 'is_approved' => 1])->count();
        $pendingNews = News::where(['status' => 1, 'is_approved' => 0])->count();
        $totalCategories = Category::count();
        $totalLanguages = Language::count();
        return view('admin.dashboard.index', compact('totalNews', 'pendingNews', 'totalCategories', 'totalLanguages'));
    }
}