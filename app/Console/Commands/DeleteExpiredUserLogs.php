<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserLog;

class DeleteExpiredUserLogs extends Command
{
    protected $signature = 'logs:cleanup';
    protected $description = 'Menghapus user log yang berumur lebih dari 1 hari';
    public function handle()
    {
        $deleted = UserLog::where(
            'created_at',
            '<',
            now()->subDay(7)
        )->delete();

        $this->info("$deleted log berhasil dihapus.");
    }
}