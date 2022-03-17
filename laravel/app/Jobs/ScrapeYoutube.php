<?php

namespace App\Jobs;

use Alaouy\Youtube\Facades\Youtube;
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

           
        // Same params as before
        $params = [
            'q' => $keyword,
            'type' => 'channel',
            'part' => 'id, snippet',
            'maxResults' => 50,
        ];

        $pageTokens = [];

        // Make inital search
        $search = Youtube::paginateResults($params, null);
        // Store token
        $pageTokens[] = $search['info']['nextPageToken'];
        // Go to next page in result
        $search = Youtube::paginateResults($params, $pageTokens[0]);
        // Store token
        $pageTokens[] = $search['info']['nextPageToken'];
        // Go to next page in result
        $search = Youtube::paginateResults($params, $pageTokens[1]);
        // Store token
        $pageTokens[] = $search['info']['nextPageToken'];
        // Go back a page
        // $search = Youtube::paginateResults($params, $pageTokens[0]);

        // Add results key with info parameter set
        foreach ($search['results'] as $obj) {

            try {

                $channel = Youtube::getChannelById($obj->snippet->channelId);

                if ($channel->statistics->videoCount > 0) {

                    $average_views = $channel->statistics->viewCount / $channel->statistics->videoCount;

                } else {
                    $average_views = 0;
                }

                if ($average_views > 10000) {


                        DB::table('_creators_')->insertOrIgnore([

                            'channel_id' => $obj->snippet->channelId,
                            'channel_name' => $obj->snippet->title,
                            'country' => $channel->snippet->country ?? null,
                            'views' => $channel->statistics->viewCount,
                            'videos' => $channel->statistics->videoCount,

                        ]);
                  
                }

            } catch (exception $e) {

                continue;
            }

        }

        })->afterResponse();

    }
}
