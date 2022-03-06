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

        $id = auth()->user()->id;

        $creators = DB::table('mailing_list')->get();
        $num = count($creators);
        for ($i = 0; $i < $num; $i++) {

            $creator = (object) $creators[$i];
            #Queue an order-placed system email
            $details['email'] = $creator->email;
            $message = new Campaign($creator);
            SendEmailJob::dispatch($details, $message)->onQueue('emails');
            // dd($response);
        }
    }

}
