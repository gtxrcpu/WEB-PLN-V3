<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KartuSetting;
use Illuminate\Http\Request;

class KartuSettingController extends Controller
{
    public function index()
    {
        $settings = KartuSetting::orderBy('label')->get();
        return view('admin.kartu-settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'settings' => 'required|array',
            'settings.*' => 'nullable|string|max:500',
        ]);

        foreach ($validated['settings'] as $key => $value) {
            KartuSetting::set($key, $value);
        }

        return redirect()->route('admin.kartu-settings.index')
            ->with('success', 'Settings berhasil diupdate!');
    }
}
