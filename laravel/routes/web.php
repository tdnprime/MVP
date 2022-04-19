<?php

use App\Http\Controllers\GoogleController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;


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

Route::get('/partner', 'App\Http\Controllers\HomeController@partner')->name('partner.apply');
Route::post('/partner/apply', 'App\Http\Controllers\PartnerController@apply')->name('apply');
Route::get('/box/index', 'App\Http\Controllers\BoxController@index')->name('box.index');
Route::get('/{box_url}', 'App\Http\Controllers\BoxController@index')->name('box.index');
Route::get('/{id}/accept', 'App\Http\Controllers\InvitationsController@accept')->name('invitations.accept');
Route::get('/search/creator', 'App\Http\Controllers\SearchController@creator')->name('search.creator');
Route::get('/school/home', 'App\Http\Controllers\SchoolController@what')->name('school.home');
Route::get('/school/how', 'App\Http\Controllers\SchoolController@how')->name('school.how');
Route::get('/school/why', 'App\Http\Controllers\SchoolController@why')->name('school.why');

#ADMIN

Route::group(['middleware' => ['admin']], function () {
    
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', 'App\Http\Controllers\AdminController@dashboard')->name('admin.dashboard');
        Route::get('/boxes', 'App\Http\Controllers\AdminController@boxes')->name('admin.boxes');
        Route::get('/subscriptions', 'App\Http\Controllers\AdminController@subscriptions')->name('admin.subscriptions');
        Route::get('/invitations', 'App\Http\Controllers\AdminController@invitations')->name('admin.invitations');
        Route::get('/forms', 'App\Http\Controllers\AdminController@forms')->name('admin.forms');
        Route::get('/emails', 'App\Http\Controllers\AdminController@emails')->name('admin.emails');
        Route::get('/entry', 'App\Http\Controllers\AdminController@entry')->name('admin.entry');
    });
});

#CONTRIBUTOR MIDDLEWARE
Route::group(['middleware' => ['auth:sanctum', 'contributor']], function () {
    Route::get('/home/entry', 'App\Http\Controllers\HomeController@entry')->name('home.entry');
});

#AUTH MIDDLEWARE

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/home/index', 'App\Http\Controllers\HomeController@dashboard')->name('home.index');
    Route::get('/home/subscriptions', 'App\Http\Controllers\HomeController@subscriptions')->name('home.subscriptions');
    Route::get('/home/subscribers', 'App\Http\Controllers\HomeController@subscribers')->name('home.subscribers');

    #BOX

    Route::prefix('box')->group(function () {

        Route::get('/create', 'App\Http\Controllers\BoxController@create')->name('box.create');
        Route::post('/embed', 'App\Http\Controllers\BoxController@embed')->name('box.embed');
        Route::post('/url', 'App\Http\Controllers\BoxController@url')->name('box.url');
        Route::get('/url', 'App\Http\Controllers\BoxController@url')->name('box.url');
        Route::post('/', 'App\Http\Controllers\BoxController@store')->name('box.store');
        Route::get('/{vid}/edit', 'App\Http\Controllers\BoxController@edit')->name('box.edit');
        Route::post('/{vid}/edit', 'App\Http\Controllers\BoxController@edit')->name('box.edit');
        Route::put('/{vid}', 'App\Http\Controllers\BoxController@update')->name('box.update');
        Route::delete('/{vid}', 'App\Http\Controllers\BoxController@destory')->name('box.destory');
        Route::get('/track', 'App\Http\Controllers\ShippingController@track')->name('box.track');

    });

    #CHECKOUT

    Route::prefix('checkout')->group(function () {

        Route::get('/address', 'App\Http\Controllers\LabelsController@showAddress')->name('checkout.address');
        Route::post('/labels', 'App\Http\Controllers\LabelsController@rates')->name('labels.purchase');
        Route::get('/labels/charge', 'App\Http\Controllers\SquareController@charge');
        Route::get('/subscription', 'App\Http\Controllers\SubscriptionController@checkout')->name('subscription.checkout');
        Route::get('/subscription/create', 'App\Http\Controllers\SquareController@createSubscription')->name('subscription.upsert');
        Route::post('/subscription/create', 'App\Http\Controllers\SquareController@createSubscription')->name('subscription.upsert');

    });

