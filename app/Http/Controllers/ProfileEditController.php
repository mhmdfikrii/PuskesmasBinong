<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileEditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.profile.edit');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(User $user)
    {
        return view('dashboard.profile.edit', [
            'user' => $user
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    // Update Hashing Password
    //    

    public function update(Request $request, User $user)
    {
        // Validasi input dari form
        $rules = [
            'name' => 'required|max:255',
            'NIK' => 'required|max:255',
            'username' => 'required|max:255',
            'tgllahir' => 'required|date',
            'alamat' => 'required|Max:255',
            'kepalakeluarga' => 'required',
            'bpjs' => 'required',
            'email' => 'required|max:255',
            'password' => 'nullable|min:6|required_with:confirm_password|same:confirm_password',
        ];

        $validatedData = $request->validate($rules);

        // Hashing password baru jika ada perubahan
        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        // Validasi password lama
        if (!empty($request->old_password)) {
            if (!Hash::check($request->old_password, auth()->user()->password)) {
                return redirect()->back()->withErrors(['old_password' => 'Password lama tidak benar']);
            }
            unset($validatedData['old_password']);
        }

        // cek role untuk verifikasi user
        if (auth()->user()->is_admin == 0) {
            $validatedData = array_merge(['cek' => 0], $validatedData);
        }

        // Update data user
        User::where('id', $request->id)
            ->update($validatedData);

        return redirect('/dashboard/profile')->with('status', 'Profile Berhasil di Update!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
