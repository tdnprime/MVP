<?php

namespace App\Http\Controllers;
use App\Models\Box;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AccountController extends Controller
{
    public function index()
    {
        $id = auth()->user()->id;
        $user = User::find($id);
        $address = DB::table("users")
        ->where("id", $id)
        ->get()[0];
        return view('account.index', compact('user'))
        ->with("address", $address);
    }

    public function earnings(){

        $id = auth()->user()->id;
        $user = User::find($id);
        return view('account.earnings', compact('user', $user));

    }

    public function updateBox(Request $request)
    {

        $id = auth()->user()->id;
        $user = User::find($id);
        $box = new Box();
        $box = DB::table('boxes')
            ->where('user_id', $user->id)
            ->limit(1);
        $input = $request->except(['_token', '_method']);
        $box->update($input);
        Session::flash('message', 'Account updated.'); 
        return view('account.index', compact('user', $user));

    }
    public function updateUsers(Request $request)
    {

        $id = auth()->user()->id;
        $user = User::find($id);
        DB::table('users')
            ->where('user_id', $user->id)
            ->limit(1);
        $input = $request->except(['_token', '_method']);
        $user->update($input);
        Session::flash('message', 'Account updated.'); 
        return view('account.index', compact('user', $user));


    }
    public function updateAddress(Request $request)
    {

        $id = auth()->user()->id;
        $user = User::find($id);
        DB::table('subscriptions')
            ->where('user_id', $user->id)
            ->limit(1);
        $input = $request->except(['_token', '_method']);
        $user->update($input);
        Session::flash('message', 'Account updated.'); 
        return view('account.index', compact('user', $user));


    }
    public function suspend(){
        //User::find(1)->delete();
        return view('index');
    }
}
