<?php

namespace App\Exports;

use App\Models\Apar;
use App\Models\Apat;
use App\Models\Apab;
use App\Models\FireAlarm;
use App\Models\BoxHydrant;
use App\Models\RumahPompa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RekapExport implements FromCollection, WithHeadings, WithStyles, WithTitle
{
    protected $module;

    public function __construct($module = 'all')
    {
        $this->module = $module;
    }

    public function collection()
    {
        $data = collect();

        if ($this->module === 'all' || $this->module === 'apar') {
            $items = Apar::all();
            foreach ($items as $item) {
                $data->push([
                    'APAR',
                    $item->serial_no,
                    $item->barcode,
                    $item->location_code ?? '-',
                    $item->status ?? '-',
                    $item->capacity ?? '-',
                ]);
            }
        }

        if ($this->module === 'all' || $this->module === 'apat') {
            $items = Apat::all();
            foreach ($items as $item) {
                $data->push([
                    'APAT',
                    $item->serial_no,
                    $item->barcode,
                    $item->location_code ?? '-',
                    $item->status ?? '-',
                    $item->capacity ?? '-',
                ]);
            }
        }

        if ($this->module === 'all' || $this->module === 'apab') {
            $items = Apab::all();
            foreach ($items as $item) {
                $data->push([
                    'APAB',
                    $item->serial_no,
                    $item->barcode,
                    $item->location_code ?? '-',
                    $item->status ?? '-',
                    $item->capacity ?? '-',
                ]);
            }
        }

        if ($this->module === 'all' || $this->module === 'fire_alarm') {
            $items = FireAlarm::all();
            foreach ($items as $item) {
                $data->push([
                    'Fire Alarm',
                    $item->serial_no,
                    $item->barcode,
                    $item->location_code ?? '-',
                    $item->status ?? '-',
                    '-',
                ]);
            }
        }

        if ($this->module === 'all' || $this->module === 'box_hydrant') {
            $items = BoxHydrant::all();
            foreach ($items as $item) {
                $data->push([
                    'Box Hydrant',
                    $item->serial_no,
                    $item->barcode,
                    $item->location_code ?? '-',
                    $item->status ?? '-',
                    '-',
                ]);
            }
        }

        if ($this->module === 'all' || $this->module === 'rumah_pompa') {
            $items = RumahPompa::all();
            foreach ($items as $item) {
                $data->push([
                    'Rumah Pompa',
                    $item->serial_no,
                    $item->barcode,
                    $item->location_code ?? '-',
                    $item->status ?? '-',
                    '-',
                ]);
            }
        }

        return $data;
    }

    public function headings(): array
    {
        return [
            'Modul',
            'Serial No',
            'Barcode',
            'Lokasi',
            'Status',
            'Kapasitas',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }

    public function title(): string
    {
        return 'Rekap Peralatan';
    }
}
