<?php

namespace App\Http\Controllers;
use Alaouy\Youtube\Facades\Youtube;
use App\Models\User;
use Cookie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class YoutubeController extends Controller
{
   

    public function entry(Request $request)
    {

        $id = auth()->user()->id;
        $user = User::find($id);

        $channel = DB::table('_creators_')
            ->where('email', '=', null)
            ->orderBy('id', 'desc')
            ->limit(1)
            ->get();

        return view("admin.entry", compact('user', $user))
            ->with('entry', $channel);
    }

    public function savekeywords()
    {

        $file = fopen(dirname(__DIR__, 3) . "/php/tags.txt", 'r');
        $keywords = fgetcsv($file, ',');

        foreach ($keywords as $key) {

            try {

                DB::table('tags')->insert([

                    'tag' => $key,
                    'status' => 0,

                ]);
            } catch (exception $e) {
                //
            }
        }
    }

    public function populate()
    {

        $tags = DB::table('tags')
            ->where('status', '=', 0)
            ->orderBy('id', 'desc')
            ->limit(1)
            ->get();

        foreach ($tags as $keyword) {

            self::search($keyword->tag);

            DB::table('tags')
                ->where('id', '=', $keyword->id)
                ->update(['status' => 1]);
        }

    }

    public function set(Request $request)
    {
        $id = auth()->user()->id;
        $user = User::find($id);

        $channel = DB::table('_creators_')
            ->where('email', '=', null)
            ->orderBy('id', 'desc')
            ->limit(1)
            ->get();

        return view("admin.entry", compact('user', $user))
            ->withCookie(cookie('key', $request->input('key'), 1440))
            ->with('entry', $channel);

    }

    public function save(Request $request)
    {

        DB::table('_creators_')
            ->where('channel_id', '=', $request->input('id'))
            ->update(['email' => $request->input('email')]);
        // self::populate();
        return self::entry($request);

    }
    public function skip(Request $request)
    {

        DB::table('_creators_')
            ->where('channel_id', '=', $request->input('id'))
            ->update(['email' => 'skipped']);
        // self::populate();
        return self::entry($request);

    }

    public function search($keyword)
    {

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

    }
    public function deleteCookie()
    {

        $cookie = Cookie::forget('key');

        $id = auth()->user()->id;
        $user = User::find($id);

        $channel = DB::table('_creators_')
            ->where('email', '=', null)
            ->orderBy('id', 'desc')
            ->limit(1)
            ->get();

        return view("admin.entry", compact('user', $user))
            ->with('entry', $channel)
            ->with('api', 'true')
            ->withCookie($cookie);

    }

    public function __destruct()
    {
        // unset();
    }

    public function testted()
    {

// Return an STD PHP object
        //  $video = Youtube::getVideoInfo('rie-hPVJ7Sw');

// Get multiple videos info from an array
        //  $videoList = Youtube::getVideoInfo(['rie-hPVJ7Sw', 'iKHTawgyKWQ']);

// Get localized video info
        //  $video = Youtube::getLocalizedVideoInfo('vjF9GgrY9c0', 'pl');

// Get multiple videos related to a video
        //  $relatedVideos = Youtube::getRelatedVideos('iKHTawgyKWQ');

// Get comment threads by videoId
        //  $commentThreads = Youtube::getCommentThreadsByVideoId('zwiUB_Lh3iA');

// Get popular videos in a country, return an array of PHP objects
        //  $videoList = Youtube::getPopularVideos('us');

// Search playlists, channels and videos. return an array of PHP objects
        //   $results = Youtube::search('Android');

// Only search videos, return an array of PHP objects
        //  $videoList = Youtube::searchVideos('Android');

// Search only videos in a given channel, return an array of PHP objects
        //  $videoList = Youtube::searchChannelVideos('keyword', 'UCk1SpWNzOs4MYmr0uICEntg', 40);

// List videos in a given channel, return an array of PHP objects
        // $videoList = Youtube::listChannelVideos('UCk1SpWNzOs4MYmr0uICEntg', 40);

        // $results = Youtube::searchAdvanced([/* params */]);

// Get channel data by channel name, return an STD PHP object
        // $channel = Youtube::getChannelByName('xdadevelopers');
        //dd($channel);

// Get channel data by channel ID, return an STD PHP object
        // $channel = Youtube::getChannelById('UCk1SpWNzOs4MYmr0uICEntg');

// Get playlist by ID, return an STD PHP object
        //  $playlist = Youtube::getPlaylistById('PL590L5WQmH8fJ54F369BLDSqIwcs-TCfs');

// Get playlists by multiple ID's, return an array of STD PHP objects
        //  $playlists = Youtube::getPlaylistById(['PL590L5WQmH8fJ54F369BLDSqIwcs-TCfs', 'PL590L5WQmH8cUsRyHkk1cPGxW0j5kmhm0']);

// Get playlist by channel ID, return an array of PHP objects
        //  $playlists = Youtube::getPlaylistsByChannelId('UCk1SpWNzOs4MYmr0uICEntg');

// Get items in a playlist by playlist ID, return an array of PHP objects
        // $playlistItems = Youtube::getPlaylistItemsByPlaylistId('PL590L5WQmH8fJ54F369BLDSqIwcs-TCfs');

// Get channel activities by channel ID, return an array of PHP objects
        // $activities = Youtube::getActivitiesByChannelId('UCk1SpWNzOs4MYmr0uICEntg');

// Retrieve video ID from original YouTube URL
        // $videoId = Youtube::parseVidFromURL('https://www.youtube.com/watch?v=moSFlvxnbgk');

// result: moSFlvxnbgk

    }
}
