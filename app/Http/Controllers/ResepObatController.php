<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Dokter;
use App\Models\Obat;
use App\Models\ObatCategory;
use App\Models\Poli;
use App\Models\RekamMedis;
use App\Models\ResepObat;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResepObatController extends Controller
{
    public function index()
    {
        $user = auth()->user()->id;
        $dokter = Dokter::where('userid', $user)->value('id');
        $poli = Poli::where('dokter', $dokter)->value('kode_poli');
        $resepKode = ResepObat::where('kode_rekamedis', 'LIKE', $poli . '%')->latest()->paginate(7);


        return view('dashboard.resepobat.index', [
            'resepObat' => $resepKode,
        ]);
    }

    public function getResepObat()
    {
        $userSession = auth()->user();
        $rekamMedis = Antrian::with('rekamMedis')->where('NIK', $userSession->NIK)->get();

        return view('dashboard.resepobat.logResepObat', [
            'rekamMedis' => $rekamMedis
        ]);
    }

    public function show($kodeResepObat)
    {
        $data = ResepObat::where('kode_resep_obat', $kodeResepObat)->first();
        return view("dashboard.resepobat.show", [
            'data' => $data,
        ]);
    }

    public function createResepObat($kodeRekamMedis)
    {
        $obat = Obat::latest()->get();
        $obatCategory = ObatCategory::latest()->get();

        return view(
            "dashboard.resepobat.formResepObat",
            [
                'kode_rekamedis' => $kodeRekamMedis,
                'obat' => $obat,
                'obatCategory' => $obatCategory,
            ]
        );
    }

    public function storeResepObat(Request $request)
    {
        // memasukan data rekam medis dari parameter ke foreign key di table surat_rujukan
        $kodeRekamMedis = $request->input('kode_rekammedis');

        $obatList = $request->input('obatList');
        $kode_resep_obat = $this->geneateResepKode();
        $errorMessages = [];
        // pengencekan stok obat
        foreach ($obatList as $obat) {
            $obatId = $obat['obatId'];
            $qty = $obat['qty'];
            $obat = Obat::where('kode_obat', $obatId)->first();
            if ($obat['stok'] <= $qty) {
                $errorMessages[] = 'Qty obat ' . $obat->nama_obat . ' melebihi stok yang tersedia.';
            };
            // Jika terdapat pesan kesalahan, kirimkan respons error
            if (!empty($errorMessages)) {
                return response()->json(['errors' => $errorMessages], 422);
            }
        }

        // input ke database
        foreach ($obatList as $obat) {
            $obatId = $obat['obatId'];
            $dosis = $obat['dosis'];
            $qty = $obat['qty'];
            $obat = Obat::where('kode_obat', $obatId)->first();

            DB::table('p_resep_obat')->insert([
                'kode_resep_obat' => $kode_resep_obat,
                'kode_obat' => $obatId,
                'qty' => $qty,
                'dosis' => $dosis,
            ]);
        }

        ResepObat::create([
            'kode_resep_obat' => $kode_resep_obat,
            'kode_rekamedis' => $kodeRekamMedis,
        ]);

        $rekamMedis = RekamMedis::where('kode_rekammedis', $kodeRekamMedis)->first();
        DB::table('antrian')->where('kode_antrian', $rekamMedis['antrian'])->update(['status' => 1]);

        return response()->json(['success' => true]);
    }

    function geneateResepKode()
    {
        $resepKode = 'resep-' . time();
        return $resepKode;
    }

    public function generatePDF($resepObat)
    {
        $dataResepObat = ResepObat::with('p_resepobat')->where('kode_resep_obat', $resepObat)->first();
        $pdf = PDF::loadView('pdf.resepObat', [
            'resepObat' => $dataResepObat
        ]);

        return $pdf->download($resepObat . '.pdf');
    }
}
