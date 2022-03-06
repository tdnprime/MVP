<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendEmailJob;
use App\Mail\Campaign;



class MailController extends Controller
{

    public function send(){

        $id = auth()->user()->id;
        $user = User::find($id);

        return new Campaign($user);

        #Queue an order-placed system email
        $details['email'] = $user->email;
        $message = new Campaign($user);
        SendEmailJob::dispatch($details, $message)->onQueue('emails');
        dd($response);
    }

}
