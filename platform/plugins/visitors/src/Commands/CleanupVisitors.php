<?php
namespace Obii\Visitors\Commands;

use Obii\Visitors\Models\Visitors;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CleanupVisitors extends Command
{
    protected $signature = 'visitors:cleanup';

    protected $description = 'Cleanup old visitor records';

    public function handle()
    {
        Visitors::where('visited_at', '<', Carbon::now()->subDays(30))->delete();
        $this->info('Old visitors records have been deleted.');
    }
}