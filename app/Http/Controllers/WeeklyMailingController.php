<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeeklyMailing;

class WeeklyMailingController extends Controller
{
    public function index(){
        $weeklymailings = WeeklyMailing::all();
        return view('weekly_mailings.index', ['weeklymailings' => $weeklymailings]);
    }

    public function create(){
        return view('weekly_mailings.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'service_division_unit' => 'required|string',
            'date_records_received' => 'required|date',
            'consignee' => 'required|string',
            'content' => 'required|string',
            'courier' => 'required|string',
            'tracking_number' => 'nullable|string',
            'date_shipped' => 'nullable|date',
            'code' => 'nullable|string'
        ]);

        WeeklyMailing::create($data);

        return redirect(route('weeklymailing.index'))->with('success', 'Weekly Mailing added successfully');
    }

    public function edit(WeeklyMailing $weeklymailing){
        return view('weekly_mailings.edit', ['weeklymailing' => $weeklymailing]);
    }

    public function update(Request $request, WeeklyMailing $weeklymailing)
    {
        // Validate and update the weekly mailing
        $request->validate([
            'service_division_unit' => 'required',
            'date_records_received' => 'required|date',
            'consignee' => 'required',
            'content' => 'required',
            'courier' => 'required',
            'tracking_number' => 'required',
            'date_shipped' => 'required|date',
            'code' => 'required',
        ]);
    
        $weeklymailing->update($request->all());
    
        // Redirect back with a success message
        return redirect()->route('weeklymailing.index')->with('success', 'Weekly Mailing updated successfully');
    }

    public function destroy(WeeklyMailing $weeklymailing){
        $weeklymailing->delete();
        return redirect(route('weeklymailing.index'))->with('success', 'Weekly Mailing deleted successfully');
    }
}
