<?php

namespace App\Http\Controllers;

use App\Models\FireAlarm;
use Illuminate\Http\Request;

class FireAlarmKartuController extends Controller
{
    /**
     * Tampilkan form Kartu Kendali Fire Alarm
     */
    public function create(Request $request)
    {
        $fireAlarmId = $request->query('fire_alarm_id');
        
        if (!$fireAlarmId) {
            return redirect()
                ->route('fire-alarm.index')
                ->with('error', 'Fire Alarm ID tidak ditemukan');
        }

        $fireAlarm = FireAlarm::findOrFail($fireAlarmId);

        return view('fire-alarm.kartu.create', compact('fireAlarm'));
    }

    /**
     * Simpan Kartu Kendali Fire Alarm
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'fire_alarm_id'      => ['required', 'exists:fire_alarms,id'],
            'panel_kontrol'      => ['required', 'in:baik,tidak_baik'],
            'detector'           => ['required', 'in:baik,tidak_baik'],
            'manual_call_point'  => ['required', 'in:baik,tidak_baik'],
            'alarm_bell'         => ['required', 'in:baik,tidak_baik'],
            'battery_backup'     => ['required', 'in:baik,tidak_baik'],
            'uji_fungsi'         => ['required', 'in:baik,tidak_baik'],
            'kesimpulan'         => ['required', 'in:baik,tidak_baik'],
            'tgl_periksa'        => ['required', 'date'],
            'petugas'            => ['required', 'string', 'max:255'],
            'pengawas'           => ['nullable', 'string', 'max:255'],
        ]);

        $data['user_id'] = auth()->id();
        \App\Models\KartuFireAlarm::create($data);
        
        return redirect()
            ->route('fire-alarm.index')
            ->with('success', 'Kartu Kendali Fire Alarm berhasil disimpan');
    }
}
