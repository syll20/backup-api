<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCalendarRequest;
use App\Models\Calendar;


class CalendarController extends Controller
{  
    public function index()
    {
        return view('admin.calendar-list', ['calendars' => Calendar::orderBy('kickoff', 'asc')->get()]);
    }

    public function update(UpdateCalendarRequest $request)
    {
        $calendar = Calendar::find($request->id)->update(['kickoff' => $request->kickoff]);

        return redirect('/admin/calendars')->with('success', 'Calendars updated');
    }
}