<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CalendarMailMessage extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($title,$starts,$ends)
    {
        //
        $this->title = $title;
        $this->starts = $starts;
        $this->ends = $ends;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//        return $this->view('view.name');
        return $this->from("john@gmail.com",'John Doe')

            ->subject('Event Creation')
            ->view('MailNotificationForEvent')
            ->with("data", [$this->title, $this->starts,$this->ends]);
    }
}
