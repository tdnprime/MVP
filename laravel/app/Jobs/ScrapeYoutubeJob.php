<?php

namespace App\Jobs;
use App\Models\Jobs;

use App\Jobs\YoutubeSearch;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ScrapeYoutubeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;
    public $key;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $tag;

    public function __construct($tag, $key)
    {
        $this->tag = $tag;
        $this->key = $key;

    }

    /**
     * Execute the job.
     *
     * @return void
     */

    public function handle()
    {
        dispatch(function () {

            $search = new YoutubeSearch($this->key);
            
            $search::search($this->tag);

        })->afterResponse();

    }

}
