<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\domains;

class FetchIPCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch_ip:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $record = domains::where('fetched_id', NULL)->first();
        if( !empty($record) ){
            $domain = preg_replace('{http://|https://}', '', $record->domain);
        }
        if( !empty($domain) ){
            $ip = gethostbyname($domain);
        }
        $record->fetched_id = $ip;
        $record->save();

        \Log::info("Fetch IP cron finished. Result: ". $ip );
        return 0;
    }
}
