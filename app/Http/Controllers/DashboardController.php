<?php

namespace App\Http\Controllers;

use App\Models\Memorandum;
use App\Models\Advisory;
use App\Models\SpecialOrder;
use App\Models\WeeklyMailing;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Set timezone and get week range
        $startOfWeek = Carbon::now()->timezone('Asia/Manila')->startOfWeek();
        $endOfWeek = Carbon::now()->timezone('Asia/Manila')->endOfWeek();

        // Count entries for current week
        $newMemos = Memorandum::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
        $newAdvisories = Advisory::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
        $totalMailings = WeeklyMailing::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
        $totalSpecialOrders = SpecialOrder::count(); // Keep total or change to weekly if needed

        // Optional: log debug info
        \Log::info('Dashboard Counts', [
            'start' => $startOfWeek,
            'end' => $endOfWeek,
            'newMemos' => $newMemos,
            'newAdvisories' => $newAdvisories,
            'totalMailings' => $totalMailings,
            'totalSpecialOrders' => $totalSpecialOrders,
        ]);

        // Make sure this matches your Blade filename
        return view('home', compact(
            'newMemos',
            'newAdvisories',
            'totalMailings',
            'totalSpecialOrders'
        ));
    }
}
