<?php

use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Route;

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
Route::get('/web-payments-quickstart/public/', 'App\Http\Controllers\HomeController@square')->name('square.index');
Route::post('/payments/charge/', function(){

    ///web-payments-quickstart/public/
});

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
Route::get('/{box_url}', 'App\Http\Controllers\BoxController@index')->name('box.index'); 
Route::get('/{id}/accept', 'App\Http\Controllers\InvitationsController@accept')->name('invitations.accept'); 
Route::get('/search/creator', 'App\Http\Controllers\SearchController@creator')->name('search.creator');
Route::get('/school/home', 'App\Http\Controllers\SchoolController@what')->name('school.home');
Route::get('/school/how', 'App\Http\Controllers\SchoolController@how')->name('school.how');
Route::get('/school/why', 'App\Http\Controllers\SchoolController@why')->name('school.why');

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/home/index', 'App\Http\Controllers\HomeController@dashboard')->name('home.dashboard');
    Route::get('/home/subscriptions', 'App\Http\Controllers\HomeController@subscriptions')->name('home.subscriptions');
    Route::get('/home/subscribers', 'App\Http\Controllers\HomeController@subscribers')->name('home.subscribers');
    Route::get('/box/create', 'App\Http\Controllers\BoxController@create')->name('box.create');
    Route::post('/box/embed', 'App\Http\Controllers\BoxController@embed')->name('box.embed');
    Route::post('/box/url', 'App\Http\Controllers\BoxController@url')->name('box.url');
    Route::post('/box', 'App\Http\Controllers\BoxController@store')->name('box.store');
    Route::get('/box/{vid}/edit', 'App\Http\Controllers\BoxController@edit')->name('box.edit');
    Route::post('/box/{vid}/edit', 'App\Http\Controllers\BoxController@edit')->name('box.edit');
    Route::put('/box/{vid}', 'App\Http\Controllers\BoxController@update')->name('box.update');
    Route::delete('/box/{vid}', 'App\Http\Controllers\BoxController@destory')->name('box.destory');
    Route::get('/box/ship', 'App\Http\Controllers\ShippingController@ship')->name('box.ship');
    Route::get('/box/labels', 'App\Http\Controllers\LabelsController@generate')->name('box.labels');
    Route::get('/labels/purchase', 'App\Http\Controllers\LabelsController@showAddress')->name('labels.purchase');
    Route::post('/labels/rates', 'App\Http\Controllers\LabelsController@rates')->name('labels.purchase');
    Route::post('/labels/charge', 'App\Http\Controllers\SquareController@labels')->name('labels.charge');
    Route::get('/box/addresses', 'App\Http\Controllers\ShippingController@addresses')->name('box.addresses');
    Route::get('/box/track', 'App\Http\Controllers\ShippingController@track')->name('box.track');
    Route::get('/rates', 'App\Http\Controllers\ShippingController@rates')->name('box.rates');
    Route::post('/subscription/remove/{box}', 'App\Http\Controllers\SubscriptionController@remove')->name('subscription.remove');
    Route::get('/account/home', 'App\Http\Controllers\HomeController@account')->name('account.home');
    Route::post('/account/box/', 'App\Http\Controllers\AccountController@updateBox')->name('account.box');
    Route::post('/account/users', 'App\Http\Controllers\AccountController@updateUsers')->name('account.users');
    Route::post('/account/address', 'App\Http\Controllers\AccountController@updateAddress')->name('account.address');
    Route::get('/account/suspend', 'App\Http\Controllers\AccountController@suspend')->name('account.suspend');

    Route::group(['prefix' => 'messages'], function () {
        Route::get('/inbox', ['as' => 'messages', 'uses' => 'App\Http\Controllers\MessagesController@index']);
        Route::get('create', ['as' => 'messages.create', 'uses' => 'App\Http\Controllers\MessagesController@create']);
        Route::post('store', ['as' => 'messages.store', 'uses' => 'App\Http\Controllers\MessagesController@store']);
        Route::get('show/{id}', ['as' => 'messages.show', 'uses' => 'App\Http\Controllers\MessagesController@show']);
        Route::put('update/{id}', ['as' => 'messages.update', 'uses' => 'App\Http\Controllers\MessagesController@update']);
    });
    Route::post('/plan/create', 'App\Http\Controllers\SubscriptionController@createplan')->name('subscription.createplan');
    Route::get('/invitations/home', 'App\Http\Controllers\InvitationsController@home')->name('invitations.home');
    Route::get('/invitations/rewards', 'App\Http\Controllers\InvitationsController@rewards')->name('invitations.rewards');

});
Route::get('/commission/index', 'App\Http\Controllers\HomeController@commission')->name('commission.index');
Route::post('/subscription/complete/{paypal}', 'App\Http\Controllers\SubscriptionController@complete')->name('subscription.complete');
Route::post('/rates', 'App\Http\Controllers\ShippingController@rates');
Route::get('/rates', 'App\Http\Controllers\ShippingController@rates');
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::get('auth/google/status', [GoogleController::class, 'status']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard/index', function () {
    return view('dashboard');
})->name('dashboard');
