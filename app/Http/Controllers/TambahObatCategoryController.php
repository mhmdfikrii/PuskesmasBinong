<?php

namespace App\Http\Controllers;

use App\Models\ObatCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TambahObatCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(
            'dashboard.tambahobatcategory.index',
            [
                'categories' => ObatCategory::latest()->paginate(7)->withQueryString()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.tambahobatcategory.create', [
            'title' => 'tambah category obat',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'image' => 'required'
        ]);

        // ddd($validate);


        $slugCategory = $this->generateSlug($validate['name']);

        // ddd($slugCategory);

        $postImage = $request->file('image')->store('obat_category');


        $newRequest = [
            'name' => $validate['name'],
            'slug' => $slugCategory,
            'image' => $postImage
        ];

        ObatCategory::create($newRequest);

        return redirect('/dashboard/tambahobatcategory');
    }

    /**
     * Display the specified resource.
     */
    public function show(ObatCategory $obatCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ObatCategory $obatCategory)
    {
        return view('dashboard.tambahobatcategory.edit', [
            'title' => 'edit category obat',
            'category' => $obatCategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ObatCategory $obatCategory)
    {
        $validate = $request->validate([
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $slugCategory = $this->generateSlug($validate['name']);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validate['image'] = $request->file('image')->store('obat-category');
        } else {
            $validate['image'] = $request->oldImage;
        }

        ObatCategory::where('id', "=", $obatCategory->id)
            ->update([
                'name' => $validate['name'],
                'slug' => $slugCategory,
                'image' => $validate['image']
            ]);

        return redirect('/dashboard/tambahobatcategory');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ObatCategory $obatCategory)
    {
        if ($obatCategory->image) {
            Storage::delete($obatCategory->image);
        }

        $obatCategory->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data has been deleted.'
        ]);
    }

    // generate slug for name category
    function generateSlug($title)
    {
        // Remove special characters
        $slug = preg_replace('/[^a-zA-Z0-9\s]/', '', $title);
        // Convert to lowercase
        $slug = strtolower($slug);
        // Replace spaces with dashes
        $slug = preg_replace('/\s+/', '-', $slug);
        // Remove duplicate dashes
        $slug = preg_replace('/-+/', '-', $slug);
        // Trim dashes from beginning and end
        $slug = trim($slug, '-');
        return $slug;
    }
}
