<?php

namespace App\Http\Controllers;

use App\Models\Apar;
use App\Models\Apat;
use App\Models\Apab;
use App\Models\FireAlarm;
use App\Models\BoxHydrant;
use App\Models\RumahPompa;
use App\Models\KartuKendali;
use App\Models\KartuApat;
use App\Models\KartuApab;
use App\Models\KartuFireAlarm;
use App\Models\KartuBoxHydrant;
use App\Models\KartuRumahPompa;
use Illuminate\Http\Request;

class QuickActionController extends Controller
{
    // Scan QR
    public function scan()
    {
        return view('quick.scan');
    }

    public function searchQR(Request $request)
    {
        $qr = $request->input('qr');
        
        // Search in all modules
        $apar = Apar::where('barcode', $qr)->orWhere('serial_no', $qr)->first();
        if ($apar) {
            return redirect()->route('apar.index')->with('highlight', $apar->id);
        }

        $apat = Apat::where('barcode', $qr)->orWhere('serial_no', $qr)->first();
        if ($apat) {
            return redirect()->route('apat.index')->with('highlight', $apat->id);
        }

        $apab = Apab::where('barcode', $qr)->orWhere('serial_no', $qr)->first();
        if ($apab) {
            return redirect()->route('apab.index')->with('highlight', $apab->id);
        }

        $fireAlarm = FireAlarm::where('barcode', $qr)->orWhere('serial_no', $qr)->first();
        if ($fireAlarm) {
            return redirect()->route('fire-alarm.index')->with('highlight', $fireAlarm->id);
        }

        $boxHydrant = BoxHydrant::where('barcode', $qr)->orWhere('serial_no', $qr)->first();
        if ($boxHydrant) {
            return redirect()->route('box-hydrant.index')->with('highlight', $boxHydrant->id);
        }

        $rumahPompa = RumahPompa::where('barcode', $qr)->orWhere('serial_no', $qr)->first();
        if ($rumahPompa) {
            return redirect()->route('rumah-pompa.index')->with('highlight', $rumahPompa->id);
        }

        return back()->with('error', 'QR Code tidak ditemukan');
    }

    // Buat Inspeksi
    public function inspeksi()
    {
        // Get all items for selection
        $apars = Apar::orderBy('serial_no')->get();
        $apats = Apat::orderBy('serial_no')->get();
        $apabs = Apab::orderBy('serial_no')->get();
        $fireAlarms = FireAlarm::orderBy('serial_no')->get();
        $boxHydrants = BoxHydrant::orderBy('serial_no')->get();
        $rumahPompas = RumahPompa::orderBy('serial_no')->get();

        return view('quick.inspeksi', compact('apars', 'apats', 'apabs', 'fireAlarms', 'boxHydrants', 'rumahPompas'));
    }

    // Rekap & Export
    public function rekap()
    {
        // Helper function to safely count table
        $safeCount = function($tableName) {
            try {
                return \DB::table($tableName)->count();
            } catch (\Exception $e) {
                return 0;
            }
        };

        // Get statistics with safe counting
        $stats = [
            'apar' => [
                'total' => Apar::count(),
                'baik' => Apar::where('status', 'baik')->count(),
                'rusak' => Apar::where('status', 'rusak')->count(),
                'inspeksi' => $safeCount('kartu_apars'),
            ],
            'apat' => [
                'total' => Apat::count(),
                'baik' => Apat::where('status', 'baik')->count(),
                'rusak' => Apat::where('status', 'rusak')->count(),
                'inspeksi' => $safeCount('kartu_apats'),
            ],
            'apab' => [
                'total' => Apab::count(),
                'baik' => Apab::where('status', 'baik')->count(),
                'rusak' => Apab::where('status', 'tidak_baik')->count(),
                'inspeksi' => $safeCount('kartu_apabs'),
            ],
            'fire_alarm' => [
                'total' => FireAlarm::count(),
                'baik' => FireAlarm::where('status', 'baik')->count(),
                'rusak' => FireAlarm::where('status', 'rusak')->count(),
                'inspeksi' => $safeCount('kartu_fire_alarms'),
            ],
            'box_hydrant' => [
                'total' => BoxHydrant::count(),
                'baik' => BoxHydrant::where('status', 'baik')->count(),
                'rusak' => BoxHydrant::where('status', 'rusak')->count(),
                'inspeksi' => $safeCount('kartu_box_hydrants'),
            ],
            'rumah_pompa' => [
                'total' => RumahPompa::count(),
                'baik' => RumahPompa::where('status', 'baik')->count(),
                'rusak' => RumahPompa::where('status', 'rusak')->count(),
                'inspeksi' => $safeCount('kartu_rumah_pompas'),
            ],
        ];

        return view('quick.rekap', compact('stats'));
    }

