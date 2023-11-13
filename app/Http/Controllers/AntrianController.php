<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Poli;
use Carbon\Carbon;
use Carbon\CarbonTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class AntrianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showAntrians()
    {
        $poli = Poli::where('isActive', 1)->latest()->get();
        $antrian = [];
        $user = auth()->user();
        $checkUserAntrian = true;

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
        }

        if ($user && $user !== null) {
            $checkUserAntrian = $this->checkUserAntrian($user->NIK);
        }


        return view("antrian.show", [
            'polis' => Poli::where('isActive', 1)->latest()->get(),
            'title' => 'Nomor Antrian',
            'active' => 'antrian',
            "antrian" => json_decode(json_encode($antrian), false),
            'checkUserAntrian' => $checkUserAntrian
        ]);
    }

    public function getAntrianStatus()
    {
        $polis = Poli::with('antrian')->get();
        $data = [];

        foreach ($polis as $poli) {
            $query = DB::table('antrian')
                ->where('kode_poli', $poli->kode_poli)
                ->where('status', 0)
                ->orderByRaw("SUBSTRING_INDEX(antrian, '-', -1) ASC")
                ->value('antrian');

            $newData = [
                "antrian" => $query,
                "kode_poli" => $poli->kode_poli
            ];
            $data[] = $newData;
        }


        return response()->json($data);
    }

    public function checkAntrianStatus($tiket)
    {
        $cekAdaAntrian = DB::table('antrian')
            ->where('kode_poli', $tiket->poli->kode_poli)
            ->where('kode_antrian', "!=", $tiket->kode_antrian)
            ->whereRaw("SUBSTRING_INDEX(kode_antrian, '-', -1) < SUBSTRING_INDEX(?, '-', -1)", [$tiket->kode_antrian])
            ->orderByRaw("SUBSTRING_INDEX(kode_antrian, '-', -1) DESC")
            ->first();
        if ($cekAdaAntrian === null) {
            return true;
        } else {
            $previousAntrian = DB::table('antrian')
                ->where('kode_poli', $tiket->poli->kode_poli)
                ->where('kode_antrian', "!=", $tiket->kode_antrian)
                ->orderByRaw("SUBSTRING_INDEX(kode_antrian, '-', -1) DESC")
                ->value('status');
            if ($previousAntrian === 1) {
                return true;
            } else {
                return false;
            }
        }
    }


    function checkUserAntrian($nik)
    {
        $antrian = Antrian::where('NIK', $nik)->where('status', 0)->first();
        if ($antrian === null) {
            return true;
        }
        return false;
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
        $urutan = 1;

        $NIK = $validateData['NIK'];

        // Periksa apakah NIK sudah ada dalam antrian
        $existingAntrian = Antrian::where('NIK', $NIK)->first();
        if ($existingAntrian) {
            if ($existingAntrian->status == 0) {
                // Jika NIK sudah ada dalam antrian, lakukan penanganan yang sesuai
                return redirect()->back()->with('error', 'NIK masih dalam antrian.');
            }
        }

        // cek database kosong atau tidak 
        $antrian = Antrian::all();

        if ($antrian->where("kode_poli", $poliKode)->isEmpty()) {
            $urutan = 1;
        } else {

            // Ambil nomor urut terakhir dari kode antrian untuk poli ini
            $lastKodeAntrian = DB::table('antrian')
                ->where('kode_poli', $poliKode)
                ->orderBy("created_at", "DESC")
                ->first();
            // ambil tanggal sekarang
            $timezone = new CarbonTimeZone('Asia/Jakarta');
            Carbon::setTestNow(Carbon::now()->setTimezone($timezone));
            $currentDate = Carbon::now()->format('Ymd');
            // ambil tanggal dari kode antrian terakhir
            $parts = explode('-', $lastKodeAntrian->kode_antrian);
            $timestamp = end($parts);
            $lastDate = Carbon::createFromTimestamp($timestamp)->format('Ymd');
            // jika tanggal sekarang sama dengan tanggal kode antrian terakhir maka antrian ditambah 1
            ($currentDate == $lastDate) ? $urutan = (int)explode('-', $lastKodeAntrian->antrian)[1] + 1 : $urutan = 1;
        }
        $validateData['antrian'] = $poliKode . '-' . str_pad($urutan, 4, '0', STR_PAD_LEFT);
        $validateData['kode_antrian'] = $poliKode . '-' . str_pad($urutan, 4, '0', STR_PAD_LEFT) . '-' . time();



        // Simpan data antrian ke dalam database
        Antrian::create($validateData);

        return redirect("/dashboard/antrian");
    }

    /**
     * Display the specified resource.
     */
    public function show(Antrian $antrian)
    {
        //
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

    public function generateKodeAntrian($kode_poli)
    {
        // Ambil nomor urut terakhir dari entri antrian untuk poli ini
        $lastUrutan = $this->antrian()->max('urutan');

        // Tingkatkan nomor urut
        $urutan = $lastUrutan ? $lastUrutan + 1 : 1;

        // Buat kode antrian dengan format yang diinginkan
        $kodeAntrian = $kode_poli . '-' . str_pad($urutan, 4, '0', STR_PAD_LEFT);

        return $kodeAntrian;
    }
}
