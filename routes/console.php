<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('app:delete-old-activity-logs')
    ->cron('0 0 * * *'); // setiap hari jam 00:00

Schedule::command('logs:cleanup')
    ->cron('0 0 * * *'); // setiap hari jam 00:00