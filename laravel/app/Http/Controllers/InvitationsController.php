<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvitationsController extends Controller
{
    public function home()
    {

        $id = auth()->user()->id;
        $user = User::find($id);
        return view('invitations.home', compact('user', $user));
    }
    public function accept(Request $request)
    {
        if ($request['id']) {
            setcookie('invited_by', $request['id'], time() + (86400 * 90), "/"); // 3 months
        }

        $user = Auth::user();
        return view('index', compact('user'));
    }
    public function rewards(){
        $id = auth()->user()->id;
        $user = User::find($id);
        return view('invitations.rewards', compact('user', $user));
    }
    public function show(){
        // Show a users earn rewards
    }
}
