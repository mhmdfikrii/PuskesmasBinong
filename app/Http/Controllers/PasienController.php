<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Illuminate\Support\Facades\DB;

class PasienController extends Controller
{
    public function getTiket()
    {
        $user = auth()->user();
        $tiket = Antrian::where('NIK', $user->NIK)
            ->where('status', 0)
            ->first();
        $status = $this->checkAntrianStatus($tiket);

        return view("dashboard.pasien.tiket", [
            'tiket' => $tiket,
            'status' => $status,
        ]);
    }

    public function cancelAntrian($kodeAntrian)
    {
        Antrian::where('kode_antrian', $kodeAntrian)->delete();

        return redirect()->back();
    }

    function checkAntrianStatus($tiket)
    {
        $cekAdaAntrian = DB::table('antrian')
            ->where('kode_poli', $tiket->kode_poli)
            ->where('kode_antrian', "!=", $tiket->kode_antrian)
            ->whereRaw("SUBSTRING_INDEX(kode_antrian, '-', -1) < SUBSTRING_INDEX(?, '-', -1)", [$tiket->kode_antrian])
            ->orderByRaw("SUBSTRING_INDEX(kode_antrian, '-', -1) DESC")
            ->first();
        if ($cekAdaAntrian === null) {
            return true;
        } else {
            $previousAntrian = DB::table('antrian')
                ->where('kode_poli', $tiket->kode_poli)
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

    public function checkTiketStatus()
    {
        $user = auth()->user();
        $tiket = Antrian::where('NIK', $user->NIK)
            ->where('status', 0)
            ->first();
        $status = $this->checkAntrianStatus($tiket);

        // Kembalikan status tiket dalam format JSON
        return response()->json($status);
    }
}
