<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use App\Models\Order;

class CleanupAbandonedOrders extends Command
{
   protected $signature = 'orders:cleanup {--hours=24}';
   protected $description = 'Hapus pesanan berstatus "menunggu" yang kedaluwarsa';
    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $hours = (int) $this->option('hours');

       $deleted = Order::where('status', 'menunggu')
          ->where('created_at', '<', now()->subHours($hours))
          ->delete();

       $this->info(" {$deleted} pesanan berstatus 'menunggu' dihapus");

       return self::SUCCESS;
    }
}
