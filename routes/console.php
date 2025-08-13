<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Schedule::command('app:send-late-tasks-emails')
    -> daily()
    -> at('04:00');
