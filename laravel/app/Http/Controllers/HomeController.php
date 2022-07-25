<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Mail\WelcomeUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('index', compact('user'));
    }

    public function waiting(Request $request)
    {

        $user = Auth::user();

        $email = $request["email"];

        # Save

        DB::table("waiting")->insert([
            "email" => $email,
            "campaign" => "African Foods",
        ]);

        #Queue welcome email

        $details['email'] = $email;
        $message = new WelcomeUser($user);
        SendEmailJob::dispatch($details, $message)->onQueue('emails');

        return view('apply.survey', compact('user'))
            ->with('email', $email);
    }

    public function survey(Request $request)
    {

        $user = Auth::user();

        
            $email = $request["email"];
            $message = $request["message"];

            $test = DB::table("waiting")->where("email", "=", $email)
            ->get();

        if(!empty($test['email'])){
            
        # Update
            DB::table("waiting")->where("email", "=", $email)->update([
                "message" => $message]);
            Session::flash('message', 'Success!');
            return view('apply.survey', compact('user'));
        }
        if(empty($test['email']) && isset($message)){
            # Insert
            DB::table("waiting")->insert([
                'email' => $email,
                'campaign' => "African Foods",
                'message'=> $message,
            ]);
            Session::flash('message', 'Success!');
            return view('apply.survey', compact('user'));

        }
        return view('apply.survey', compact('user'));

        
        
    }

    public function returns()
    {
        $user = Auth::user();
        return view('returns.index', compact('user'));
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

    public function about()
    {
        $user = Auth::user();

        return view('about.index', compact('user'));
    }

    public function dashboard()
    {
        $user = Auth::user();

        $subscriptions = DB::table("subscriptions")
            ->join('products', 'products.id', '=', 'subscriptions.product_id')
            ->where('subscriptions.user_id', '=', $user->id)
          //  ->where('sub_id', '<>', null)
            ->select('subscriptions.*', 'products.*')
            ->get();

        return view('home.index', compact('user'))
            ->with('subscriptions', $subscriptions);
    }


    public function subscriptions()
    {
        $user = Auth::user();

        $subscriptions = DB::table("subscriptions")
            ->join('products', 'product.id', '=', 'subscriptions.product_id')
            ->where('subscriptions.user_id', '=', $user->id)
          //  ->where('sub_id', '<>', null)
            ->select('subscriptions.*', 'products.*')
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

        return view('apply.index', compact('user'));
    }

  

    public function forgot()
    {

        $user = Auth::user();

        return view('auth.forgot-password', compact('user'));
    }

}
