<?php

use App\Jobs\SendPendingReasonsEmail;
use Illuminate\Support\Facades\Schedule;

Schedule::job(new SendPendingReasonsEmail())->everyTwoHours();
