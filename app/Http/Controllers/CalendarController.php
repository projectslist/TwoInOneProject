<?php

namespace App\Http\Controllers;

use App\Events\CalendarMailSendingEvent;
use App\Models\Calendar;
use App\Notifications\CalendarNotificationNotify;
use Illuminate\Http\Request;


class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //


        $result = Calendar::get(['id', 'title', 'starts', 'ends', 'color']);
        $events = [];

        foreach ($result as $values) {
            $event = [];
            $event['id'] = $values->id;
            $event['title'] = $values->title;
            $event['color'] = $values->color;
            $event['start'] = $values->starts;
            $event['end'] = $values->ends;
            $events[] = $event;
        }

        return $events;


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|string|max:191',
            'color' => 'required|string|max:20',
            'starts' => 'required',
            'ends' => 'required',

        ]);


        $eventStart = $request['date'] . " " . $request['starts'];
        $eventEnd = $request['date'] . " " . $request['ends'];

        event(new CalendarMailSendingEvent($request->input('title'), $eventStart,
            $eventEnd));

        //I have also installed Observer with notify. So, when you create a event
        // Event/listener and Observer with Notify are saving notification to job queue
        // when  you run "php artisan queue:work" you will be received emails.
        // I use mailtrap for this project
        //By the way, you do not have to use all of them at the same time.
        //You can use notify or event/listener . It is depend on the project.


        return Calendar::create([
            'title' => $request['title'],
            'color' => $request['color'],
            'ends' => $eventEnd,
            'starts' => $eventStart,


        ]);


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Calendar $calendar
     * @return \Illuminate\Http\Response
     */
    public function show(Calendar $calendar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Calendar $calendar
     * @return \Illuminate\Http\Response
     */
    public function edit(Calendar $calendar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Calendar $calendar
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'title' => 'required|string|max:191',
            'color' => 'required|string|max:20',
            'starts' => 'required',
            'ends' => 'required',

        ]);
        $eventStart = $request['date'] . " " . $request['starts'];
        $eventEnd = $request['date'] . " " . $request['ends'];
        return \DB::table('calendars')
            ->where('id', $id)
            ->update([
                'title' => $request['title'],
                'color' => $request['color'],
                'ends' => $eventEnd,
                'starts' => $eventStart,
            ]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Calendar $calendar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Calendar $calendar)
    {
        //
        $calendar->delete();
    }
}
