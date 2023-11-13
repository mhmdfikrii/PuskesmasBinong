<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\NotaPembayaran;
use App\Models\Obat;
use App\Models\P_Resepobat;
use App\Models\RekamMedis;
use App\Models\ResepObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AmbilObatController extends Controller
{
    public function pasienAmbilObat()
    {
        $notaPembayaran = NotaPembayaran::with("transaksi")->orderBy("created_at", "desc")->paginate(10);

        return view('dashboard.pengambilanObat.index', [
            'notaPembayaran' => $notaPembayaran,
        ]);
    }

    public function listObatPasien($kodeResepObat)
    {
        $p_resepObat = DB::table('p_resep_obat')->where("kode_resep_obat", $kodeResepObat)->get();
        // ddd($p_resepObat);
        return view("dashboard.pengambilanObat.listObatPasien", [
            'resepObat' => $p_resepObat,
            'kodeResepObat' => $kodeResepObat,
            'obat' => Obat::get()
        ]);
    }

    public function changeStatus($resepObat)
    {
        $dataResepObat = ResepObat::where("kode_resep_obat", $resepObat)->first();
        foreach ($dataResepObat->p_resepobat as $data) {
            $changeQty = $this->changeQtyObat($data->kode_obat, $data->qty);
            if ($changeQty == false) {
                return redirect('/dashboard/pasienObat')->with('error', 'gagal mengambil obat');
            }
            P_Resepobat::where("kode_obat", $data->kode_obat)->update(['status' => 1]);
        }
        $status = $this->changeStatusResep($resepObat);
        if ($status == false) {
            return redirect('/dashboard/pasienObat')->with('error', 'gagal mengambil resep obat');
        }
        return redirect('/dashboard/pasienObat');
    }

    public function changeStatusResep($resepObat)
    {
        $status = ResepObat::where('kode_resep_obat', $resepObat)->update(['status' => 1]);
        if ($status) {
            return true;
        }
        return false;
    }

    public function changeQtyObat($kodeObat, $qty)
    {
        $obatOld = Obat::where('kode_obat', $kodeObat)->first();
        $newStok = $obatOld->stok - $qty;
        if ($obatOld && $obatOld->stok > $newStok) {
            Obat::where('kode_obat', $kodeObat)->update(['stok' => $newStok]);
            return true;
        }
        return false;
    }
}
