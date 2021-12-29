<?php

namespace App\Http\Controllers;

use App\Events\CalendarMailSendingEvent;
use App\Models\Calendar;
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

//        return Calendar::latest()->get();
//       $events =  Calendar::latest()->get();

        $result = Calendar::get(['id','title','starts','ends','color']);
        $events = [];

        foreach ($result as $values) {
            $event = [];

            $event['id'] = $values->id;



            $event['title'] = $values->title ;




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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
       // return $request->all();

       // return response()->json(['errors' => 'Sorry! You do not have permission for it.'], 422);



                $this->validate($request,[
                    'title' => 'required|string|max:191',
                    'color' => 'required|string|max:20',
                    'starts' => 'required',
                    'ends' => 'required',

                ]);








        $eventStart = $request['date'] . " " . $request['starts'];
        $eventEnd = $request['date'] . " " . $request['ends'];

        event(new CalendarMailSendingEvent($request->input('title'),$eventStart,
            $eventEnd));


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
     * @param  \App\Models\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function show(Calendar $calendar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function edit(Calendar $calendar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'title' => 'required|string|max:191',
            'color' => 'required|string|max:20',
            'starts' => 'required',
            'ends' => 'required',

        ]);
       $eventStart = $request['date'] . " " . $request['starts'];
        $eventEnd = $request['date'] . " " . $request['ends'];
      return  \DB::table('calendars')
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
     * @param  \App\Models\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Calendar $calendar)
    {
        //
        $calendar->delete();
    }
}
