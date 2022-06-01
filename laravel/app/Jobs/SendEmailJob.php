<?php

namespace App\Jobs;

use App\Models\Jobs;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\Middleware\ThrottlesExceptions;


class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $details;
    protected $email;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 1;


    /**
     * Create a new job instance.
     *
     * @return void
     */

    public function __construct($details, $email)
    {
        $this->details = $details;
        $this->email = $email;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        dispatch(function () {


            Mail::to($this->details['email'])->send($this->email)->cc("service@boxeon.com");

        })->afterResponse();

       // DB::table('mailing_list')
       // ->where('email', '=', $this->details['email'])
       // ->update(['campaign' => 5]);

    }
 
    /**
     * Get the middleware the job should pass through.
     *
     * @return array
     */
    public function middleware()
    {
        return [new ThrottlesExceptions(1, 5)];
    }
     
    /**
     * Determine the time at which the job should timeout.
     *
     * @return \DateTime
     */
    public function retryUntil()
    {
        return now()->addMinutes(5);
    }

   

}
