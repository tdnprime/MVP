<?php

namespace App\Jobs;

use Alaouy\Youtube\Facades\Youtube;
use App\Models\Jobs;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;




class YoutubeSearch
{
    public $sent;

    public function __construct($key)
    {

        Youtube::setApiKey($key);
        $this->sent = 0;
    }

    public function search($tag)
    {

        $params = [
            
            'q' => $tag,
            'type' => 'channel',
            'part' => 'id, snippet',
            'maxResults' => 50,
        ];

        // $pageTokens = [];
        // $results = [];

        $search = Youtube::paginateResults($params, null);
        

        if ($search['results'] != false) {

            // $total = $search['info']['totalResults'];
            // $pages = $search['info']['resultsPerPage'];
            // $counter = $total / $pages;

            // foreach ($search['results'] as $obj) {

            //     array_push($results, $obj);
            // }

            // Store token (2nd page)
           // array_push($pageTokens, $search['info']['nextPageToken']);

           // for ($i = 0; $i < $counter; $i++) {

                // Go to next page
              //  if(isset($pageTokens[$i])){

                // $search = Youtube::paginateResults($params, $pageTokens[$i]);

                // if ($search['results'] != false) {
                //     // Store tokens
                //     array_push($pageTokens, $search['info']['nextPageToken']);

                //     foreach ($search['results'] as $obj) {

                //         array_push($results, $obj);
                //     }
                // }
            }

            }

            foreach ($search['results'] as $obj) {

                $this->send += 1;

                try {

                    $channel = Youtube::getChannelById($obj->snippet->channelId);

                    if ($channel->statistics->videoCount > 0) {

                        $average_views = $channel->statistics->viewCount / $channel->statistics->videoCount;

                    } else {

                        $average_views = 0;
                    }

                    if ($average_views > 5000) {

                        DB::table('_creators_')->insertOrIgnore([

                            'channel_id' => $obj->snippet->channelId,
                            'channel_name' => $obj->snippet->title,
                            'country' => $channel->snippet->country ?? null,
                            'views' => $channel->statistics->viewCount,
                            'videos' => $channel->statistics->videoCount,

                        ]);

                    }

                } catch (exception $e) {
                    
                    Log::info('Storing channel', [$key => $e]);
                    continue;
                }

            }

        }

    }
    public function destruct(){

        mail("trevorprimenyc@gmail.com", "Pages Scraped", $this->send);

    }
}
