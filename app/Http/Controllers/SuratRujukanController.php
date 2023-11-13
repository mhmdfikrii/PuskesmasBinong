<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Dokter;
use App\Models\Poli;
use App\Models\RekamMedis;
use App\Models\SuratRujukan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class SuratRujukanController extends Controller
{
    public function index()
    {
        $user = auth()->user()->id;
        $dokter = Dokter::where('userid', $user)->value('id');
        $poli = Poli::where('dokter', $dokter)->value('kode_poli');
        $suratRujukan = SuratRujukan::where('kode_rekammedis', 'LIKE', $poli . '%')->latest()->paginate(7);
        return view(
            'dashboard.rujukan.index',
            [
                'pasien' => $suratRujukan,
            ]
        );
    }

    public function getSuratRujukan()
    {
        $userSession = auth()->user();
        $rekamMedis = Antrian::with('rekamMedis')->where('NIK', $userSession->NIK)->get();
        return view("dashboard.rujukan.logSuratRujukan", [
            'rekamMedis' => $rekamMedis
        ]);
    }

    public function show($kodeRujukan)
    {
        $data = SuratRujukan::where('kode_rujukan', $kodeRujukan)->first();
        return view("dashboard.rujukan.show", [
            'data' => $data,
        ]);
    }

    public function createSuratRujukan($kodeRekamMedis)
    {
        return view("dashboard.rujukan.formRujukan", [
            'kode_rekammedis' => $kodeRekamMedis,
        ]);
    }

    public function storeSuratRujukan(Request $request)
    {

        $validatedData = $request->validate([
            'kode_rujukan' => 'required',
        ]);

        if ($request->kode_rekammedis) {
            // memasukan data rekam medis dari parameter ke foreign key di table surat_rujukan
            $validatedData['kode_rekammedis'] = $request->kode_rekammedis;
        }
        $validatedData['fasilitas'] = $request->fasilitas;
        $validatedData['rencana_tindak_lanjut'] = $request->rencana_tindak_lanjut;

        SuratRujukan::create($validatedData);

        $this->changeStatusPasien($validatedData['kode_rekammedis']);

        return redirect("/dashboard/listpasien");
    }

    // $kode berdasarkan kode_rekammedis
    function changeStatusPasien($kode)
    {
        $dataRekamMedis = RekamMedis::where('kode_rekammedis', $kode)->first();
        $changeStatusAntrian = Antrian::where('kode_antrian', $dataRekamMedis['antrian'])->update(['status' => 1]);
        return $changeStatusAntrian;
    }

    public function generatePDF($suratRujukan)
    {
        $data = SuratRujukan::where('kode_rujukan', $suratRujukan)->first();
        $pdf = Pdf::loadView('pdf.suratRujukan', ['data' => $data]);
        return $pdf->download('surat-rujukan-' . $suratRujukan . '.pdf');
    }
}
