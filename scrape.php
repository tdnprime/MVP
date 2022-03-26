<?php

use Laravel\App\Jobs\ScrapeYoutubeJob;
use Laravel\Illuminate\Support\Facades\DB;



$tags = DB::table('tags')
    ->where('status', '=', 0)
    ->orderBy('id', 'desc')
    ->limit(49)
    ->get();

foreach ($tags as $keyword) {

    DB::table('tags')
        ->where('id', '=', $keyword->id)
        ->update(['status' => 0]);

    ScrapeYoutubeJob::dispatch($keyword->tag)->onQueue('scrape')
        ->delay(now()->addMinutes(1));

}
