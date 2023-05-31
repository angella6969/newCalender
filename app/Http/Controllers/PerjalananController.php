<?php

namespace App\Http\Controllers;

use App\Models\Perjalanan;
use App\Http\Requests\StorePerjalananRequest;
use App\Http\Requests\UpdatePerjalananRequest;

class PerjalananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        dd("a");
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
    public function store(StorePerjalananRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Perjalanan $perjalanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Perjalanan $perjalanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePerjalananRequest $request, Perjalanan $perjalanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Perjalanan $perjalanan)
    {
        //
    }
}
