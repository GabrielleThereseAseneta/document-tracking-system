<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memorandum;

class MemorandumController extends Controller
{
    public function index(){
        $memorandums = Memorandum::all();
        return view('memorandums.index', ['memorandums' => $memorandums]);
    }

    public function create(){
        return view('memorandums.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'memo_number' => 'required|string', // Make sure this exists in your DB or remove
            'name' => 'required|string',
            'title_description' => 'required|string',
            'memo_date' => 'required|date',
            'date_received' => 'required|date'
        ]);

        Memorandum::create($data);

        return redirect(route('memorandum.index'))->with('success', 'Memorandum added successfully');
    }

    public function edit(Memorandum $memorandum){
        return view('memorandums.edit', ['memorandum' => $memorandum]);
    }

    public function update(Request $request, Memorandum $memorandum){ // Fixed parameter order
        $data = $request->validate([
            'memo_number' => 'required|string', // Ensure this field exists
            'name' => 'required|string',
            'title_description' => 'required|string',
            'memo_date' => 'required|date',
            'date_received' => 'required|date'
        ]);

        $memorandum->update($data);

        return redirect(route('memorandum.index'))->with('success', 'Memorandum updated successfully');
    }

    public function destroy(Memorandum $memorandum){
        $memorandum->delete();
        return redirect(route('memorandum.index'))->with('success', 'Memorandum deleted successfully');
    }
}
