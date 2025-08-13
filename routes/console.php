<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('app:send-late-tasks-emails')
    -> daily()
    -> at("00:00");
