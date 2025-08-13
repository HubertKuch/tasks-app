<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('app:send-late-tasks-emails', fn() => null)
    -> daily()
    -> at("00:00");