#LABELS

    Route::prefix('labels')->group(function () {
        
        Route::get('/home', 'App\Http\Controllers\ShippingController@ship')->name('labels.home');

        Route::get('/generate', 'App\Http\Controllers\LabelsController@generate')->name('labels.generate');

    });

    #SHIPPING

    Route::prefix('shipping')->group(function () {
        Route::get('/addresses', 'App\Http\Controllers\ShippingController@addresses')->name('shipping.addresses');

    });

    #ENTRY

    Route::prefix('entry')->group(function () {

        Route::get('/youtube', 'App\Http\Controllers\YoutubeController@entry');
        Route::get('/keywords', 'App\Http\Controllers\YoutubeController@savekeywords');
        Route::post('/save', 'App\Http\Controllers\YoutubeController@save');
        Route::post('/skip', 'App\Http\Controllers\YoutubeController@skip');
        Route::post('/set', 'App\Http\Controllers\YoutubeController@set');
        Route::get('/update/key', 'App\Http\Controllers\YoutubeController@deleteCookie');
        Route::get('/populate', 'App\Http\Controllers\YoutubeController@populate');
        Route::get('/fetch', 'App\Http\Controllers\ExtensionController@fetch');
        Route::get('/extsave', 'App\Http\Controllers\ExtensionController@save');
        Route::post('/extsave', 'App\Http\Controllers\ExtensionController@save');
        Route::get('/populater', function () {

            Artisan::queue('minute:scraper')->onQueue('commands');
        });


    });

    #SUBSCRIPTION

    Route::prefix('subscription')->group(function () {

        Route::post('/remove/{box}', 'App\Http\Controllers\SubscriptionController@remove')->name('subscription.remove');
        Route::post('/update', 'App\Http\Controllers\SubscriptionController@update')->name('subscription.update');
        Route::get('/billing', 'App\Http\Controllers\SubscriptionController@billingAddress')->name('subscription.billing');

    });

    #CAMPAIGN

    Route::prefix('campaign')->group(function () {

        Route::get('/intro', 'App\Http\Controllers\MailController@send')->name('campaign.intro');
        Route::get('/intro', 'App\Http\Controllers\MailController@test')->name('campaign.intro');


    });

    Route::get('/rates', 'App\Http\Controllers\ShippingController@rates')->name('shipping.rates');



#ACCOUNTS

    Route::prefix('account')->group(function () {

        Route::get('/home', 'App\Http\Controllers\HomeController@account')->name('account.home');
        Route::post('/box', 'App\Http\Controllers\AccountController@updateBox')->name('account.box_url');
        Route::post('/users', 'App\Http\Controllers\AccountController@updateUsers')->name('account.users');
        Route::post('/address', 'App\Http\Controllers\AccountController@updateAddress')->name('account.address');
        Route::get('/suspend', 'App\Http\Controllers\AccountController@suspend')->name('account.suspend');
        Route::get('/earnings', 'App\Http\Controllers\AccountController@earnings')->name('account.earnings');

    });

    #MESSAGES

    Route::group(['prefix' => 'messages'], function () {
        Route::get('/inbox', ['as' => 'messages', 'uses' => 'App\Http\Controllers\MessagesController@index']);
        Route::get('create', ['as' => 'messages.create', 'uses' => 'App\Http\Controllers\MessagesController@create']);
        Route::post('store', ['as' => 'messages.store', 'uses' => 'App\Http\Controllers\MessagesController@store']);
        Route::get('show/{id}', ['as' => 'messages.show', 'uses' => 'App\Http\Controllers\MessagesController@show']);
        Route::put('update/{id}', ['as' => 'messages.update', 'uses' => 'App\Http\Controllers\MessagesController@update']);
    });

    Route::post('/plan/create', 'App\Http\Controllers\SubscriptionController@createplan');
    Route::get('/plan/create', 'App\Http\Controllers\SubscriptionController@createplan');

    Route::get('/invitations/home', 'App\Http\Controllers\InvitationsController@home')->name('invitations.home');
    Route::get('/invitations/rewards', 'App\Http\Controllers\InvitationsController@rewards')->name('invitations.rewards');

});

#GOOGLE CALLBACK
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


Route::get('/commission/index', 'App\Http\Controllers\HomeController@commission')->name('commission.index');

Route::post('/rates/fetch', 'App\Http\Controllers\ShippingController@rates');
Route::get('/rates/fetch', 'App\Http\Controllers\ShippingController@rates');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', [AdminController::class, 'login']);
    Route::get('/google', [GoogleController::class, 'redirectToGoogleAdmin']);
});

Route::group(['prefix' => 'auth'], function () {
    Route::get('/google', [GoogleController::class, 'redirectToGoogle']);
    Route::get('/google/callback', [GoogleController::class, 'handleGoogleCallback']);
    Route::get('/google/status', [GoogleController::class, 'status']);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard/index', function () {
    return view('dashboard');
})->name('dashboard');
