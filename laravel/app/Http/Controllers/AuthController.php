<?php

namespace App\Http\Controllers;

use Cookie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function index()
    {

        $user = Auth::user();
        return view('auth.register', compact('user'));
    }

    public function register(Request $request)
    {

        // $name = $request['given_name'];
        // dd($name);
    }

    public function login(Request $request)
    {


        $password = DB::table("users")
        ->where("email", "=", $request["email"])
        ->select("password", "id")
        ->get();

        if ($request["password"] == Crypt::decryptString($password[0]->password)) {

            $user = User::find($password[0]->id);
            Auth::login($user, true);
            
        }else{

            Session::flash("status", "Incorrect login credentials");
            return view("auth.login");
        }

        # Redirect to checkout

        if (isset($_COOKIE['checkout'])) {
            $location = "/checkout/index";
            $cookie = Cookie::forget('checkout');
            return redirect($location)->withCookie($cookie);

        } else {
            return redirect('/home/index');
        }


        if ($user) {

            return redirect()->route('home.index', compact('user'));
        }
    }

    public function create(Request $request)
    {

        $user = User::firstOrCreate([
            'google_id' => null,
            'email' => $request["email"],
            'given_name' => $request["given_name"],
            'family_name' => $request["family_name"],
            'profile_photo_path' => null,
            'password' => Crypt::encryptString($request["password"]),
        ]);

        if (isset($user)) {

            Auth::login($user, true);
            return redirect()->route('home.index', compact('user'));
        }

    }

    public function recover(Request $request)
    {

        //
    }

    public function reset(Request $request)
    {

        //
    }
}
