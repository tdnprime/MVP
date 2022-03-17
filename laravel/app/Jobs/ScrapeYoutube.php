<?php

namespace App\Jobs;

use Alaouy\Youtube\Facades\Youtube;
use App\Http\Controllers\YoutubeController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ScrapeYoutube implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $tag;

    public function __construct($keyword)
    {
        Youtube::setApiKey('AIzaSyC3cOLS4KvLW0FfnOtVxRvf9qGDroNpZuc');
        $this->tag = $keyword;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        dispatch(function () {

            YoutubeController::search($this->tag);
            
        })->afterResponse();

    }
}
