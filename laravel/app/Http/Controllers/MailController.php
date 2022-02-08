<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function welcome()
    {

        $id = auth()->user()->id;
        $user = User::find($id);
        $name = $user->given_name;
        $to = $user->email;

        $from = "help@boxeon.com";
        $subject = "Welcome to Boxeon!";
        $logo = "https://boxeon.com/assets/images/logo.png";
        $headers = "From:Boxeon<" . $from . ">\r\n";
        $headers .= "Reply-To: " . $from . "\r\n";
        $headers .= "Organization: Boxeon\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";
        $message = '<html><body>';
        $message .= '<img src="' . $logo . '"height="auto" title="" alt="" border="0" style="display:block;width:auto;max-width:110px;margin:auto" class="CToWUd"/>';
        $message .= "<br><p>Hi " . $name . ",</p>";
        $message .= "<p>Thank you for joining Boxeon.</p>";
        $message .= "<p>You have sucessfully created an account on Boxeon. Congratulations on being an early adopter of the next big thing. We are here to answer your questions if you have any.</p>";
        $message .= "<br><p>Sincerely,</p>";
        $message .= "<p>- The Boxeon Team</p>";
        $message .= "<p>https://boxeon.com</p>";
        $message .= '</body></html>';

        try {

            $re = mail($to, $subject, $message, $headers);

        } catch (Exception $e) {

            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

}
