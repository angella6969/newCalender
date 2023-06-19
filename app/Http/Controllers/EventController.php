<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\EventSPPD;
use App\Models\imageSlideShow;
use App\Models\User;
use App\Models\userPerjalanan;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

use function PHPUnit\Framework\isEmpty;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $eventUser = userPerjalanan::where('user_id', $userId)->pluck('event_id');
        $userEvent = EventSPPD::whereIn('id', $eventUser)->latest()->paginate(10);


        // dd($userEvent);

        return view('content.calender', [
            'userEvent' =>  $userEvent,
            'event' => EventSPPD::orderBy('start_date', 'asc')
                ->Filter(request(['search']))
                ->paginate(10),
            'date_now' =>  Carbon::now()
        ]);
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
                // 'eventColor'=> '#378006',
                // 'className' => ['bg-' . $item->category]
                'className' => [$item->category]
            ]);

        return response()->json($events);
    }

    /**
     * Show the form for creating a new resource.
     */

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

    public function store1(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'asal' => 'required|max:255',
            'tujuan' => 'required|max:255',
            'start_date' => 'required',
            'end_date' => 'required',
            'category' => 'required',
            'output' => 'required',
            'selecttools' => 'required',
            'images' => ['image', 'file', 'max:1024']

        ]);
        dd($validatedData['images']);

        if ($request->file('images')) {
            dd($validatedData['images']);
            $validatedData['image'] = $request->file('image')->store('image-store');
        }


        try {
            $selectedUsers = $validatedData['selecttools'];

            $cekUser = userPerjalanan::whereHas('event', function ($query) use ($validatedData) {
                $query->where('start_date', '<=', $validatedData['end_date'])
                    ->where('end_date', '>=', $validatedData['start_date']);
            })->pluck('user_id');

            $existingUsers = $cekUser->toArray();

            $commonUsers = array_intersect($selectedUsers, $existingUsers);

            if ($commonUsers != null) {

                $existingUserNames = User::whereIn('id', $existingUsers)->pluck('name')->toArray();
                $existingUserPerjalanan = userPerjalanan::whereIn('user_id', $commonUsers)->pluck('event_id');
                $existingUser = EventSPPD::whereIn('id', $existingUserPerjalanan)
                    ->where('start_date', '<=', $validatedData['end_date'])
                    ->where('end_date', '>=', $validatedData['start_date'])
                    ->pluck('title')->toArray();

                $message = 'User ' . implode(', ', $existingUserNames) . ' sudah dalam perjalanan ' . implode(', ', $existingUser);
                return back()->withInput()->with('fail', $message);
            } else {
                if ($validatedData['start_date'] > $validatedData['end_date']) {
                    return back()->withInput()->with('createError', 'Tanggal Kembali harus lebih besar dari Tanggal Berangkat');
                } else {
                    $event = EventSPPD::create($validatedData);
                    $eventId = $event->id;

                    $selectedUsers = $request->input('selecttools');
                    $userPerjalananData = [];

                    foreach ($selectedUsers as $userId) {
                        $userPerjalananData[] = [
                            'event_id' => $eventId,
                            'user_id' => $userId,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                    userPerjalanan::insert($userPerjalananData);

                    // if ($request->file('image')) {
                    //     $images = $request->file('image');
                    //     foreach ($images as $image) {
                    //         // Buat nama unik untuk setiap file gambar
                    //         $filename = time() . '_' . $image->getClientOriginalName();

                    //         // Simpan gambar ke direktori penyimpanan
                    //         $path = $image->storeAs('public/images', $filename);

                    //         // Simpan informasi gambar ke dalam database
                    //         $imageData = new imageSlideShow();
                    //         $imageData->event_id = $event->id; // Menghubungkan gambar dengan event
                    //         $imageData->filename = $filename;
                    //         $imageData->filepath = $path;
                    //         $imageData->save();
                    //     }
                    // }
                    return redirect('/events')->with('success', 'Data berhasil ditambahkan');
                }
            }
        } catch (\Throwable $th) {
            return back()->withInput()->with('fail', 'Ada yang salah');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event, $id)
    {
        $event = EventSPPD::findOrFail($id);
        $personil = User::whereIn('id', function ($query) use ($id) {
            $query->select('user_id')
                ->from('user_perjalanans')
                ->where('event_id', $id);
        })->get();

        return response()->json([
            'event' => $event,
            'personil' => $personil
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit1(Event $event, $id)
    {
        $event = EventSPPD::findOrFail($id);
        $userPerjalanan = User::whereIn('id', function ($query) use ($id) {
            $query->select('user_id')
                ->from('user_perjalanans')
                ->where('event_id', '=', $id);
        })->get();

        // dd($userPerjalanan->pluck('id','name'));

        return view('content.edit', [
            'event' => $event,
            'userPerjalanan' => $userPerjalanan,
            'users' => user::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'asal' => 'required|max:255',
            'tujuan' => 'required|max:255',
            'start_date' => 'required',
            'end_date' => 'required',
            'output' => ['required'],
            'category' => 'required',
        ]);
        try {


            $event = EventSPPD::findOrFail($id);
            $event->update($validatedData);

            if ($request->input('selecttools') == null) {
                $userEvent = userPerjalanan::where('event_id', $id)->pluck('user_id')->toArray();
                $selectedUsers = $userEvent;
                userPerjalanan::where('event_id', $id)->delete();

                $userPerjalananData = [];

                foreach ($selectedUsers as $userId) {
                    $userPerjalananData[] = [
                        'event_id' => $id,
                        'user_id' => $userId,
                    ];
                }

                userPerjalanan::insert($userPerjalananData);

                return redirect('/events')->with('success', 'Data berhasil diperbarui');
            } else {
                DB::beginTransaction();
                $cekUser = userPerjalanan::whereHas('event', function ($query) use ($validatedData) {
                    $query->where('start_date', '<=', $validatedData['end_date'])
                        ->where('end_date', '>=', $validatedData['start_date']);
                })->pluck('user_id')->toArray();

                $selectedUsers = $request->input('selecttools');

                // Memisahkan nilai yang sama
                $intersectValues1 = array_intersect($cekUser, $selectedUsers);

                // Memisahkan nilai yang berbeda
                $intersectValues = array_diff($selectedUsers, $cekUser);


                $existingUserIds = userPerjalanan::where('event_id', $intersectValues)->pluck('user_id')->toArray();

                $commonUsers = array_intersect($selectedUsers, $existingUserIds);


                if (!empty($commonUsers)) {
                    $existingUserNames = User::whereIn('id', $commonUsers)->pluck('name')->toArray();
                    $existingUserPerjalanan = userPerjalanan::whereIn('user_id', $commonUsers)->pluck('event_id');
                    $existingUser = EventSPPD::whereIn('id', $existingUserPerjalanan)
                        ->where('start_date', '<=', $validatedData['end_date'])
                        ->where('end_date', '>=', $validatedData['start_date'])
                        ->pluck('title')->toArray();

                    DB::rollBack();
                    $message = 'User ' . implode(', ', $existingUserNames) . ' sudah dalam perjalanan ' . implode(', ', $existingUser);
                    return back()->with('fail', $message);
                } else {
                    userPerjalanan::where('event_id', $id)->delete();

                    $userPerjalananData = [];

                    foreach ($selectedUsers as $userId) {
                        $userPerjalananData[] = [
                            'event_id' => $id,
                            'user_id' => $userId,
                        ];
                    }

                    userPerjalanan::insert($userPerjalananData);
                    db::commit();
                    return redirect('/events')->with('success', 'Data berhasil diperbarui');
                }
            }
        } catch (\Throwable $th) {
            db::rollBack();
            return back()->with('fail', 'Ada yang salah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Menghapus data di tabel "user_perjalanans" berdasarkan event_id
        $result = userPerjalanan::where('event_id', $id)->delete();

        if ($result) {
            // Menghapus data di tabel "EventSPPD" berdasarkan ID
            EventSPPD::where('id', $id)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Event berhasil dihapus'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus event'
            ]);
        }
    }

    public function laporan(Request $request)
    {
        // Mendapatkan rentang tanggal dalam bulan tertentu
        $startOfMonth = Carbon::parse($request->input('month'))->startOfMonth();
        $endOfMonth = Carbon::parse($request->input('month'))->endOfMonth();

        // Mendapatkan daftar pengguna
        $users = User::pluck('name');

        // Mendapatkan daftar perjalanan pengguna dalam rentang tanggal yang ditentukan
        $userPerjalanan = UserPerjalanan::with('event')
            ->whereHas('event', function ($query) use ($startOfMonth, $endOfMonth) {
                $query->where(function ($query) use ($startOfMonth, $endOfMonth) {
                    $query->whereBetween('start_date', [$startOfMonth, $endOfMonth])
                        ->orWhereBetween('end_date', [$startOfMonth, $endOfMonth]);
                });
            })
            ->get();
        // dd($userPerjalanan);
        // Membuat array dari rentang tanggal
        $dates = [];
        $currentDate = $startOfMonth->copy();
        while ($currentDate <= $endOfMonth) {
            $dates[] = $currentDate->copy();
            $currentDate->addDay();
        }

        $dateString = '2023-06-15';
        $year = new DateTime($dateString);

        return view(
            'welcome',
            [
                'dates' => $dates,
                'users' => $users,
                'year' => $year,
                'userPerjalanan' => $userPerjalanan
            ]
        );
    }
}
