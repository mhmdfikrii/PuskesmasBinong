<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PelayananController extends Controller
{
    public function createPelayanan($kodeRekammedis)
    {
        return view('dashboard.pelayanan.formPelayanan', [
            'categoryPelayanan' => DB::table('category_pelayanan')->get(),
            'pelayanan' => DB::table('pelayanan')->get(),
            'kodeRekammedis' => $kodeRekammedis
        ]);
    }

    public function storePelayanan(Request $request)
    {
        // memasukan data rekam medis dari parameter ke foreign key di table surat_rujukan
        $kodeRekammedis = $request->input('kodeRekammedis');
        $layananList = $request->input('layananList');

        foreach ($layananList as $layanan) {
            $pelayananId = $layanan['id'];
            $biaya = $layanan['biaya'];

            DB::table('p_pelayanan')->insert([
                'pelayanan_id' => $pelayananId,
                'kode_rekammedis' => $kodeRekammedis,
                'biaya' => $biaya,
            ]);
        }

        return response()->json(['success' => true]);
    }
}
