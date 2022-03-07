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
        $creators = DB::table('test')->get();
        
        $num = count($creators);
        for ($i = 0; $i < $num; $i++) {

            $creator = (object) $creators[$i];
            #Queue an order-placed system email
            $details['email'] = $creator->email;
            $message = new Campaign($creator);
            $response = SendEmailJob::dispatch($details, $message)->onQueue('emails');
           $sent =+ $i;
        }
        echo $sent;
       print_r($response);
    }

}