    public function exportExcel(Request $request)
    {
        $module = $request->input('module', 'all');
        $format = $request->input('format', 'excel'); // excel or pdf
        
        return \Excel::download(new \App\Exports\RekapExport($module), 
            "rekap_{$module}_" . date('Y-m-d') . ".xlsx");
    }

    public function exportPdf(Request $request)
    {
        $module = $request->input('module', 'all');
        
        // Collect data
        $data = $this->collectExportData($module);
        
        $pdf = \PDF::loadView('exports.rekap-pdf', [
            'data' => $data,
            'module' => $module,
            'date' => date('d/m/Y')
        ]);
        
        return $pdf->download("rekap_{$module}_" . date('Y-m-d') . ".pdf");
    }

    private function collectExportData($module)
    {
        $data = [];

        if ($module === 'all' || $module === 'apar') {
            $items = Apar::all();
            foreach ($items as $item) {
                $data[] = [
                    'modul' => 'APAR',
                    'serial_no' => $item->serial_no,
                    'barcode' => $item->barcode,
                    'lokasi' => $item->location_code ?? '-',
                    'status' => $item->status ?? '-',
                    'kapasitas' => $item->capacity ?? '-',
                ];
            }
        }

        if ($module === 'all' || $module === 'apat') {
            $items = Apat::all();
            foreach ($items as $item) {
                $data[] = [
                    'modul' => 'APAT',
                    'serial_no' => $item->serial_no,
                    'barcode' => $item->barcode,
                    'lokasi' => $item->location_code ?? '-',
                    'status' => $item->status ?? '-',
                    'kapasitas' => $item->capacity ?? '-',
                ];
            }
        }

        if ($module === 'all' || $module === 'apab') {
            $items = Apab::all();
            foreach ($items as $item) {
                $data[] = [
                    'modul' => 'APAB',
                    'serial_no' => $item->serial_no,
                    'barcode' => $item->barcode,
                    'lokasi' => $item->location_code ?? '-',
                    'status' => $item->status ?? '-',
                    'kapasitas' => $item->capacity ?? '-',
                ];
            }
        }

        if ($module === 'all' || $module === 'fire_alarm') {
            $items = FireAlarm::all();
            foreach ($items as $item) {
                $data[] = [
                    'modul' => 'Fire Alarm',
                    'serial_no' => $item->serial_no,
                    'barcode' => $item->barcode,
                    'lokasi' => $item->location_code ?? '-',
                    'status' => $item->status ?? '-',
                    'kapasitas' => '-',
                ];
            }
        }

        if ($module === 'all' || $module === 'box_hydrant') {
            $items = BoxHydrant::all();
            foreach ($items as $item) {
                $data[] = [
                    'modul' => 'Box Hydrant',
                    'serial_no' => $item->serial_no,
                    'barcode' => $item->barcode,
                    'lokasi' => $item->location_code ?? '-',
                    'status' => $item->status ?? '-',
                    'kapasitas' => '-',
                ];
            }
        }

        if ($module === 'all' || $module === 'rumah_pompa') {
            $items = RumahPompa::all();
            foreach ($items as $item) {
                $data[] = [
                    'modul' => 'Rumah Pompa',
                    'serial_no' => $item->serial_no,
                    'barcode' => $item->barcode,
                    'lokasi' => $item->location_code ?? '-',
                    'status' => $item->status ?? '-',
                    'kapasitas' => '-',
                ];
            }
        }

        return $data;
    }
}
