<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekap Peralatan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
            color: #333;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background-color: #4F46E5;
            color: white;
            padding: 10px;
            text-align: left;
            font-weight: bold;
        }
        td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
            color: #666;
        }
        .status-baik {
            color: #10B981;
            font-weight: bold;
        }
        .status-rusak {
            color: #EF4444;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>REKAP PERALATAN PEMADAM KEBAKARAN</h1>
        <p>PT PLN (Persero)</p>
        <p>Tanggal: {{ $date }}</p>
        <p>Modul: {{ strtoupper($module) }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Modul</th>
                <th>Serial No</th>
                <th>Barcode</th>
                <th>Lokasi</th>
                <th>Status</th>
                <th>Kapasitas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item['modul'] }}</td>
                    <td>{{ $item['serial_no'] }}</td>
                    <td>{{ $item['barcode'] }}</td>
                    <td>{{ $item['lokasi'] }}</td>
                    <td class="{{ strtolower($item['status']) === 'baik' ? 'status-baik' : 'status-rusak' }}">
                        {{ strtoupper($item['status']) }}
                    </td>
                    <td>{{ $item['kapasitas'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Total: {{ count($data) }} unit</p>
        <p>Dicetak pada: {{ date('d/m/Y H:i:s') }}</p>
    </div>
</body>
</html>
