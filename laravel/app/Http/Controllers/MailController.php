<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Mail\Campaign;
use App\Models\User;
use Illuminate\Support\Facades\DB;



class MailController extends Controller
{

    public function test(){

       
            $id = auth()->user()->id;
            $sent = 0;
            $creators = DB::table('mailing_list')
            ->where('country', '=', 'US')
            ->where('valid', '=', '1')
            ->orderBy('channel_name', 'desc')
            ->limit(1)
            ->select('*')
            ->get();
    
            $num = count($creators);
            for ($i = 0; $i < $num; $i++) {
    
                $creator = (object) $creators[$i];
                #Queue an order-placed system email
                $details['email'] = $creator->email; 
                return $message = new Campaign($creator);
                SendEmailJob::dispatch($details, $message)->onQueue('emails')
                ->delay(now()->addMinutes(1));
    
            }

    }

    public function send()
    {
        error_reporting(0);
        $id = auth()->user()->id;
        $sent = 0;
        $creators = DB::table('mailing_list')
        ->where('country', '=', 'US')
        ->where('valid', '=', '1')
        ->orderBy('channel_name', 'asc')
        ->limit(100)
        ->select('*')
        ->get();

        $num = count($creators);
        for ($i = 0; $i < $num; $i++) {

            $creator = (object) $creators[$i];
            #Queue an order-placed system email
            $details['email'] = $creator->email; 
            $message = new Campaign($creator);
            SendEmailJob::dispatch($details, $message)->onQueue('emails')
            ->delay(now()->addMinutes(1));

        }
    }

}
