<?php

namespace App\Http\Controllers;

use App\Models\Apab;
use Illuminate\Http\Request;

class ApabKartuController extends Controller
{
    public function create(Request $request)
    {
        $apabId = $request->query('apab_id');
        
        if (!$apabId) {
            return redirect()
                ->route('apab.index')
                ->with('error', 'APAB ID tidak ditemukan');
        }

        $apab = Apab::findOrFail($apabId);

        return view('apab.kartu.create', compact('apab'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'apab_id'        => ['required', 'exists:apabs,id'],
            'pressure_gauge' => ['required', 'in:baik,tidak_baik'],
            'pin_segel'      => ['required', 'in:baik,tidak_baik'],
            'selang'         => ['required', 'in:baik,tidak_baik'],
            'klem_selang'    => ['required', 'in:baik,tidak_baik'],
            'handle'         => ['required', 'in:baik,tidak_baik'],
            'kondisi_fisik'  => ['required', 'in:baik,tidak_baik'],
            'kesimpulan'     => ['required', 'in:baik,tidak_baik'],
            'tgl_periksa'    => ['required', 'date'],
            'petugas'        => ['required', 'string', 'max:255'],
        ]);

        $data['user_id'] = auth()->id();
        
        \App\Models\KartuApab::create($data);

        return redirect()
            ->route('apab.index')
            ->with('success', 'Kartu Kendali APAB berhasil disimpan');
    }
}
