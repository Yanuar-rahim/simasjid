<?php

namespace App\Console\Commands;

use App\Models\ActivityLog;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:delete-old-activity-logs')]
#[Description('Menghapus activity log yang lebih dari 30 hari')]
class DeleteOldActivityLogs extends Command
{
    public function handle()
    {
        $deleted = ActivityLog::where(
            'created_at',
            '<',
            now()->subDays(7)
        )->delete();

        $this->info("{$deleted} activity log berhasil dihapus.");
    }
}
