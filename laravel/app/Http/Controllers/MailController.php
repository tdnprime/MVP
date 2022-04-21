<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Mail\Campaign;
use App\Models\User;
use Illuminate\Support\Facades\DB;



class MailController extends Controller
{

   

    public function send()
    {
        error_reporting(0);
        $id = auth()->user()->id;
        $sent = 0;
        $creators = DB::table('mailing_list')
        ->where('campaign', '<>', '4')
        ->orderBy('id', 'desc')
        ->limit(1)
        ->select('*')
        ->get();

        $num = count($creators);
        for ($i = 0; $i < $num; $i++) {

            $creator = (object) $creators[$i];
           // $details['email'] = $creator->email; 
            $details['email'] = 'trevorprimenyc@gmail.com'; 

            $message = new Campaign($creator);
            SendEmailJob::dispatch($details, $message)->onQueue('emails');

        }
    }

}
