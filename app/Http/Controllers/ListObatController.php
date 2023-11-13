<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ListObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $obats = Obat::where('nama_obat', 'like', '%'.$search.'%')
                ->orderBy('nama_obat', 'asc')
                ->get();
    return view('dashboard.listobat.index', compact('obats'));
    // return view('dashboard.listobat.index', []);
    }
}
