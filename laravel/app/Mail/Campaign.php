<?php

namespace App\Mail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;



class Campaign extends Mailable
{
    use Queueable, SerializesModels;

     /**
     * The user instance.
     *
     * @var \App\Models\User
     */
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
        return $this->subject('Sponsorship Inquiry')->markdown('mail.campaign-intro');

    }
}
