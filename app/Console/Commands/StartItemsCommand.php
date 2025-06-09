<?php

namespace App\Console\Commands;

use Database\Seeders\StartingItemsSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class StartItemsCommand extends Command
{
    protected $signature = 'app:seed:start-items';
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

        /** @see StartingItemsSeeder */
        $this->call('db:seed', ['class' => 'StartingItemsSeeder']);

        return self::SUCCESS;
    }
}
