<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('dashboard.categories.index', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories',
            'slug' => 'required',
            'image' => 'image|file|max:1024'

        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('category-images');
        }

        Category::create($validatedData);

        return redirect('/dashboard/post/categories')->with('status', 'Kategori Berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Category $category)
    {
        $category = Category::find($category->id);
        // Cek apakah data ditemukan pada database
        if (!$category) {
            return redirect('/dashboard/post/categories')->with('status', 'Data tidak ditemukan.');
        }
        // dd($category->id); // Cek nilai dari $obat->id
        Category::destroy($category->id);
        // // dd();
        return redirect('/dashboard/post/categories')->with('status', 'Kategori Berhasil dihapus!');
    }
}
