<?php

use App\Http\Controllers\IndexController;
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
    Route::get('/', 'index')->name('home');
});

Route::controller(VideosController::class)->prefix('videos')->group(function () {
    Route::post('/', 'store')->name('videos.store');
    Route::get('/create', 'create')->name('videos.create');
    Route::get('/{video}','show')->name('videos.show');
    Route::get('/{video}/edit','edit')->name('videos.edit');
    Route::put('{video}/update','update')->name('videos.update');
    Route::delete('/{video}','destroy')->name('videos.destroy');
});
