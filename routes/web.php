<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    return view('index');
});
Route::get('/home/?q=l', function () {
    return view('home.creators-guide');
});
Route::get('/home/?i=i', function () {
    return view('home.income');
});
Route::get('/home/?s=s', function () {
    return view('home.index');
});
Route::get('/commission', function () {
    return view('commission.index');
});
Route::get('/partner', function () {
    return view('partner');
});
Route::get('/blog', function () {
    return view('blog.index');
});

Route::group(['middleware' => ['auth:sanctum']], function() {

    Route::get('/box', 'App\Http\Controllers\BoxController@index')->name('box.index');
    Route::post('/box/create', 'App\Http\Controllers\BoxController@create')->name('box.create');
    Route::get('box/edit/{id}','App\Http\Controllers\BoxController@edit')->name('box.edit');
    Route::patch('box/{id}','App\Http\Controllers\BoxController@update')->name('box.update');
    Route::post('box/destory', 'App\Http\Controllers\BoxController@destory')->name('box.destory');
    Route::get('box/ship', 'App\Http\Controllers\BoxController@ship')->name('box.ship');

    Route::get('/signout', 'LogoutController@perform')->name('logout.perform');
 });

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);




Route::get('/WelcomeMail', [MailController::class, 'welcomeMail']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

