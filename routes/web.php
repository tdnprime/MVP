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
//Handle Laravel logout
Route::get('/out', 'App\Http\Controllers\LogoutController@perform')->name('logout.perform');
//Handle Google logout
Route::get('/signout', function () {
    return view('signout');
});

Route::get('/terms', 'App\Http\Controllers\HomeController@terms')->name('terms');
Route::get('/privacy', 'App\Http\Controllers\HomeController@privacy')->name('privacy');
Route::get('/contact', 'App\Http\Controllers\HomeController@contact')->name('contact');
Route::get('/about', 'App\Http\Controllers\HomeController@about')->name('about');

Route::get('/partner', 'App\Http\Controllers\HomeController@partner')->name('index');
Route::post('/partner/apply', 'App\Http\Controllers\PartnerController@apply')->name('apply');
Route::get('/box/index', 'App\Http\Controllers\BoxController@index')->name('box.index');
Route::get('/{box_url}', 'App\Http\Controllers\BoxController@index')->name('box.index'); //moved back

Route::group(['middleware' => ['auth:sanctum']], function() {
    
    Route::get('/home/index', 'App\Http\Controllers\HomeController@dashboard')->name('home.dashboard');
    Route::get('/box/create', 'App\Http\Controllers\BoxController@create')->name('box.create');
    Route::post('/box', 'App\Http\Controllers\BoxController@store')->name('box.store');
    Route::get('/box/{vid}/edit','App\Http\Controllers\BoxController@edit')->name('box.edit');
    Route::post('/box/{vid}/edit','App\Http\Controllers\BoxController@edit')->name('box.edit');
    Route::put('/box/{vid}','App\Http\Controllers\BoxController@update')->name('box.update');
    Route::delete('/box/{vid}', 'App\Http\Controllers\BoxController@destory')->name('box.destory');
    Route::get('/box/ship', 'App\Http\Controllers\BoxController@ship')->name('box.ship');
    Route::get('/rates','App\Http\Controllers\ShippingController@rates')->name('box.rates');
    Route::post('/subscription/remove/{box}','App\Http\Controllers\SubscriptionController@remove')->name('subscription.remove');


});
Route::post('/createplan','App\Http\Controllers\SubscriptionController@createplan')->name('subscription.createplan');
Route::post('/subscription/complete/{paypal}','App\Http\Controllers\SubscriptionController@complete')->name('subscription.complete');
Route::post('/rates','App\Http\Controllers\ShippingController@rates');
Route::get('/rates','App\Http\Controllers\ShippingController@rates');
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::get('auth/google/status', [GoogleController::class, 'status']);


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

