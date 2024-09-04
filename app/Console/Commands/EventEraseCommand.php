<?php

namespace App\Console\Commands;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Console\Command;

class EventEraseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:event-erase-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'refresh events every 1 day ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Event::where('created_at', '<=', Carbon::now()->subDay())->delete();
    }
}
