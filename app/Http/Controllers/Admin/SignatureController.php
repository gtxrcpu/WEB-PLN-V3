<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Signature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SignatureController extends Controller
{
    public function index()
    {
        $signatures = Signature::latest()->paginate(20);
        return view('admin.signatures.index', compact('signatures'));
    }

    public function create()
    {
        return view('admin.signatures.create');
    }

    public function store(Request $request)
    {
        try {
            // Debug: cek request
            \Log::info('Signature Store Request', [
                'all' => $request->all(),
                'hasFile' => $request->hasFile('signature'),
                'file' => $request->file('signature')
            ]);

            $data = $request->validate([
                'name' => 'required|string|max:255',
                'position' => 'required|string|max:255',
                'nip' => 'nullable|string|max:255',
                'signature' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            ]);

            // Upload signature
            if ($request->hasFile('signature')) {
                $file = $request->file('signature');
                $filename = 'signature_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('signatures', $filename, 'public');
                $data['signature_path'] = $path;
            } else {
                return back()->with('error', 'File tanda tangan tidak ditemukan')->withInput();
            }

            unset($data['signature']);
            $data['is_active'] = $request->has('is_active') ? true : false;

            Signature::create($data);

            return redirect()
                ->route('admin.signatures.index')
                ->with('success', 'Tanda tangan berhasil ditambahkan');
                
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Error: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit(Signature $signature)
    {
        return view('admin.signatures.edit', compact('signature'));
    }

    public function update(Request $request, Signature $signature)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'position' => 'required|string|max:255',
                'nip' => 'nullable|string|max:255',
                'signature' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            ]);

            // Upload new signature if provided
            if ($request->hasFile('signature')) {
                // Delete old signature
                if ($signature->signature_path) {
                    Storage::disk('public')->delete($signature->signature_path);
                }

                $file = $request->file('signature');
                $filename = 'signature_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('signatures', $filename, 'public');
                $data['signature_path'] = $path;
            }

            unset($data['signature']);
            $data['is_active'] = $request->has('is_active') ? true : false;

            $signature->update($data);

            return redirect()
                ->route('admin.signatures.index')
                ->with('success', 'Tanda tangan berhasil diupdate');
                
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Error: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Signature $signature)
    {
        // Delete signature file
        if ($signature->signature_path) {
            Storage::disk('public')->delete($signature->signature_path);
        }

        $signature->delete();

        return redirect()
            ->route('admin.signatures.index')
            ->with('success', 'Tanda tangan berhasil dihapus');
    }
}
