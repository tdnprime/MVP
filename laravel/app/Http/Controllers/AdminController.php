<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display the dashboard.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        dd($request);

        $user = Auth::user();
        return view('admin.login', compact('user'));
    }

    /**
     * Display the dashboard.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $user = Auth::user();
        return view('dashboard', compact('user'));
    }

    /**
     * Display the boxes resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function boxes()
    {
        return view('admin.boxes');
    }

    /**
     * Display the subscriptions resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function subscriptions()
    {
        return view('admin.subscriptions');
    }

    /**
     * Display the invitations resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function invitations()
    {
        return view('admin.invitations');
    }

    /**
     * Display the forms resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function forms()
    {
        return view('admin.forms');
    }

    /**
     * Display the emails resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function emails()
    {
        return view('admin.emails');
    }

    public function entry()
    {
        return view('admin.entry');
    }
}
