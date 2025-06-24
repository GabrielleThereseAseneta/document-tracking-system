<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SpecialOrder;

class SpecialOrderController extends Controller
{
    public function index(){
        $specialorders = SpecialOrder::all();
        return view('special_orders.index', ['specialorders' => $specialorders]);
    }

    public function create(){
        return view('special_orders.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'so_number' => 'required|string',
            'name' => 'required|string',
            'title_description' => 'required|string',
            'date_of_so' => 'required|date',
            'date_received' => 'required|date'
        ]);

        SpecialOrder::create($data);

        return redirect(route('specialorder.index'))->with('success', 'Special Order added successfully');
    }

    public function edit(SpecialOrder $specialorder){
        return view('special_orders.edit', ['specialorder' => $specialorder]);
    }

    public function update(SpecialOrder $specialorder, Request $request){
        $data = $request->validate([
            'so_number' => 'required|string',
            'name' => 'required|string',
            'title_description' => 'required|string',
            'date_of_so' => 'required|date',
            'date_received' => 'required|date'
        ]);

        $specialorder->update($data);

        return redirect(route('specialorder.index'))->with('success', 'Special Order updated successfully');
    }

    public function destroy(SpecialOrder $specialorder){
        $specialorder->delete();
        return redirect(route('specialorder.index'))->with('success', 'Special Order deleted successfully');
    }
}
