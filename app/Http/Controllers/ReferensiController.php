<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Location;
use App\Models\Petugas;
use Illuminate\Http\Request;

class ReferensiController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->get();
        $locations = Location::orderBy('name')->get();
        $petugas = Petugas::orderBy('name')->get();

        return view('referensi.index', compact('categories', 'locations', 'petugas'));
    }

    // Category Methods
    public function storeCategory(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:categories,code',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);

        Category::create($data);

        return redirect()->route('referensi.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function updateCategory(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:categories,code,' . $category->id,
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $category->update($data);

        return redirect()->route('referensi.index')->with('success', 'Kategori berhasil diperbarui');
    }

    public function deleteCategory(Category $category)
    {
        $category->delete();
        return redirect()->route('referensi.index')->with('success', 'Kategori berhasil dihapus');
    }

    // Location Methods
    public function storeLocation(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:locations,code',
            'building' => 'nullable|string|max:255',
            'floor' => 'nullable|string|max:50',
            'zone' => 'nullable|string|max:50',
            'address' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        Location::create($data);

        return redirect()->route('referensi.index')->with('success', 'Lokasi berhasil ditambahkan');
    }

    public function updateLocation(Request $request, Location $location)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:locations,code,' . $location->id,
            'building' => 'nullable|string|max:255',
            'floor' => 'nullable|string|max:50',
            'zone' => 'nullable|string|max:50',
            'address' => 'nullable|string',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $location->update($data);

        return redirect()->route('referensi.index')->with('success', 'Lokasi berhasil diperbarui');
    }

    public function deleteLocation(Location $location)
    {
        $location->delete();
        return redirect()->route('referensi.index')->with('success', 'Lokasi berhasil dihapus');
    }

    // Petugas Methods
    public function storePetugas(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|max:50|unique:petugas,nip',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'position' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'address' => 'nullable|string',
        ]);

        Petugas::create($data);

        return redirect()->route('referensi.index')->with('success', 'Petugas berhasil ditambahkan');
    }

    public function updatePetugas(Request $request, Petugas $petugas)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|max:50|unique:petugas,nip,' . $petugas->id,
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'position' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $petugas->update($data);

        return redirect()->route('referensi.index')->with('success', 'Petugas berhasil diperbarui');
    }

    public function deletePetugas(Petugas $petugas)
    {
        $petugas->delete();
        return redirect()->route('referensi.index')->with('success', 'Petugas berhasil dihapus');
    }
}
