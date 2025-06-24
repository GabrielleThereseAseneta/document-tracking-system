<?php


namespace App\Http\Controllers;

class CalendarController extends Controller
{
    // Display the calendar view
    public function show()
    {
        return view('calendar');
    }
}
