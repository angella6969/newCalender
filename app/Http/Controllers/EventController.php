<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\EventSPPD;
use App\Models\User;
use App\Models\userPerjalanan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('content.calender');
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
                'category' => $item->category,
                'className' => ['bg-' . $item->category]
            ]);

        return response()->json($events);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Event $event)
    {
        $a = User::all();
        return view('event-form', [
            'data' => $event,
            'users' => $a,
            'action' => route('events.store')
        ]);
    }
    public function create1(Event $event)
    {
        $a = User::get();
        $options = $a->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
            ];
        });
        // dd($options);

        return view('content.create', [
            'users' => $options,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request, Event $event)
    {
        return $this->update($request, $event);
    }
    public function store1(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required',
                'asal' => ['required'],
                'tujuan' => ['required'],
                'start_date' => ['required'],
                'end_date' => ['required'],
                'category' => ['required'],
            ]);

            $event = EventSPPD::create($validatedData);
            $eventId = $event->id;

            $selectedUsers = $request->input('selecttools');

            foreach ($selectedUsers as $userId) {
                userPerjalanan::create([
                    'event_id' => $eventId,
                    'user_id' => $userId,
                ]);
            }



            if ($validatedData['start_date'] > $validatedData['end_date']) {
                // dd('gagal');
                return back()->with('loginError', 'Tanggal Kembali harus lebih besar dari Tanggal Berangkat');
            } else {
                // dd('sukses');
                return redirect('/events')->with('success', 'Data berhasil ditambahkan');
            }
        } catch (\Throwable $th) {
            return back()->with('fail', 'ada yang salah');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit1(Event $event, $date)
    {
        return view('content.create');
        dd($date);
    }
    public function edit(Event $event)
    {
        return view('event-form', [
            'data' => $event,
            'action' => route('events.update', $event->id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, Event $event)
    {
        if ($request->has('delete')) {
            return $this->destroy($event);
        }
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->title = $request->title;
        $event->category = $request->category;

        $event->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Save data successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Delete data successfully'
        ]);
    }
}
