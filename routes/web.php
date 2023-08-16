<?php

use App\Http\Controllers\CategoryVideoController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DislikeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VideosController;
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

Route::controller(IndexController::class)->group(function () {
    Route::get('/', 'index')->name('index');
});

Route::controller(VideosController::class)->prefix('videos')->group(function () {
    Route::post('/', 'store')->name('videos.store');
    Route::get('/create', 'create')->name('videos.create');
    Route::get('/{video}','show')->name('videos.show');
    Route::get('/{video}/edit','edit')->name('videos.edit');
    Route::put('{video}/update','update')->name('videos.update');
    Route::delete('/{video}','destroy')->name('videos.destroy');
});

Route::controller(CategoryVideoController::class)->prefix('categories')->group(function () {
    Route::get('/{category}/videos','index')->name('categories.videos.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(CommentController::class)->group(function () {
   Route::post('/videos/{video}/comments','store')->name('videos.comments.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(LikeController::class)->group(function (){
   Route::get('likes/{likeable_type}/{likeable_id}','like')->name('like')->middleware('auth');
});

Route::controller(DislikeController::class)->group(function (){
    Route::get('dislikes/{likeable_type}/{likeable_id}','dislike')->name('dislike')->middleware('auth');
});

require __DIR__.'/auth.php';
