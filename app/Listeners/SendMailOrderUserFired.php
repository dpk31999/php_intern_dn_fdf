<?php

namespace App\Listeners;

use App\Events\SendMailOrderUser;
use App\Jobs\SendMailWhenUserCheckoutJob;
use App\Mail\MailOrderUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;

class SendMailOrderUserFired
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SendMailOrderUser  $event
     * @return void
     */
    public function handle(SendMailOrderUser $event)
    {
        $job = (new SendMailWhenUserCheckoutJob($event->order))
                ->delay(Carbon::now()->addSeconds(5));
        dispatch($job);
    }
}
