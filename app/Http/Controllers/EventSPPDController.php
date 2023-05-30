<?php

namespace App\Http\Controllers;

use App\Models\EventSPPD;
use App\Http\Requests\StoreEventSPPDRequest;
use App\Http\Requests\UpdateEventSPPDRequest;
use Illuminate\Http\Request;

class EventSPPDController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        dd('page hapus');
        return view('content.NewCalender');
    }
    public function listEvent(Request $request)
    {


        $start = date('Y-m-d', strtotime($request->start));
        $end = date('Y-m-d', strtotime($request->end));

        $events = EventSPPD::where('start_date', '>=', $start)
            ->where('end_date', '<=', $end)->get()
            ->map(fn ($item) => [
                'id' => $item->id,
                'title' => $item->title,
                'start' => $item->start_date,
                'end' => date('Y-m-d', strtotime($item->end_date . '+1 days')),
                // 'category' => $item->category,
                // 'className' => ['bg-' . $item->category]
            ]);

        return response()->json($events);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventSPPDRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EventSPPD $eventSPPD)
    {
        dd('a');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EventSPPD $eventSPPD)
    {
        dd('a');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventSPPDRequest $request, EventSPPD $eventSPPD)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventSPPD $eventSPPD)
    {
        //
    }
}
