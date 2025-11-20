<?php

namespace App\Http\Controllers;

use App\Models\P3k;
use App\Models\KartuP3k;
use Illuminate\Http\Request;

class KartuP3kController extends Controller
{
    public function create(Request $request)
    {
        $p3kId = $request->query('p3k_id');
        $p3k = P3k::findOrFail($p3kId);
        return view('p3k.kartu.create', compact('p3k'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'p3k_id'         => ['required', 'exists:p3ks,id'],
            'kotak_p3k'      => ['required', 'string'],
            'plester'        => ['required', 'string'],
            'perban'         => ['required', 'string'],
            'kasa_steril'    => ['required', 'string'],
            'antiseptik'     => ['required', 'string'],
            'gunting'        => ['required', 'string'],
            'sarung_tangan'  => ['required', 'string'],
            'masker'         => ['required', 'string'],
            'obat_luka'      => ['required', 'string'],
            'buku_panduan'   => ['required', 'string'],
            'kesimpulan'     => ['required', 'string'],
            'tgl_periksa'    => ['required', 'date'],
            'petugas'        => ['required', 'string', 'max:255'],
        ]);

        $validated['user_id'] = auth()->id();
        KartuP3k::create($validated);

        return redirect()
            ->route('p3k.index')
            ->with('success', 'Kartu Kendali P3K berhasil disimpan.');
    }
}
