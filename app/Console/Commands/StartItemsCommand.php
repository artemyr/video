<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class StartItemsCommand extends Command
{
    protected $signature = 'app:starting_items_seed';
    protected $description = 'Seed starting db items';

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

        $this->call('db:seed', ['class' => 'StartingItemsSeeder']);

        return self::SUCCESS;
    }
}
