<?php

namespace App\Console\Commands;

use App\Services\ExternalAPI\NewsSyncService;
use Illuminate\Console\Command;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Client\ConnectionException;

class SyncArticlesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'articles:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync news articles from external APIsn';


    public function __construct(protected NewsSyncService $newsSyncService)
    {
        parent::__construct();
    }


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting article sync...');
        try {
            $this->newsSyncService->sync();
        } catch (BindingResolutionException|ConnectionException $e) {
            $this->error($e->getMessage());
        }
        $this->info('Article sync completed.');
    }
}
