<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Dokter;
use App\Models\P_Pelayanan;
use App\Models\Poli;
use App\Models\RekamMedis;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{

    public function getRekamMedis()
    {
        $NIKPasien = auth()->user()->NIK;
        $dataRekammedis = Antrian::with('rekamMedis')->where('NIK', $NIKPasien)->paginate(7);

        return view('dashboard.rekammedis.logRekammedis', [
            'rekamMedis' => $dataRekammedis
        ]);
    }

    public function showPasien()
    {
        $session = auth()->user();
        $dokter = Dokter::where('userid', '=', $session->id)->first();
        $poli =  Poli::where('dokter', '=', $dokter->id)->first();
        $pasien = null;
        if ($poli) {
            $pasien = Antrian::where('kode_poli', '=', $poli->kode_poli)->orderBy("created_at", "desc")->paginate(10);
        }

        return view('dashboard.rekammedis.listpasien', [
            "pasien" => $pasien,
            "poli" => $poli,
            'status' => $dokter->status
        ]);
    }

    public function getRekamMedisByKode($kodeAntrian)
    {
        $dataRekammedis = RekamMedis::with('resepObat')->where('antrian', $kodeAntrian)->first();
        if ($dataRekammedis == null) {
            $dataRekammedis = RekamMedis::with('resepObat')->where('antrian', $kodeAntrian)->first();
        }
        $p_pelayanan = P_Pelayanan::latest()->get();

        return view('dashboard.dokter.showPasien', [
            'data' => $dataRekammedis,
            'p_pelayanan' => $p_pelayanan,


        ]);
    }

    public function storeRekamMedis(Request $request)
    {

        $validatedData = $request->validate([
            'anamnesa' => 'required',
            'pemeriksaan_Fisik' => 'required',
            'diagnosa' => 'required',
            'tindakan' => 'required',
        ]);

        $validatedData['antrian'] = $request->kode_antrian;
        $validatedData['kode_rekammedis'] = $this->generateKode($request->kode_antrian);
        $dokter = Dokter::where('userid', '=', auth()->user()->id)->value("id");
        $validatedData['dokter'] = $dokter;

        if ($request['bpjs']) {
            $validatedData['bpjs'] = $request['bpjs'];
        }
        RekamMedis::create($validatedData);

        return redirect("/dashboard/pelayanan/form/" . $validatedData['kode_rekammedis'] . "?tindakan=" . $validatedData['tindakan']);
    }

    public function createRekamMedis($kode)
    {
        $antrian = Antrian::where('kode_antrian', $kode)->first();
        $user = User::where("NIK", $antrian['NIK'])->first();

        return view("dashboard/rekammedis/formRekamMedis", [
            'antrian' => $antrian,
            'user' => $user
        ]);
    }


    function generateKode($kodeAntrian)
    {
        // Mendapatkan waktu saat ini dalam format Unix
        $currentUnixTime = time();
        // Mengonversi waktu Unix ke tipe data string
        $currentUnixTime = strval($currentUnixTime);
        return $kodeAntrian . "-" . $currentUnixTime;
    }

    public function generatePDF($rekamMedis)
    {
        $data = RekamMedis::where("kode_rekammedis", $rekamMedis)->first();
        $pdf = Pdf::loadView('pdf.rekamMedis', [
            'data' => $data,
        ]);
        return $pdf->download('rekammedis-' . $rekamMedis . '.pdf');
    }


    public function edit($kodeRekammedis)
    {
        $data = RekamMedis::where("kode_rekammedis", $kodeRekammedis)->first();
        return view("dashboard.rekammedis.editRekamMedis", [
            'data' => $data,
        ]);
    }

    public function update(Request $request, $kodeRekammedis)
    {
        $validatedData = $request->validate([
            'anamnesa' => 'required',
            'pemeriksaan_Fisik' => 'required',
            'diagnosa' => 'required',
        ]);

        $getOld = RekamMedis::where("kode_rekammedis", $kodeRekammedis)->first();

        $validatedData['antrian'] = $request->kode_antrian;
        $validatedData['kode_rekammedis'] = $kodeRekammedis;

        if ($request['bpjs']) {
            $validatedData['bpjs'] = $request['bpjs'];
        }
        $validatedData['antrian'] = $getOld['antrian'];


        RekamMedis::where("kode_rekammedis", $kodeRekammedis)->update($validatedData);

        return redirect("/dashboard/listpasien/" . $validatedData['antrian']);
    }
}
