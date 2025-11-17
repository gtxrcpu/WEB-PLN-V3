{{-- resources/views/kartu/show.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kartu Kendali APAR</title>
    <style>
        * { box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; }
        body { margin: 28px; font-size: 11px; color: #111827; }
        h1 { font-size: 16px; margin: 0 0 4px 0; text-align: center; }
        .subtitle { text-align: center; font-size: 11px; margin-bottom: 16px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #9ca3af; padding: 5px 6px; }
        th { background-color: #e5e7eb; }
        .no-border th, .no-border td { border: none; padding: 2px 0; }
        .mt-4 { margin-top: 16px; }
        .mt-8 { margin-top: 32px; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .ttd-box {
            margin-top: 60px;
            width: 260px;
            float: right;
            text-align: center;
            font-size: 11px;
        }
        .ttd-space { height: 80px; }
        @page { margin: 20mm; }
    </style>
</head>
<body>

    <h1>KARTU KENDALI PEMERIKSAAN APAR</h1>
    <div class="subtitle">
        APAR: {{ $apar->name ?? $apar->barcode ?? ('APAR A' . $apar->serial_no) }}
        &nbsp; | &nbsp;
        Lokasi: {{ $apar->location_code ?? $apar->lokasi ?? '-' }}
    </div>

    {{-- Informasi APAR --}}
    <table class="no-border">
        <tr>
            <td style="width: 18%;"><strong>Kode / Barcode</strong></td>
            <td>: {{ $apar->barcode ?? ('APAR A' . $apar->serial_no) }}</td>
        </tr>
        <tr>
            <td><strong>Jenis / Media</strong></td>
            <td>: {{ $apar->type ?? $apar->jenis ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Kapasitas</strong></td>
            <td>: {{ $apar->capacity ?? $apar->kapasitas ?? '-' }}</td>
        </tr>
    </table>

    {{-- Tabel hasil pemeriksaan (format kartu kendali) --}}
    <table class="mt-4">
        <tr>
            <th style="width: 4%;">No</th>
            <th style="width: 12%;">Tgl Periksa</th>
            <th style="width: 8%;">PG</th>
            <th style="width: 8%;">Pin</th>
            <th style="width: 8%;">Selang</th>
            <th style="width: 8%;">Klem</th>
            <th style="width: 8%;">Handle</th>
            <th style="width: 10%;">Fisik</th>
            <th style="width: 12%;">Kesimpulan</th>
            <th>Catatan</th>
        </tr>
        <tr>
            <td class="text-center">1</td>
            <td class="text-center">
                {{ $kartu->tgl_periksa ? $kartu->tgl_periksa->format('d-m-Y') : '-' }}
            </td>
            <td class="text-center">{{ $kartu->pg ?? '-' }}</td>
            <td class="text-center">{{ $kartu->pin ?? '-' }}</td>
            <td class="text-center">{{ $kartu->selang ?? '-' }}</td>
            <td class="text-center">{{ $kartu->klem ?? '-' }}</td>
            <td class="text-center">{{ $kartu->handle ?? '-' }}</td>
            <td class="text-center">{{ $kartu->fisik ?? '-' }}</td>
            <td class="text-center">{{ $kartu->kesimpulan ?? '-' }}</td>
            <td>{!! nl2br(e($kartu->catatan ?? '-')) !!}</td>
        </tr>
    </table>

    {{-- Tanggal surat --}}
    <table class="no-border mt-4">
        <tr>
            <td style="width: 18%;"><strong>Tanggal Surat</strong></td>
            <td>
                : {{ $kartu->tgl_surat ? $kartu->tgl_surat->format('d-m-Y') : '-' }}
            </td>
        </tr>
    </table>

    {{-- Tanda tangan: hanya Team Leader K3L & KAM di kanan bawah --}}
    <div class="ttd-box">
        <div>Team Leader K3L &amp; KAM</div>
        <div class="ttd-space"></div>
        <div><u>( ........................................ )</u></div>
    </div>

</body>
</html>
