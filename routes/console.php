<?php

use App\Jobs\SendPendingReasonsEmail;
use Illuminate\Console\Scheduling\Schedule;

Schedule::job(new SendPendingReasonsEmail())->everyTwoHours();
