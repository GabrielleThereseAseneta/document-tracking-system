<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advisory;

class AdvisoryController extends Controller
{
    public function index(){
        $advisories = Advisory::all();
        return view('advisories.index', ['advisories' => $advisories]);
    }

    public function create(){
        return view('advisories.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|string',
            'title_description' => 'required|string',
            'date_of_advisory' => 'required|date',
            'date_received' => 'required|date'
        ]);

        Advisory::create($data);

        return redirect(route('advisory.index'))->with('success', 'Advisory added successfully');
    }

    public function edit(Advisory $advisory){
        return view('advisories.edit', ['advisory' => $advisory]);
    }

    public function update(Advisory $advisory, Request $request){
        $data = $request->validate([
            'name' => 'required|string',
            'title_description' => 'required|string',
            'date_of_advisory' => 'required|date',
            'date_received' => 'required|date'
        ]);

        $advisory->update($data);

        return redirect(route('advisory.index'))->with('success', 'Advisory updated successfully');
    }

    public function destroy(Advisory $advisory){
        $advisory->delete();
        return redirect(route('advisory.index'))->with('success', 'Advisory deleted successfully');
    }
}
