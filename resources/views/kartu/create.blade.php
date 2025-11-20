<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Kartu Kendali APAR</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: #fff !important; }
            .sheet-a4 {
                box-shadow: none !important;
                border: none !important;
                margin: 0 !important;
            }
        }
    </style>
</head>
<body class="bg-slate-50">

{{-- HEADER (NO PRINT) --}}
<div class="no-print bg-white border-b shadow-sm sticky top-0 z-10">
    <div class="max-w-5xl mx-auto px-4 py-3 flex items-center justify-between">
        <div>
            <h1 class="text-lg font-bold text-gray-900">Kartu Kendali APAR</h1>
            <p class="text-sm text-gray-600">{{ $apar->barcode ?? $apar->serial_no }}</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('apar.index') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50 text-sm font-medium">
                ← Kembali
            </a>
            <button onclick="window.print()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium">
                🖨️ Cetak
            </button>
        </div>
    </div>
</div>

{{-- CONTENT --}}
<div class="max-w-5xl mx-auto px-4 py-6">
    <div class="sheet-a4 bg-white rounded-xl shadow-lg border p-8">
        
        {{-- HEADER KARTU - FROM TEMPLATE --}}
        @if($template)
        <div class="border-2 border-gray-800 mb-6">
            <table class="w-full text-sm">
                <tr>
                    <td rowspan="{{ count($template->header_fields) }}" class="border-r-2 border-gray-800 p-4 text-center align-middle w-2/3">
                        <div class="font-bold text-2xl">{{ $template->title }}</div>
                        <div class="font-semibold text-lg mt-2">{{ $template->subtitle }}</div>
                        <div class="font-semibold text-base">TAHUN {{ date('Y') }}</div>
                    </td>
                    @php
                        $firstField = $template->header_fields[0] ?? null;
                    @endphp
                    @if($firstField)
                        <td class="border-r border-b border-gray-800 p-2 font-semibold bg-gray-100 w-1/6">{{ $firstField['label'] }}</td>
                        <td class="border-b border-gray-800 p-2">{{ $firstField['value'] }}</td>
                    @endif
                </tr>
                @foreach($template->header_fields as $index => $field)
                    @if($index > 0)
                        <tr>
                            <td class="border-r @if($index < count($template->header_fields) - 1) border-b @endif border-gray-800 p-2 font-semibold bg-gray-100">{{ $field['label'] }}</td>
                            <td class="@if($index < count($template->header_fields) - 1) border-b @endif border-gray-800 p-2">{{ $field['value'] }}</td>
                        </tr>
                    @endif
                @endforeach
            </table>
        </div>
        @else
        {{-- FALLBACK HEADER --}}
        <div class="flex items-start justify-between mb-6 pb-4 border-b-2 border-gray-200">
            <div class="flex-1">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">KARTU KENDALI APAR</h2>
                <div class="grid grid-cols-2 gap-x-6 gap-y-2 text-sm">
                    <div>
                        <span class="text-gray-600">Kode/Barcode:</span>
                        <span class="font-semibold ml-2">{{ $apar->barcode ?? $apar->serial_no }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Lokasi:</span>
                        <span class="font-semibold ml-2">{{ $apar->location_code ?? '-' }}</span>
                    </div>
                </div>
            </div>
        </div>
        @endif

        {{-- INFO APAR --}}
        <div class="mb-6 p-4 bg-slate-50 rounded-lg border border-slate-200">
            <h3 class="font-bold text-gray-900 mb-3">Informasi APAR</h3>
            <div class="grid grid-cols-2 gap-x-6 gap-y-2 text-sm">
                <div>
                    <span class="text-gray-600">Kode/Barcode:</span>
                    <span class="font-semibold ml-2">{{ $apar->barcode ?? $apar->serial_no }}</span>
                </div>
                <div>
                    <span class="text-gray-600">Lokasi:</span>
                    <span class="font-semibold ml-2">{{ $apar->location_code ?? '-' }}</span>
                </div>
                <div>
                    <span class="text-gray-600">Jenis:</span>
                    <span class="font-semibold ml-2">{{ $apar->type ?? '-' }}</span>
                </div>
                <div>
                    <span class="text-gray-600">Kapasitas:</span>
                    <span class="font-semibold ml-2">{{ $apar->capacity ?? '-' }}</span>
                </div>
            </div>
        </div>

        {{-- ERROR MESSAGES --}}
        @if($errors->any())
            <div class="no-print mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                <p class="font-semibold text-red-800 mb-2">Terdapat kesalahan:</p>
                <ul class="list-disc list-inside text-sm text-red-700">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORM --}}
        <form method="POST" action="{{ route('kartu.store') }}">
            @csrf
            <input type="hidden" name="apar_id" value="{{ $apar->id }}">

            {{-- TABEL PEMERIKSAAN --}}
            <div class="mb-6">
                <h3 class="text-lg font-bold text-gray-900 mb-3">Hasil Pemeriksaan</h3>
                <div class="border border-gray-300 rounded-lg overflow-hidden">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700 w-1/3">Komponen</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700">Kondisi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach([
                                'pressure_gauge' => 'Pressure Gauge',
                                'pin_segel' => 'Pin & Segel',
                                'selang' => 'Selang',
                                'tabung' => 'Tabung',
                                'label' => 'Label',
                                'kondisi_fisik' => 'Kondisi Fisik'
                            ] as $field => $label)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 font-medium text-gray-900">{{ $label }}</td>
                                    <td class="px-4 py-3">
                                        <div class="flex gap-4">
                                            <label class="inline-flex items-center cursor-pointer">
                                                <input type="radio" name="{{ $field }}" value="baik" 
                                                    {{ old($field) === 'baik' ? 'checked' : '' }}
                                                    class="w-4 h-4 text-green-600 border-gray-300 focus:ring-green-500">
                                                <span class="ml-2 text-gray-700">Baik</span>
                                            </label>
                                            <label class="inline-flex items-center cursor-pointer">
                                                <input type="radio" name="{{ $field }}" value="tidak_baik"
                                                    {{ old($field) === 'tidak_baik' ? 'checked' : '' }}
                                                    class="w-4 h-4 text-red-600 border-gray-300 focus:ring-red-500">
                                                <span class="ml-2 text-gray-700">Tidak Baik</span>
                                            </label>
                                        </div>
                                        @error($field)
                                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                        @enderror
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- KESIMPULAN & INFO --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kesimpulan *</label>
                    <select name="kesimpulan" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">-- Pilih Kesimpulan --</option>
                        <option value="baik" {{ old('kesimpulan') === 'baik' ? 'selected' : '' }}>Baik</option>
                        <option value="tidak baik" {{ old('kesimpulan') === 'tidak baik' ? 'selected' : '' }}>Tidak Baik</option>
                    </select>
                    @error('kesimpulan')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Pemeriksaan *</label>
                    <input type="date" name="tgl_periksa" required
                        value="{{ old('tgl_periksa', now()->toDateString()) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('tgl_periksa')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Petugas Pemeriksa *</label>
                    <input type="text" name="petugas" required
                        value="{{ old('petugas') }}"
                        placeholder="Nama petugas"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('petugas')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pengawas</label>
                    <input type="text" name="pengawas"
                        value="{{ old('pengawas') }}"
                        placeholder="Nama pengawas (opsional)"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>

            {{-- TTD SECTION - USING TEMPLATE --}}
            <div class="mt-8 pt-6 border-t-2 border-gray-200">
                <div class="flex justify-end">
                    <div class="text-center">
                        @php
                            $lokasi = 'Surabaya'; // default
                            $labelPimpinan = 'Team Leader K3L & KAM'; // default
                            if ($template && $template->footer_fields) {
                                $lokasiField = collect($template->footer_fields)->firstWhere('label', 'Lokasi');
                                if ($lokasiField && isset($lokasiField['value'])) {
                                    $lokasi = $lokasiField['value'];
                                }
                                $pimpinanField = collect($template->footer_fields)->firstWhere('label', 'Label Pimpinan');
                                if ($pimpinanField && isset($pimpinanField['value'])) {
                                    $labelPimpinan = $pimpinanField['value'];
                                }
                            }
                        @endphp
                        <p class="text-sm text-gray-600 mb-1">{{ $lokasi }}, {{ now()->format('d-m-Y') }}</p>
                        <p class="text-sm font-semibold text-gray-900 mb-16">{{ $labelPimpinan }}</p>
                        <div class="border-t-2 border-gray-400 pt-2 w-56">
                            <p class="text-sm text-gray-600">(Tanda Tangan & Nama)</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- BUTTONS --}}
            <div class="no-print mt-8 pt-6 border-t border-gray-200 flex items-center justify-between">
                <p class="text-sm text-gray-600">
                    <span class="text-red-600">*</span> Wajib diisi
                </p>
                <div class="flex gap-3">
                    <a href="{{ route('apar.index') }}" 
                        class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 font-medium">
                        Batal
                    </a>
                    <button type="submit" 
                        class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 font-semibold shadow-md">
                        Simpan Kartu Kendali
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>

</body>
</html>
