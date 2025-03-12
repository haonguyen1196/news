<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//route page
Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('news-details/{slug}', [HomeController::class, 'showDetails'])->name('news-details');
Route::get('news', [HomeController::class, 'news'])->name('news');
Route::get('about', [HomeController::class,'about'])->name('about');
Route::get('contact', [HomeController::class,'contact'])->name('contact');

//comment route
Route::post('news-comment', [HomeController::class, 'handleComment'])->name('news-comment');
Route::post('news-comment-replay', [HomeController::class, 'handleCommentReplay'])->name('news-comment-replay');
Route::delete('news-comment-delete', [HomeController::class,'deleteComment'])->name('news-comment-delete');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('language', LanguageController::class)->name('language');

//submit news letter
Route::post('subscribe-news-letter', [HomeController::class, 'subscribeNewsLetter'])->name('subscribe-news-letter');

//hanle contact email
Route::post('contact-email', [HomeController::class,'contactEmail'])->name('contactEmail');

require __DIR__.'/auth.php';
