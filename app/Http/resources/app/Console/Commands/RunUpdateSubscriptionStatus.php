<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\UpdateSubscriptionStatus;

class RunUpdateSubscriptionStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:subscription-status';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update subscription status based on end dates';

    /**
     * Execute the console command.
     */
    public function handle()
    {
 
        UpdateSubscriptionStatus::dispatch();
        $this->info('Subscription statuses updated successfully.');
    }
}
