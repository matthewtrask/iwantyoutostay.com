<?php

namespace App\Jobs;

use App\Mail\PendingReasons;
use App\Models\Reason;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendPendingReasonsEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (Reason::notApproved()->count() > 0) {
            Log::info('here');
            Mail::to(config('mail.to'))->send(new PendingReasons());
        }
    }
}
