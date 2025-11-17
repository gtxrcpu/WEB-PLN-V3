<?php

namespace App\Http\Controllers;

use App\Models\Apab;
use Illuminate\Http\Request;

class ApabController extends Controller
{
    public function index()
    {
        $apabs = Apab::orderBy('id')->get();
        return view('apab.index', compact('apabs'));
    }

    public function create()
    {
        return view('apab.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'serial_no'     => ['nullable', 'string', 'max:255', 'unique:apabs,serial_no'],
            'barcode'       => ['nullable', 'string', 'max:255', 'unique:apabs,barcode'],
            'location_code' => ['nullable', 'string', 'max:255'],
            'isi_apab'      => ['nullable', 'string', 'max:255'],
            'capacity'      => ['nullable', 'string', 'max:255'],
            'masa_berlaku'  => ['nullable', 'date'],
            'status'        => ['nullable', 'string', 'max:50'],
            'notes'         => ['nullable', 'string'],
        ]);

        $data['user_id'] = auth()->id();
        
        $apab = Apab::create($data);

        return redirect()
            ->route('apab.index')
            ->with('success', 'APAB baru berhasil ditambahkan dengan serial ' . $apab->serial_no);
    }

    public function edit(Apab $apab)
    {
        return view('apab.edit', compact('apab'));
    }

    public function update(Request $request, Apab $apab)
    {
        $data = $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'location_code' => ['nullable', 'string', 'max:255'],
            'isi_apab'      => ['nullable', 'string', 'max:255'],
            'capacity'      => ['nullable', 'string', 'max:255'],
            'masa_berlaku'  => ['nullable', 'date'],
            'status'        => ['nullable', 'string', 'max:50'],
            'notes'         => ['nullable', 'string'],
        ]);

        $apab->update($data);

        return redirect()
            ->route('apab.index')
            ->with('success', 'APAB ' . $apab->serial_no . ' berhasil diperbarui');
    }

    public function riwayat(Apab $apab)
    {
        $riwayatInspeksi = $apab->kartuInspeksi()->with('user')->get();
        return view('apab.riwayat', compact('apab', 'riwayatInspeksi'));
    }
}
