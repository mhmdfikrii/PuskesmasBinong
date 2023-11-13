<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AntrianDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $poli = Poli::where('isActive', 1)->latest()->get();
        $antrian = [];

        foreach ($poli as $poli) {
            $query = DB::table('antrian')
                ->where('kode_poli', $poli->kode_poli)
                ->where('status', 0)
                ->orderByRaw("SUBSTRING_INDEX(antrian, '-', -1) ASC")
                ->value('antrian');

            $data = [
                "antrian" => $query,
                "kode_poli" => $poli->kode_poli
            ];
            array_push($antrian, $data);

            $checkAntrianPasien = Antrian::where('NIK', auth()->user()->NIK)->where('status', 0)->first();
        }

        return view('dashboard.antrian.index', [
            "antrian" => json_decode(json_encode($antrian), false),
            'polis' => Poli::where('isActive', 1)->latest()->get(),
            'active' => 'antrian',
            'antrianPasien' => $checkAntrianPasien
        ]);
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
        $validateData = $request->validate([
            "name" => 'required',
            "NIK" => "required",
            "tgllahir" => "required",
            'kode_poli' => "required",
        ]);


        $poliKode = $validateData['kode_poli'];


        $NIK = $validateData['NIK'];

        // Periksa apakah NIK sudah ada dalam antrian
        $existingAntrian = Antrian::where('NIK', $NIK)->first();
        if ($existingAntrian) {
            if ($existingAntrian->status == 0) {
                // Jika NIK sudah ada dalam antrian, lakukan penanganan yang sesuai
                return redirect()->back()->with('error', 'NIK masih dalam antrian.');
            }
        }

        // Ambil nomor urut terakhir dari kode antrian untuk poli ini
        $lastKodeAntrian = DB::table('antrian')
            ->where('kode_poli', $poliKode)
            ->orderByRaw("SUBSTRING_INDEX(antrian, '-', -1) DESC")
            ->value('antrian');


        // Periksa apakah berhasil mendapatkan nomor urut terakhir
        if ($lastKodeAntrian) {
            $urutan = (int)explode('-', $lastKodeAntrian)[1] + 1;
        } else {
            // Jika tidak ada nomor urut sebelumnya, beri nomor urut awal 1
            $urutan = 1;
        }

        $validateData['kode_antrian'] = $poliKode . '-' . str_pad($urutan, 4, '0', STR_PAD_LEFT) . '-' . time();
        $validateData['antrian'] = $poliKode . '-' . str_pad($urutan, 4, '0', STR_PAD_LEFT);

        // Simpan data antrian ke dalam database
        Antrian::create($validateData);

        return redirect("/dashboard/antrian");
    }

    /**
     * Display the specified resource.
     */
    public function show($kode_antrian)
    {
        ddd(auth()->user());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Antrian $antrian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Antrian $antrian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Antrian $antrian)
    {
        //
    }
}
