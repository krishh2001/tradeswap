<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BillReward;
use Carbon\Carbon;

class DecreaseRemainingDays extends Command
{
    protected $signature = 'bill:decrease-remaining-days';
    protected $description = 'Decrease remaining_days by 1 for all active bill rewards daily';

    public function handle()
    {
        $bills = BillReward::where('remaining_days', '>', 0)->get();

        foreach ($bills as $bill) {
            $bill->decrement('remaining_days');
        }

        $this->info('Remaining days updated for all active bills.');
    }
}
