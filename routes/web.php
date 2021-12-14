<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\LogoutController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('index');


Route::get('/home/?q=l', function () {
    return view('home.creators-guide');
});
Route::get('/home/?i=i', function () {
    return view('home.income');
});
Route::get('/commission', function () {
    return view('commission.index');
});
Route::get('/blog', function () {
    return view('blog.index');
});

Route::get('/partner', 'App\Http\Controllers\HomeController@partner')->name('index');
Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::get('/home', 'App\Http\Controllers\HomeController@dashboard')->name('index');
    Route::get('/box/index', 'App\Http\Controllers\BoxController@index')->name('box.index');
    Route::get('/box/create', 'App\Http\Controllers\BoxController@create')->name('box.create');
    Route::post('/box', 'App\Http\Controllers\BoxController@store')->name('box.store');
    Route::get('/box/{vid}/edit','App\Http\Controllers\BoxController@edit')->name('box.edit');
    Route::put('/box/{vid}','App\Http\Controllers\BoxController@update')->name('box.update');
    Route::delete('/box/{vid}', 'App\Http\Controllers\BoxController@destory')->name('box.destory');
    Route::get('/box/ship', 'App\Http\Controllers\BoxController@ship')->name('box.ship');
    Route::get('/signout', [LogoutController::class, 'perform']);
 });

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
