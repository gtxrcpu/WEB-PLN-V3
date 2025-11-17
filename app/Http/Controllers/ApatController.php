<?php

namespace App\Http\Controllers;

use App\Models\Apat;
use Illuminate\Http\Request;

class ApatController extends Controller
{
    /**
     * List semua APAT.
     */
    public function index()
    {
        $apats = Apat::orderBy('id')->get();

        return view('apat.index', compact('apats'));
    }

    /**
     * Tampilkan form tambah APAT.
     */
    public function create()
    {
        return view('apat.create');
    }

    /**
     * Simpan APAT baru.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'barcode'    => ['required', 'string', 'max:255', 'unique:apats,barcode'],
            'serial_no'  => ['required', 'string', 'max:255', 'unique:apats,serial_no'],
            'lokasi'     => ['nullable', 'string', 'max:255'],
            'jenis'      => ['nullable', 'string', 'max:255'],
            'kapasitas'  => ['nullable', 'string', 'max:255'],
            'status'     => ['nullable', 'string', 'max:50'],
            'notes'      => ['nullable', 'string'],
        ]);

        $apat = new Apat();
        $apat->user_id    = auth()->id();
        $apat->name       = $data['name'];
        $apat->barcode    = $data['barcode'];
        $apat->serial_no  = $data['serial_no'];
        $apat->lokasi     = $data['lokasi'] ?? null;
        $apat->jenis      = $data['jenis'] ?? null;
        $apat->kapasitas  = $data['kapasitas'] ?? null;
        $apat->status     = $data['status'] ?? 'baik';
        $apat->notes      = $data['notes'] ?? null;
        $apat->save();

        // 🔑 ini yang bikin QR langsung jadi
        $apat->refreshQrSvg();

        return redirect()
            ->route('apat.index')
            ->with('success', 'APAT baru berhasil ditambahkan dengan barcode ' . $apat->barcode);
    }

    /**
     * Tampilkan form edit APAT.
     */
    public function edit(Apat $apat)
    {
        return view('apat.edit', compact('apat'));
    }

    /**
     * Update APAT yang sudah ada.
     */
    public function update(Request $request, Apat $apat)
    {
        $data = $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'lokasi'    => ['nullable', 'string', 'max:255'],
            'jenis'     => ['nullable', 'string', 'max:255'],
            'kapasitas' => ['nullable', 'string', 'max:255'],
            'status'    => ['nullable', 'string', 'max:50'],
            'notes'     => ['nullable', 'string'],
        ]);

        $apat->name      = $data['name'];
        $apat->lokasi    = $data['lokasi'] ?? null;
        $apat->jenis     = $data['jenis'] ?? null;
        $apat->kapasitas = $data['kapasitas'] ?? null;
        $apat->status    = $data['status'] ?? null;
        $apat->notes     = $data['notes'] ?? null;
        $apat->save();

        return redirect()
            ->route('apat.index')
            ->with('success', 'APAT ' . $apat->serial_no . ' berhasil diperbarui');
    }

    /**
     * Tampilkan riwayat inspeksi APAT.
     */
    public function riwayat(Apat $apat)
    {
        $riwayatInspeksi = $apat->kartuApats()->orderBy('tgl_periksa', 'desc')->get();
        return view('apat.riwayat', compact('apat', 'riwayatInspeksi'));
    }
}
