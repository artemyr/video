<?php

namespace App\Console\Commands;

use Database\Seeders\StartingItemsSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class ClearCommand extends Command
{
    protected $signature = 'app:clear';
    protected $description = 'Clear starting db items';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (app()->isProduction()) {
            $this->error('Can\'t exec production app');
            return self::FAILURE;
        }

        Cache::clear();

        $imagesStorage = Storage::disk('images');
        $files = $imagesStorage
            ->allFiles();
        $imagesStorage->delete($files);

        $videoStorage = Storage::disk('video');
        $files = $videoStorage
            ->allFiles();
        $videoStorage->delete($files);

//        $this->call('migrate')

        return self::SUCCESS;
    }
}
