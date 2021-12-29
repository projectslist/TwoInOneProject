<?php

namespace App\Observers;

use App\Models\Calendar;

use App\Notifications\CalendarNotificationNotify;



class CalendarObserver
{
    /**
     * Handle the Calendar "created" event.
     *
     * @param  \App\Models\Calendar  $calendar
     * @return void
     */
    public function created(Calendar $calendar)
    {
        //


        \Notification::route('mail', [
            'yourcustomeremail@example.com' => 'John Doe',
        ])->notify(new CalendarNotificationNotify());


    }

    /**
     * Handle the Calendar "updated" event.
     *
     * @param  \App\Models\Calendar  $calendar
     * @return void
     */
    public function updated(Calendar $calendar)
    {
        //
    }

    /**
     * Handle the Calendar "deleted" event.
     *
     * @param  \App\Models\Calendar  $calendar
     * @return void
     */
    public function deleted(Calendar $calendar)
    {
        //
    }

    /**
     * Handle the Calendar "restored" event.
     *
     * @param  \App\Models\Calendar  $calendar
     * @return void
     */
    public function restored(Calendar $calendar)
    {
        //
    }

    /**
     * Handle the Calendar "force deleted" event.
     *
     * @param  \App\Models\Calendar  $calendar
     * @return void
     */
    public function forceDeleted(Calendar $calendar)
    {
        //
    }
}
