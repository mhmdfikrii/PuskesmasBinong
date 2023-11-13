<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("dashboard.ruangan.index", [
            'data' => Ruangan::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("dashboard.ruangan.create", [
            'title' => 'Tambah Ruangan'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validate = $request->validate([
            'kode' => 'required',
            'name' => 'required',
        ]);

        $validate['status'] = 0;

        Ruangan::create($validate);

        return redirect("/dashboard/ruangan")->with('status', "ruangan telah dibuat");
    }

    /**
     * Display the specified resource.
     */
    public function show(Ruangan $ruangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($kode)
    {
        return view('dashboard.ruangan.edit', [
            'ruangan' => Ruangan::where('kode', '=', $kode)->first(),
            'title' => 'Edit Ruangan'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $kode)
    {
        $validate = $request->validate([
            'kode' => 'required',
            'name' => 'required',
        ]);

        Ruangan::where('kode', '=', $kode)->update($validate);

        return redirect("/dashboard/ruangan")->with("success", "ruangan telah diedit");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($kode)
    {

        Ruangan::destroy($kode);

        return redirect("/dashboard/ruangan")->with('success', "ruangan telah dihapus");
    }
}
