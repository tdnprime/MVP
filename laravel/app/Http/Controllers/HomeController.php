<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('index', compact('user'));
    }

    public function entry()
    {
        $user = Auth::user();
        return view('home.entry', compact('user'));
    }

    public function terms()
    {
        $user = Auth::user();

        return view('terms.index', compact('user'));
    }

    public function privacy()
    {
        $user = Auth::user();

        return view('privacy.index', compact('user'));
    }

    public function contact()
    {
        $user = Auth::user();

        return view('contact.index', compact('user'));
    }
    public function commission()
    {
        $user = Auth::user();

        return view('commission.index', compact('user'));
    }
    public function search()
    {
        $user = Auth::user();

        return view('search.index', compact('user'));
    }
    public function account()
    {
        $user = Auth::user();

        return view('account.index', compact('user'));
    }

    public function about()
    {
        $user = Auth::user();

        return view('about.index', compact('user'));
    }

    public function dashboard()
    {
        $user = Auth::user();

        return view('home.index', compact('user'));
    }
    public function subscriptions()
    {
        $user = Auth::user();

        $subscriptions = DB::table("subscriptions")
            ->join('boxes', 'boxes.user_id', '=', 'subscriptions.creator_id')
            ->join('users', 'users.id', '=', 'boxes.user_id')
            ->where('subscriptions.user_id', '=', $user->id)
            ->where('sub_id', '<>', null)
            ->select('subscriptions.*', 'boxes.*', 'users.given_name', 'users.family_name')
            ->get();

        return view('home.index', compact('user'))
            ->with('subscriptions', $subscriptions);
    }

    // Get a seller's subscribers
    public function subscribers()
    {
        $user = Auth::user();
        $subscribers = DB::table("subscriptions")
            ->join('users', 'users.id', '=', 'subscriptions.creator_id')
            ->where('subscriptions.creator_id', '=', $user->id)
            ->where('sub_id', '<>', null)
            ->select('users.family_name', 'users.given_name', 
            'users.profile_photo_path', 'subscriptions.*', 
            'subscriptions.price', 'subscriptions.frequency', 
            'subscriptions.admin_area_1', 'subscriptions.country_code')
            ->get();

        return view('home.index', compact('user'))
            ->with('subscribers', $subscribers);

    }

    public function partner()
    {
        $user = Auth::user();

        return view('partner.index', compact('user'));
    }

    public function square(){
        $user = Auth::user();
        header('location:/web-payments-quickstart/public/index.html ');
    }
}
