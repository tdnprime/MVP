<?php

namespace App\Jobs;

use Alaouy\Youtube\Facades\Youtube;
use App\Models\Jobs;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;




class YoutubeSearch
{
  

    public function __construct($key)
    {

        Youtube::setApiKey($key);
       
    }

    public function search($tag)
    {

        $params = [
            
            'q' => $tag,
            'type' => 'channel',
            'part' => 'id, snippet',
            'maxResults' => 50,
        ];


        $search = Youtube::paginateResults($params, null);
        

        if ($search['results'] != false) {

            foreach ($search['results'] as $obj) {


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


    public function __destruct(){

        Log::info('Channel Stored:', ['class' => 'destructed']);

    }
}
