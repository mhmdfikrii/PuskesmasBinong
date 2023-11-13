<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Poli;
use App\Models\Ruangan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PoliController extends Controller
{
    public function index()
    {
        return view('dashboard.poli.index', [
            'data' => Poli::with("dataDokter")->latest()->get()
        ]);
    }

    public function show()
    {
        // 
    }

    public function create()
    {
        return view("dashboard.poli.create", [
            'title' => "Tambah Poli",
            'dokter' => Dokter::latest()->get(),
            'ruangan' => Ruangan::where('status', 0)->latest()->get()
        ]);
    }

    public function store(Request $request)
    {

        $validateData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'dokter' => 'required',
            'ruangan' => 'required',
        ]);


        if ($request->isActive) {
            $validateData['isActive'] = 1;
        }

        $validateData['jadwal'] = $request->jadwalStart . " s/d " . $request->jadwalEnd;

        $validateData['kode_poli'] = $this->generatePoliCode($validateData['name']);

        Poli::create($validateData);
        Dokter::where('id', $request->dokter)->update(['status' =>  1]);
        Ruangan::where('kode', $request->ruangan)->update(['status' =>  1]);

        return redirect("/dashboard/poli")->with("success", "poli telah ditambahkan");
    }

    public function destroy($kode)
    {
        $poli = Poli::where('kode_poli', $kode)->first();
        Poli::destroy($kode);
        Dokter::where('id', $poli->dokter)->update(['status' => 0]);
        $ruangan = Ruangan::where('kode', $poli->ruangan)->update(['status' => 0]);

        return redirect("dashboard/poli")->with("success", "poli telah dihapus");
    }

    public function edit($kode)
    {
        return view("dashboard.poli.edit", [
            'title' => "Edit Poli",
            'oldPoli' => Poli::where('kode_poli', $kode)->first(),
            'dokter' => Dokter::latest()->get(),
            'ruangan' => Ruangan::latest()->get()
        ]);
    }

    public function update(Request $request, $kode)
    {

        $validateData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'ruangan' => 'required',
        ]);
        $validateData['dokter'] = $request->dokter;
        if ($request->isActive) {
            $validateData['isActive'] = 1;
        }

        $validateData['jadwal'] = $request->jadwalStart . " s/d " . $request->jadwalEnd;

        Poli::where('kode_poli', $kode)->update($validateData);
        Dokter::where('id', $request->dokter)->update(['status' =>  1]);

        return redirect("/dashboard/poli")->with("success", "poli telah diubah");
    }

    public function changeStatusPoli($kodePoli)
    {
        $poliOld = Poli::where('kode_poli', $kodePoli)->first();

        Poli::where('kode_poli', $kodePoli)->update(['isActive' => (!$poliOld->isActive)]);

        return redirect('/dashboard/poli');
    }

    function generatePoliCode($name)
    {
        // Menghilangkan kata "Poli" dari nama poli dan spasi di awal dan akhir
        $name = trim(str_ireplace('Poli', '', $name));

        // Mengambil huruf pertama dari setiap kata di dalam nama poli
        $words = explode(' ', $name);
        $prefix = '';
        foreach ($words as $word) {
            $prefix .= strtoupper(substr($word, 0, 1));
        }

        // Mengambil nomor urut dari jumlah data poli dengan prefix yang sama
        $num = str_pad(Poli::where('kode_poli', 'like', $prefix . '%')->count() + 1, 3, '0', STR_PAD_LEFT);

        // Menggabungkan prefix dan nomor urut menjadi kode poli
        $code = $prefix . $num;

        return $code;
    }
}
