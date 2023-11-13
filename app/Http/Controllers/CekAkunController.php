<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CekAkunController extends Controller
{
 

     public function index(User $users)
    {
       return view('dashboard.verifikasi.index', [
        'users' => $users->whereIn('cek', [0, 2])->get()
    ]);

    }

    public function update(Request $request, User $user)
{
    // Validasi input dari form
        $validatedData = $request->validate([
            'cek' => 'required'
        ]);

        // Update nilai cek pada user
        $user->cek = $validatedData['cek'];
        $user->save();


     if ($validatedData['cek'] == 1) {
        return back()->with('status', 'Data Terverifikasi!');
    } else {
        return back()->with('status', 'Data Harus diperbaiki Pasien');
    }


}
}
