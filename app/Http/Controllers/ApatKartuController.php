<?php

namespace App\Http\Controllers;

use App\Models\Apat;
use App\Models\KartuApat;
use Illuminate\Http\Request;

class ApatKartuController extends Controller
{
    /**
     * Tampilkan form Kartu Kendali APAT (create).
     * URL: /apat/kartu/create?apat_id=...
     */
    public function create(Request $request)
    {
        $apatId = $request->query('apat_id');

        $apat = Apat::findOrFail($apatId);

        return view('apat.kartu.create', [
            'apat' => $apat,
        ]);
    }

    /**
     * Simpan Kartu Kendali APAT.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'apat_id'       => ['required', 'exists:apats,id'],

            'kondisi_fisik' => ['required', 'in:baik,tidak baik'],
            'drum'          => ['required', 'in:baik,tidak baik'],
            'aduk_pasir'    => ['required', 'in:baik,tidak baik'],
            'sekop'         => ['required', 'in:baik,tidak baik'],
            'fire_blanket'  => ['required', 'in:baik,tidak baik'],
            'ember'         => ['required', 'in:baik,tidak baik'],

            'kesimpulan'    => ['required', 'in:baik,tidak baik'],
            'tgl_periksa'   => ['required', 'date'],
            'tgl_surat'     => ['nullable', 'date'],
            'petugas'       => ['nullable', 'string', 'max:255'],
            'pengawas'      => ['nullable', 'string', 'max:255'],
        ]);

        $apat = Apat::findOrFail($validated['apat_id']);

        KartuApat::create($validated);

        return redirect()
            ->route('apat.kartu.create', ['apat_id' => $apat->id])
            ->with('success', 'Kartu Kendali APAT berhasil disimpan.');
    }
}
