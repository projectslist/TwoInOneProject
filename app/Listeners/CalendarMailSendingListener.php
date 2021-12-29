<?php

namespace App\Listeners;

use App\Events\CalendarMailSendingEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\CalendarMailMessage;

class CalendarMailSendingListener
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
     * @param  \App\Events\CalendarMailSendingEvent  $event
     * @return void
     */
    public function handle(CalendarMailSendingEvent $event)
    {
        //
        $title = $event->title;
        $starts = $event->starts;
        $ends = $event->ends;
        $email = array('yourcustomeremail@gmail.com');
        \Mail::to($email)->send(new CalendarMailMessage($title,$starts,$ends));
    }
}
