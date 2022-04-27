<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;



class Campaign extends Mailable
{
    use Queueable, SerializesModels;

   
    public $creator;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($creator)
    {
        $this->creator = $creator;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('We\'re hiring content creators')->markdown('mail.campaign-intro');

    }
}
