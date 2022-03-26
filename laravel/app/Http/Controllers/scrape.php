<?php
namespace App\Http\Controllers;

use App\Jobs\ScrapeYoutubeJob;
use Illuminate\Support\Facades\DB;




    $keys = [

      'AIzaSyCkvTo6KCIPZN2tcCr_mSbpK94HWbvZpAo',
      'AIzaSyC3cOLS4KvLW0FfnOtVxRvf9qGDroNpZuc',
      'AIzaSyBneHI51930L1b_yJYJZ0Iy-d0BPsfKBFw',
      'AIzaSyCg1sR5FdvwU91cxJT-dj-nJVodg7DRhf4',
      'AIzaSyCtfj-I5p6EJ2_VmGEvX6_QyQw4PHoSZew'
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
            ->update(['status' => 1]);

            mail("trevorprimenyc@gmail.com", "Executed", );

        }
       
    }


?>