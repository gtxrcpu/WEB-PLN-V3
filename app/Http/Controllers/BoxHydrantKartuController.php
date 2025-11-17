<?php

namespace App\Http\Controllers;

use App\Models\BoxHydrant;
use Illuminate\Http\Request;

class BoxHydrantKartuController extends Controller
{
    public function create(Request $request)
    {
        $boxHydrantId = $request->query('box_hydrant_id');
        
        if (!$boxHydrantId) {
            return redirect()
                ->route('box-hydrant.index')
                ->with('error', 'Box Hydrant ID tidak ditemukan');
        }

        $boxHydrant = BoxHydrant::findOrFail($boxHydrantId);

        return view('box-hydrant.kartu.create', compact('boxHydrant'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'box_hydrant_id' => ['required', 'exists:box_hydrants,id'],
            'pilar_hydrant'  => ['required', 'in:baik,tidak_baik'],
            'box_hydrant'    => ['required', 'in:baik,tidak_baik'],
            'nozzle'         => ['required', 'in:baik,tidak_baik'],
            'selang'         => ['required', 'in:baik,tidak_baik'],
            'uji_fungsi'     => ['required', 'in:baik,tidak_baik'],
            'kesimpulan'     => ['required', 'in:baik,tidak_baik'],
            'tgl_periksa'    => ['required', 'date'],
            'petugas'        => ['required', 'string', 'max:255'],
            'pengawas'       => ['nullable', 'string', 'max:255'],
        ]);

        $data['user_id'] = auth()->id();
        \App\Models\KartuBoxHydrant::create($data);

        return redirect()
            ->route('box-hydrant.index')
            ->with('success', 'Kartu Kendali Box Hydrant berhasil disimpan');
    }
}
