<?php

namespace App\Jobs;

use App\Models\Jobs;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\ThrottlesExceptions;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
     * Indicate if the job should be marked as failed on timeout.
     *
     * @var bool
     */
    public $failOnTimeout = true;

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

            Mail::to($this->details['email'])->cc(['service@boxeon.com'])->send($this->email);

            DB::table('mailing_list')
                ->where('email', '=', $this->details['email'])
                ->update(['campaign' => 1]);

        })->afterResponse();

    }

   

   

}
