<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AdController;
use App\Http\Controllers\Admin\AdminAuthenticationController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ContactMailController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FooterGridOne;
use App\Http\Controllers\Admin\FooterGridOneController;
use App\Http\Controllers\Admin\FooterGridThreeController;
use App\Http\Controllers\Admin\FooterGridTwoController;
use App\Http\Controllers\Admin\FooterInfoController;
use App\Http\Controllers\Admin\HomeSectionSettingController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\LocalizationController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\Admin\RoleUserController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SocialCountController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\SubscriberController;
use DebugBar\DataCollector\LocalizationCollector;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "admin", 'as' => 'admin.'], function () {
    Route::get('login', [AdminAuthenticationController::class,'login'])->name('login');
    Route::post('login', [AdminAuthenticationController::class,'handleLogin'])->name('handle-login');

    Route::post('logout', [AdminAuthenticationController::class,'logout'])->name('logout');

    //forgot password
    Route::get('forgot-password', [AdminAuthenticationController::class,'forgotPassword'])->name('forgot-password');
    Route::post('send-link-reset', [AdminAuthenticationController::class,'sendLinkReset'])->name('forgot-password.send');

    Route::get('reset-password/{token}', [AdminAuthenticationController::class,'resetPassword'])->name('reset-password');
    Route::post('reset-password', [AdminAuthenticationController::class,'handleResetPassword'])->name('reset-password.send');
});

Route::group(["prefix" => "admin", 'as' => 'admin.', 'middleware'=> ['admin']], function () {
    Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');

    // profile
    Route::put('profile-password/update/{id}', [ProfileController::class, 'profilePassword'])->name('profile-password.update');
    Route::resource('profile', ProfileController::class);

    //language route
    Route::resource('language', LanguageController::class);

    //category route
    Route::resource('category', CategoryController::class);

    //news route
    Route::get('news-fetch-category', [NewsController::class, 'fetchCategory'])->name('news-fetch-category');
    Route::get('news-toggle-status', [NewsController::class,'toggleStatus'])->name('news-toggle-status');
    Route::get('news-copy/{id}', [NewsController::class,'copyNews'])->name('news.copy');
    Route::resource('news', NewsController::class);

    //home section setting route
    Route::get('home-section-setting', [HomeSectionSettingController::class,'index'])->name('home-section-setting.index');
    Route::put('home-section-setting-update', [HomeSectionSettingController::class,'update'])->name('home-section-setting.update');

    //social count route
    Route::resource('social-count', SocialCountController::class);

    //ad route
    Route::resource('ad', AdController::class);

    //subscriber route
    Route::resource('subscriber', SubscriberController::class);

    //social link route
    Route::resource('social-link', SocialLinkController::class);

    //footer info route
    Route::resource('footer-info', FooterInfoController::class);

    //footer info route
    Route::put('footer-grid-one-title', [FooterGridOneController::class, 'handleTitle'])->name('footer-grid-one-title');
    Route::resource('footer-grid-one', FooterGridOneController::class);

    //footer info route
    Route::put('footer-grid-two-title', [FooterGridTwoController::class, 'handleTitle'])->name('footer-grid-two-title');
    Route::resource('footer-grid-two', FooterGridTwoController::class);

    //footer info route
    Route::put('footer-grid-three-title', [FooterGridThreeController::class, 'handleTitle'])->name('footer-grid-three-title');
    Route::resource('footer-grid-three', FooterGridThreeController::class);

    //about route
    Route::get('about', [AboutController::class, 'index'])->name('about.index');
    Route::post('about', [AboutController::class, 'store'])->name('about.store');

    //about route
    Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('contact', [ContactController::class, 'store'])->name('contact.store');

    //contact mail route
    Route::get('contact-mail', [ContactMailController::class, 'index'])->name('contact-mail.index');
    Route::post('contact-mail-reply', [ContactMailController::class, 'replyMail'])->name('contact-mail.reply');

    //setting route
    Route::get('setting', [SettingController::class, 'index'])->name('setting.index');
    Route::put('general-setting-update', [SettingController::class, 'generalSettingUpdate'])->name('general-setting-update');
    Route::put('seo-setting-update', [SettingController::class, 'seoSettingUpdate'])->name('seo-setting-update');
    Route::put('color-setting-update', [SettingController::class, 'colorSettingUpdate'])->name('color-setting-update');
    Route::put('microsoft-api-setting-update', [SettingController::class, 'microsoftApiSettingUpdate'])->name('microsoft-api-setting-update');

    //role and permission route
    Route::get('role', [RolePermissionController::class, 'index'])->name('role.index');
    Route::get('role/create', [RolePermissionController::class, 'create'])->name('role.create');
    Route::post('role/store', [RolePermissionController::class, 'store'])->name('role.store');
    Route::get('role/edit/{id}', [RolePermissionController::class, 'edit'])->name('role.edit');
    Route::post('role/update/{id}', [RolePermissionController::class, 'update'])->name('role.update');
    Route::delete('role/destroy/{id}', [RolePermissionController::class, 'destroy'])->name('role.destroy');

    //role user route
    Route::resource('role-user', RoleUserController::class);

    //localization route
    Route::get('admin-localization', [LocalizationController::class, 'adminIndex'])->name('admin-localization.index');
    Route::get('frontend-localization', [LocalizationController::class, 'frontendIndex'])->name('frontend-localization.index');
    Route::post('extract-localization-string', [LocalizationController::class, 'extractLocalizationString'])->name('extract-localization-string');
    Route::post('update-lang-string', [LocalizationController::class, 'updateLangString'])->name('update-lang-string');
    Route::post('translate-string', [LocalizationController::class, 'translateString'])->name('translate-string');
});
