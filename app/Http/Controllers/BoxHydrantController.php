<?php

namespace App\Http\Controllers;

use App\Models\BoxHydrant;
use Illuminate\Http\Request;

class BoxHydrantController extends Controller
{
    public function index()
    {
        $boxHydrants = BoxHydrant::orderBy('id')->get();
        return view('box-hydrant.index', compact('boxHydrants'));
    }

    public function create()
    {
        return view('box-hydrant.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'barcode'       => ['required', 'string', 'max:255', 'unique:box_hydrants,barcode'],
            'serial_no'     => ['required', 'string', 'max:255', 'unique:box_hydrants,serial_no'],
            'location_code' => ['nullable', 'string', 'max:255'],
            'type'          => ['nullable', 'string', 'max:255'],
            'status'        => ['nullable', 'string', 'max:50'],
            'notes'         => ['nullable', 'string'],
        ]);

        $boxHydrant = new BoxHydrant();
        $boxHydrant->user_id       = auth()->id();
        $boxHydrant->name          = $data['name'];
        $boxHydrant->barcode       = $data['barcode'];
        $boxHydrant->serial_no     = $data['serial_no'];
        $boxHydrant->location_code = $data['location_code'] ?? null;
        $boxHydrant->type          = $data['type'] ?? null;
        $boxHydrant->status        = $data['status'] ?? null;
        $boxHydrant->notes         = $data['notes'] ?? null;
        $boxHydrant->save();

        $boxHydrant->refreshQrSvg();

        return redirect()
            ->route('box-hydrant.index')
            ->with('success', 'Box Hydrant baru berhasil ditambahkan dengan barcode ' . $boxHydrant->barcode);
    }

    public function edit(BoxHydrant $boxHydrant)
    {
        return view('box-hydrant.edit', compact('boxHydrant'));
    }

    public function update(Request $request, BoxHydrant $boxHydrant)
    {
        $data = $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'location_code' => ['nullable', 'string', 'max:255'],
            'type'          => ['nullable', 'string', 'max:255'],
            'status'        => ['nullable', 'string', 'max:50'],
            'notes'         => ['nullable', 'string'],
        ]);

        $boxHydrant->name          = $data['name'];
        $boxHydrant->location_code = $data['location_code'] ?? null;
        $boxHydrant->type          = $data['type'] ?? null;
        $boxHydrant->status        = $data['status'] ?? null;
        $boxHydrant->notes         = $data['notes'] ?? null;
        $boxHydrant->save();

        return redirect()
            ->route('box-hydrant.index')
            ->with('success', 'Box Hydrant ' . $boxHydrant->serial_no . ' berhasil diperbarui');
    }

    public function riwayat(BoxHydrant $boxHydrant)
    {
        $riwayatInspeksi = $boxHydrant->kartuInspeksi()->with('user')->get();
        return view('box-hydrant.riwayat', compact('boxHydrant', 'riwayatInspeksi'));
    }
}
