<?php

namespace App\Http\Controllers;

use App\Models\Apar;
use App\Models\KartuApar;
use Illuminate\Http\Request;

class KartuKendaliController extends Controller
{
    /**
     * Tampilkan form Kartu Kendali untuk 1 APAR.
     * URL: /kartu/create?apar_id=ID
     */
    public function create(Request $request)
    {
        $aparId = $request->query('apar_id');

        // kalau apar_id nggak ada / salah, langsung 404
        $apar = Apar::findOrFail($aparId);

        // Get template for APAR module
        $template = \App\Models\KartuTemplate::getTemplate('apar');

        // pake view yang kamu kirim: resources/views/kartu/create.blade.php
        return view('kartu.create', compact('apar', 'template'));
    }

    /**
     * Simpan kartu kendali ke database.
     * Route: POST /kartu  (name: kartu.store)
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'apar_id'        => ['required', 'exists:apars,id'],
            'pressure_gauge' => ['required', 'string', 'max:50'],
            'pin_segel'      => ['required', 'string', 'max:50'],
            'selang'         => ['required', 'string', 'max:50'],
            'tabung'         => ['required', 'string', 'max:50'],
            'label'          => ['required', 'string', 'max:50'],
            'kondisi_fisik'  => ['required', 'string', 'max:50'],
            'kesimpulan'     => ['required', 'string', 'max:50'],
            'tgl_periksa'    => ['required', 'date'],
            'petugas'        => ['required', 'string', 'max:100'],
        ]);

        // Tambahkan user_id
        $data['user_id'] = auth()->id();

        // Simpan kartu inspeksi APAR
        KartuApar::create($data);

        return redirect()
            ->route('apar.index')
            ->with('success', 'Kartu Kendali berhasil disimpan untuk APAR ' . $request->apar_id);
    }
}
