<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\ObatCategory;

class TambahObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $search = $request->input('search');
        // $obats = Obat::where('nama_obat', 'like', '%' . $search . '%')
        //     ->orWhere('kode_obat', 'like', '%' . $search . '%')
        //     ->get();
        $obats = Obat::with('category')->get();
        return view('dashboard.tambahobat.index', [
            'obats' => $obats,
        ]);
        // return view('dashboard.tambahobat.index', compact('obats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(
            'dashboard.tambahobat.create',
            [
                'categories' => ObatCategory::all(),
                'title' => 'Tambah Obat Puskesmas',
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_obat' => 'required|unique:obats',
            'nama_obat' => 'required',
            'kategori_obat' => 'required',
            'stok' => 'required',
            'harga' => 'required'
        ]);

        $validatedData['deskripsi'] = $request['deskripsi'];

        Obat::create($validatedData);
        return redirect('/dashboard/tambahobat')->with('status', 'Obat Berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Obat $obat)
    {
        return view('dashboard.tambahobat.create', [
            'obats' => $obat
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($kode_obat)
    {
        $obat = Obat::where('kode_obat', $kode_obat)->firstOrFail();
        return view('dashboard.tambahobat.edit', [
            'obat' => $obat,
            'categories' => ObatCategory::all(),
            'title' => "Edit Obat Puskesmas"
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $kode_obat)
    {
        $validatedData = $request->validate([
            'nama_obat' => 'required',
            'kategori_obat' => 'required',
            'stok' => 'required',
            'harga' => 'required'
        ]);

        $validatedData['deskripsi'] = $request['deskripsi'];

        Obat::where('kode_obat', $kode_obat)
            ->update($validatedData);

        return redirect('/dashboard/tambahobat')->with('status', 'Postingan Berhasil di Edit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Obat $obat)
    {
        Obat::destroy($request->kode_obat);

        return redirect('/dashboard/tambahobat')->with('status', 'Obat Berhasil dihapus!');
    }
}
