<?php

namespace App\Http\Controllers;

use App\Models\CalendarEvent;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CalendarEventController extends Controller
{
    // Get all events (filtered by type if needed)
    public function index(Request $request)
    {
        $type = $request->get('type', 'all');

        $events = CalendarEvent::when($type !== 'all', function ($query) use ($type) {
            return $query->where('type', $type);
        })->get();

        return response()->json($events);
    }

    // Store a new event
    public function store(Request $request)
    {
        try {
            // Validate the incoming data
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'start' => 'required|date',
                'type' => 'required|string|max:50',
                'note_date' => 'nullable|date',
                'content' => 'nullable|string',
                'end' => 'nullable|date',
            ]);
            
            // Create the new event
            $event = CalendarEvent::create($validated);

            return response()->json($event);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            \Log::error('CalendarEventController store error: ' . $e->getMessage());
            return response()->json([
                'message' => 'Server error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Update an existing event
    public function update(Request $request, CalendarEvent $calendar_event)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'start' => 'sometimes|date',
            'type' => 'sometimes|string|max:50',
            'note_date' => 'nullable|date',
            'content' => 'nullable|string',
            'end' => 'nullable|date',
        ]);

        $calendar_event->update($validated);

        return response()->json($calendar_event);
    }

    // Delete an event
    public function destroy(CalendarEvent $calendar_event)
    {
        $calendar_event->delete();

        return response()->json(['message' => 'Event deleted']);
    }
}
