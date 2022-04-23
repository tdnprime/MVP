<?php

namespace App\Http\Controllers;

use App\Jobs\ScrapeYoutubeJob;
use App\Models\User;
use Cookie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class YoutubeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function entry(Request $request)
    {

        $id = auth()->user()->id;
        $user = User::find($id);

        $channel = DB::table('_creators_')
            ->where('email', '=', null)
            ->where('country', '=', 'US')
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

                DB::table('tags')->insertorignore([

                    'tag' => $key,
                    'status' => 0,

                ]);

            } catch (exception $e) {

                dd($e);
            }
        }
    }

    public function populate()
    {
        $count = 0;

        $keys = [

        'AIzaSyAUrxYpXdRMJ4w7ZpcuPaVqJPjOdU2z0Ck',
        'AIzaSyDxe4_07YZPOu5tMFEAa_wTZJM9zboZNHk',
        'AIzaSyCkvTo6KCIPZN2tcCr_mSbpK94HWbvZpAo',
        'AIzaSyC3cOLS4KvLW0FfnOtVxRvf9qGDroNpZuc',
        'AIzaSyBneHI51930L1b_yJYJZ0Iy-d0BPsfKBFw',
        'AIzaSyCg1sR5FdvwU91cxJT-dj-nJVodg7DRhf4',
        'AIzaSyCtfj-I5p6EJ2_VmGEvX6_QyQw4PHoSZew',
        'AIzaSyAY3ui82lIA_g_3nnQKqtErrbSTpva0vv8',
        'AIzaSyB_xYwboPSgZv59lX8xC8Aw-2gQ3fFtDZ8',
        'AIzaSyBfd12qh3Iwn3FlLOHnhr4wmSbgGRwj6c8',
        'AIzaSyAKd2cfpE5pMLGvCJIoJceI1AHz1t5kc2M',
        'AIzaSyCu5Sl7gv_BeH-0xuIHdduDtz2Xv67HpX0',
        'AIzaSyCUvuBoonWRglkwCTdrdlHtDSgTVs_1BYI'

        ];

        foreach ($keys as $key) {

            $tags = DB::table('tags')
                ->where('status', '=', 0)
                ->orderBy('id', 'desc')
                ->limit(1)
                ->get();

            foreach ($tags as $keyword) {
                
              $count += 1;
              ScrapeYoutubeJob::dispatch($keyword->tag, $key)->onQueue('scrape')
              ->delay(now()->addMinutes(1));

                DB::table('tags')
                ->where('id', '=', $keyword->id)
                ->update(['status' => 3]);

            }
           
        }
         echo $count . " jobs queued";

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
