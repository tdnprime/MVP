<?php

namespace App\Console\Commands;
use App\Http\Controllers\YoutubeController;
use Illuminate\Console\Command;

class Scraper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'minute:scraper';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape Youtube';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $scraper = new YoutubeController();
        $scraper->populate();
        $this->info('YouTube scraped successfully');

    
    }
}
