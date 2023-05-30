<?php

namespace App\Http\Controllers;

use App\Models\EventSPPD;
use App\Http\Requests\StoreEventSPPDRequest;
use App\Http\Requests\UpdateEventSPPDRequest;

class EventSPPDController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return view('content.NewCalender');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EventSPPD $eventSPPD)
    {
        //
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
