<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\NotaPembayaran;
use App\Models\Obat;
use App\Models\P_Pelayanan;
use App\Models\P_Resepobat;
use App\Models\Pelayanan;
use App\Models\RekamMedis;
use App\Models\ResepObat;
use App\Models\SuratRujukan;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    public function listAntrianPembayaran()
    {
        return view('dashboard.pembayaran.index', [
            'pasien' => RekamMedis::latest()->paginate(10),
        ]);
    }
    public function getTransaksi()
    {
        $data = NotaPembayaran::paginate(7);

        return view('dashboard.transaksi.logTransaksi', [
            'notaPembayaran' => $data
        ]);
    }
    public function createPembayaran($kode_rekammedis)
    {
        $dataResepObat = [];
        $pasien = RekamMedis::where("kode_rekammedis", $kode_rekammedis)->first();
        $resepObat = ResepObat::where('kode_rekamedis', $kode_rekammedis)->first();
        $rujukan = SuratRujukan::where('kode_rekammedis', $kode_rekammedis)->first();
        if ($resepObat !== null) {
            $dataResepObat = DB::table('p_resep_obat')->where('kode_resep_obat', $resepObat->kode_resep_obat)->get();
        }
        $pelayananUser = P_Pelayanan::where('kode_rekammedis', $kode_rekammedis)->get();
        return view('dashboard.pembayaran.formPembuatanNota', [
            'pelayanan' => Pelayanan::latest()->get(),
            'dataKode' => $resepObat != null ? $resepObat->kode_resep_obat : $rujukan->kode_rujukan,
            'status' => $resepObat != null ? "resepObat" : "rujukan",
            'dataResepObat' => $dataResepObat,
            'obats' => Obat::get(),
            'pelayananUser' => $pelayananUser,
            'pasien' => $pasien,
        ]);
    }
    public function storeNotaPembayaran(Request $request)
    {
        $kode_notapembayaran = $this->generatePembayaran();
        $data = [
            'kode_resepobat' => $request->kode_resepobat,
            'kode_rujukan' => $request->kode_rujukan,
            'total' => $request->total,
            'kode_notapembayaran' => $kode_notapembayaran
        ];

        if ($data['total'] == 0) {
            $invoice = [
                'invoice' => $this->generateInvoice(),
                'kode_notapembayaran' => $kode_notapembayaran,
                'total' => $request->total,
                'status' => 'Settled',
            ];
        } else {
            $invoice = [
                'invoice' => $this->generateInvoice(),
                'kode_notapembayaran' => $kode_notapembayaran,
                'total' => $request->total,
                'status' => 'Pending',
            ];
        }

        NotaPembayaran::create($data);
        Transaksi::create($invoice);

        return redirect("/dashboard/transaksi");
    }

    public function getTransaction($kodeNotaPembayaran)
    {
        $notaPembayaran = NotaPembayaran::where('kode_notapembayaran', $kodeNotaPembayaran)->first();
        $transaksi = Transaksi::where('kode_notapembayaran', $kodeNotaPembayaran)->first();

        return view('dashboard.transaksi.showPembayaran', [
            'notaPembayaran' => $notaPembayaran,
            'transaksi' => $transaksi
        ]);
    }

    public function successTransaction($kodeInvoice)
    {
        $transaksi = Transaksi::where("invoice", $kodeInvoice)->value('status');
        if ($transaksi !== "Settled") {
            Transaksi::where("invoice", $kodeInvoice)->update(['status' => "Settled"]);
        }

        return redirect("/dashboard/transaksi");
    }

    public function listTransaksi()
    {
        return view('dashboard.transaksi.index', [
            'notaPembayaran' => NotaPembayaran::latest()->paginate(10),
            "listTransaksi" => Transaksi::latest()->get(),
        ]);
    }

    function generateInvoice()
    {
        $kode = "invoice-" . time();
        return $kode;
    }

    function generatePembayaran()
    {
        $kode = "pembayaran-" . time();
        return $kode;
    }

    public function generatePDF($notaPembayaran)
    {
        $data = NotaPembayaran::where('kode_notapembayaran', $notaPembayaran)->first();
        $p_resepobat = P_Resepobat::with('resepObat')->with('obat')->get();
        $p_pelayanan = P_Pelayanan::with('pelayanan')->get();
        $pdf = Pdf::loadView('pdf.notaTransaksi', [
            'data' => $data,
            'p_pelayanan' => $p_pelayanan,
            'p_resepobat' => $p_resepobat,
        ]);
        return $pdf->download('nota-pembayaran-' . $notaPembayaran . '.pdf');
    }
}
