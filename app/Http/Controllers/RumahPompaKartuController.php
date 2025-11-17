<?php

namespace App\Http\Controllers;

use App\Models\RumahPompa;
use Illuminate\Http\Request;

class RumahPompaKartuController extends Controller
{
    public function create(Request $request)
    {
        $rumahPompaId = $request->query('rumah_pompa_id');
        
        if (!$rumahPompaId) {
            return redirect()
                ->route('rumah-pompa.index')
                ->with('error', 'Rumah Pompa ID tidak ditemukan');
        }

        $rumahPompa = RumahPompa::findOrFail($rumahPompaId);

        return view('rumah-pompa.kartu.create', compact('rumahPompa'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'rumah_pompa_id'  => ['required', 'exists:rumah_pompas,id'],
            'pompa_utama'     => ['required', 'in:baik,tidak_baik'],
            'pompa_cadangan'  => ['required', 'in:baik,tidak_baik'],
            'jockey_pump'     => ['required', 'in:baik,tidak_baik'],
            'panel_kontrol'   => ['required', 'in:baik,tidak_baik'],
            'uji_fungsi'      => ['required', 'in:baik,tidak_baik'],
            'kesimpulan'      => ['required', 'in:baik,tidak_baik'],
            'tgl_periksa'     => ['required', 'date'],
            'petugas'         => ['required', 'string', 'max:255'],
            'pengawas'        => ['nullable', 'string', 'max:255'],
        ]);

        $data['user_id'] = auth()->id();
        \App\Models\KartuRumahPompa::create($data);

        return redirect()
            ->route('rumah-pompa.index')
            ->with('success', 'Kartu Kendali Rumah Pompa berhasil disimpan');
    }
}
