<?php

namespace App\Http\Controllers;

use App\Models\Apar;
use App\Models\Apat;
use App\Models\Apab;
use App\Models\FireAlarm;
use App\Models\BoxHydrant;
use App\Models\RumahPompa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function user()
    {
        // Ambil data status dari setiap modul
        $aparData = [
            'baik' => Apar::where('status', 'baik')->count(),
            'isi_ulang' => Apar::where('status', 'isi ulang')->count(),
            'rusak' => Apar::where('status', 'rusak')->count(),
            'total' => Apar::count()
        ];

        $apatData = [
            'baik' => Apat::where('status', 'baik')->count(),
            'rusak' => Apat::where('status', 'rusak')->count(),
            'total' => Apat::count()
        ];

        $apabData = [
            'baik' => Apab::where('status', 'baik')->count(),
            'tidak_baik' => Apab::where('status', 'tidak_baik')->count(),
            'total' => Apab::count()
        ];

        $fireAlarmData = [
            'baik' => FireAlarm::where('status', 'baik')->count(),
            'rusak' => FireAlarm::where('status', 'rusak')->count(),
            'total' => FireAlarm::count()
        ];

        $boxHydrantData = [
            'baik' => BoxHydrant::where('status', 'baik')->count(),
            'rusak' => BoxHydrant::where('status', 'rusak')->count(),
            'total' => BoxHydrant::count()
        ];

        $rumahPompaData = [
            'baik' => RumahPompa::where('status', 'baik')->count(),
            'rusak' => RumahPompa::where('status', 'rusak')->count(),
            'total' => RumahPompa::count()
        ];

        // Total keseluruhan
        $totalItems = $aparData['total'] + $apatData['total'] + $apabData['total'] + 
                      $fireAlarmData['total'] + $boxHydrantData['total'] + $rumahPompaData['total'];

        // Data tren inspeksi 6 bulan terakhir (real-time dari database)
        $trendData = $this->getInspectionTrend();

        return view('dashboard.user', compact(
            'aparData',
            'apatData', 
            'apabData',
            'fireAlarmData',
            'boxHydrantData',
            'rumahPompaData',
            'totalItems',
            'trendData'
        ));
    }

    /**
     * Ambil data tren inspeksi 6 bulan terakhir dari semua modul
     */
    private function getInspectionTrend()
    {
        $months = [];
        $data = [
            'APAR' => [],
            'APAT' => [],
            'APAB' => [],
            'Fire Alarm' => [],
            'Box Hydrant' => [],
            'Rumah Pompa' => []
        ];

        // Generate 6 bulan terakhir
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months[] = $date->format('M Y');
            $year = $date->year;
            $month = $date->month;

            // Hitung inspeksi per modul per bulan dengan try-catch untuk handle tabel yang belum ada
            try {
                $data['APAR'][] = \DB::table('kartu_apars')
                    ->whereYear('tgl_periksa', $year)
                    ->whereMonth('tgl_periksa', $month)
                    ->count();
            } catch (\Exception $e) {
                $data['APAR'][] = 0;
            }

            try {
                $data['APAT'][] = \DB::table('kartu_apats')
                    ->whereYear('tgl_periksa', $year)
                    ->whereMonth('tgl_periksa', $month)
                    ->count();
            } catch (\Exception $e) {
                $data['APAT'][] = 0;
            }

            try {
                $data['APAB'][] = \DB::table('kartu_apabs')
                    ->whereYear('tgl_periksa', $year)
                    ->whereMonth('tgl_periksa', $month)
                    ->count();
            } catch (\Exception $e) {
                $data['APAB'][] = 0;
            }

            try {
                $data['Fire Alarm'][] = \DB::table('kartu_fire_alarms')
                    ->whereYear('tgl_periksa', $year)
                    ->whereMonth('tgl_periksa', $month)
                    ->count();
            } catch (\Exception $e) {
                $data['Fire Alarm'][] = 0;
            }

            try {
                $data['Box Hydrant'][] = \DB::table('kartu_box_hydrants')
                    ->whereYear('tgl_periksa', $year)
                    ->whereMonth('tgl_periksa', $month)
                    ->count();
            } catch (\Exception $e) {
                $data['Box Hydrant'][] = 0;
            }

            try {
                $data['Rumah Pompa'][] = \DB::table('kartu_rumah_pompas')
                    ->whereYear('tgl_periksa', $year)
                    ->whereMonth('tgl_periksa', $month)
                    ->count();
            } catch (\Exception $e) {
                $data['Rumah Pompa'][] = 0;
            }
        }

        return [
            'labels' => $months,
            'datasets' => $data
        ];
    }
}
