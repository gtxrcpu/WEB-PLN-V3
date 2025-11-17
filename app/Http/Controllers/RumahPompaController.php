<?php

namespace App\Http\Controllers;

use App\Models\RumahPompa;
use Illuminate\Http\Request;

class RumahPompaController extends Controller
{
    public function index()
    {
        $rumahPompas = RumahPompa::orderBy('id')->get();
        return view('rumah-pompa.index', compact('rumahPompas'));
    }

    public function create()
    {
        return view('rumah-pompa.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'barcode'       => ['nullable', 'string', 'max:255', 'unique:rumah_pompas,barcode'],
            'serial_no'     => ['nullable', 'string', 'max:255', 'unique:rumah_pompas,serial_no'],
            'location_code' => ['nullable', 'string', 'max:255'],
            'type'          => ['nullable', 'string', 'max:255'],
            'zone'          => ['nullable', 'string', 'max:255'],
            'status'        => ['nullable', 'string', 'max:50'],
            'notes'         => ['nullable', 'string'],
        ]);

        $data['user_id'] = auth()->id();
        
        // Model akan auto-generate serial_no dan barcode via booted()
        $rumahPompa = RumahPompa::create($data);

        return redirect()
            ->route('rumah-pompa.index')
            ->with('success', 'Rumah Pompa baru berhasil ditambahkan dengan serial ' . $rumahPompa->serial_no);
    }

    public function edit(RumahPompa $rumahPompa)
    {
        return view('rumah-pompa.edit', compact('rumahPompa'));
    }

    public function update(Request $request, RumahPompa $rumahPompa)
    {
        $data = $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'location_code' => ['nullable', 'string', 'max:255'],
            'type'          => ['nullable', 'string', 'max:255'],
            'zone'          => ['nullable', 'string', 'max:255'],
            'status'        => ['nullable', 'string', 'max:50'],
            'notes'         => ['nullable', 'string'],
        ]);

        $rumahPompa->update($data);

        return redirect()
            ->route('rumah-pompa.index')
            ->with('success', 'Rumah Pompa ' . $rumahPompa->serial_no . ' berhasil diperbarui');
    }

    public function riwayat(RumahPompa $rumahPompa)
    {
        $riwayatInspeksi = $rumahPompa->kartuInspeksi()->with('user')->get();
        return view('rumah-pompa.riwayat', compact('rumahPompa', 'riwayatInspeksi'));
    }
}
