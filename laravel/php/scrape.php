<?php

use App\Jobs\ScrapeYoutubeJob;
use Illuminate\Support\Facades\DB;



$tags = DB::table('tags')
    ->where('status', '=', 0)
    ->orderBy('id', 'desc')
    ->limit(1)
    ->get();

foreach ($tags as $keyword) {

    DB::table('tags')
        ->where('id', '=', $keyword->id)
        ->update(['status' => 1]);

    ScrapeYoutubeJob::dispatch($keyword->tag)->onQueue('scrape')
        ->delay(now()->addMinutes(1));

}
