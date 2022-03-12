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
        ->where('campaign', '<>', '1')
        ->where('valid', '=', '2')
        ->orderBy('channel_name', 'desc')
        ->limit(250)
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
