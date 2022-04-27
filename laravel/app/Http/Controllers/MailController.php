<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Mail\Campaign;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class MailController extends Controller
{

    public function unsub(Request $request)
    {
        $email = $request['e'];
        DB::table('mailing_list')
        ->where('email', '=', $email)
        ->update(['valid' => 'unsub']);

        $user = Auth::user();
        return view('mail.unsubscribe', compact('user'));
    }

    public function send()
    {
        error_reporting(0);
        $id = auth()->user()->id;
        $sent = 0;
        $creators = DB::table('mailing_list')
            ->where('campaign', '<>', '5')
            ->orderBy('id', 'asc')
            ->limit(250)
            ->select('*')
            ->get();

        $num = count($creators);
        for ($i = 0; $i < $num; $i++) {

            $creator = (object) $creators[$i];
            $details['email'] = $creator->email;
            //$details['email'] = 'trevorprimenyc@gmail.com';
            $message = new Campaign($creator);
            SendEmailJob::dispatch($details, $message)->onQueue('emails');

        }
    }
    public function record(Request $request){

        $email = $request['email'];
        DB::table('mailing_list')
        ->where('email', '=', $email)
        ->update(['valid' => 'open']);
        
    }


}
