<?php

namespace App\Http\Controllers;

use App\Models\EventSPPD;
use App\Models\User;
use App\Models\userPerjalanan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.index', [
            'users' => User::latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
        dd("aa");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'name' => 'required|max:255',
            // 'username' => ['required', 'min:3', 'max:200', 'unique:users'],
            'email' => ['required', 'email:dns', 'unique:users'],
            'password' => ['required', 'min:5', 'max:255'],
            // 'phone' => ['required', 'digits_between:10,16', 'numeric', 'unique:users'],
        ];
        // if (auth()->user()->role_id == 1) {
        //     $data['role_id'] = ['required'];
        // } else {
        //     $data['role_id'] = 3; 
        // }
        $validatedData = $request->validate($data);


        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['status'] = "active";


        User::create($validatedData);
        return redirect('/users')
            ->with('success', 'Berhasil Menambahkan User');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $users = User::findOrFail($id);
        return view('user.show', [
            'users' => $users,
            'date_now' =>  Carbon::now(),
            "logs" => EventSPPD::latest()->paginate(10) //with(['item', 'user'])
            // ->where('user_id', $users->id)->paginate(10)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('user.edit', [
            "users" => User::findOrFail($id),
            // "roles" => role::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $users = User::findOrFail($id);

        $data = [
            'name' => 'required|max:255',
            'phone' => ['required', 'digits_between:10,16', 'numeric', 'unique:users'],
        ];
        if (auth()->user()->role_id == 1) {
            $data['role_id'] = ['required'];
        }
        if ($request->email != $users->email) {
            $data['email'] = ['required', 'email:dns', 'min:3', 'unique:users'];
        } elseif ($request->username != $users->username) {
            $data['username'] = ['required', 'min:3', 'max:200', 'unique:users'];
        } elseif ($request->phone != $users->phone) {
            $data['phone'] = ['required', 'digits_between:10,16', 'numeric', 'unique:users'];
        }
        $validatedData = $request->validate($data);
        User::where('id', $id)->update($validatedData);
        return redirect('/users')->with('success', 'Update Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);
        return response()->json([
            'success' => true,
            'message' => 'Event berhasil dihapus'
        ]);
    }
}
