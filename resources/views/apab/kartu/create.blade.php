{{-- resources/views/apab/kartu/create.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Kartu Kendali APAB</title>
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
                width: 190mm !important;
                min-height: 277mm !important;
            }
        }
        .sheet-a4 {
            max-width: 190mm;
            min-height: 260mm;
        }
    </style>
</head>
<body class="bg-slate-100 text-slate-800">

{{-- BAR ATAS --}}
<div class="no-print bg-gradient-to-r from-red-600 to-orange-600 shadow-lg mb-6">
    <div class="max-w-5xl mx-auto px-4 py-4 flex items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <div>
                <div class="text-xs text-red-100 font-medium">Kartu Kendali APAB</div>
                <div class="text-xl font-bold text-white">
                    {{ $apab->barcode ?? $apab->serial_no ?? 'APAB' }}
                </div>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('apab.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white/20 backdrop-blur-sm text-white text-sm font-medium hover:bg-white/30 transition-all duration-200 border border-white/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
            <button onclick="window.print()"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white text-red-600 text-sm font-semibold hover:bg-red-50 transition-all duration-200 shadow-lg">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                </svg>
                Cetak / PDF
            </button>
        </div>
    </div>
</div>

{{-- LEMBAR A4 --}}
<div class="max-w-5xl mx-auto px-2 sm:px-4 pb-10">
    <div class="sheet-a4 bg-white mx-auto rounded-xl shadow-sm border border-slate-200 p-4 sm:p-6">

        {{-- HEADER KARTU --}}
        <div class="border border-slate-400">
            <div class="px-4 py-2 border-b border-slate-400 text-center">
                <div class="text-base font-bold tracking-wide">KARTU KENDALI</div>
                <div class="text-sm font-semibold">ALAT PEMADAM API BERAT (APAB)</div>
                <div class="text-xs">TAHUN {{ now()->year }}</div>
            </div>

            {{-- Info Header --}}
            <div class="grid grid-cols-12 text-xs border-b border-slate-400">
                <div class="col-span-2 px-3 py-2 border-r border-slate-400 font-semibold">LOKASI</div>
                <div class="col-span-4 px-3 py-2 border-r border-slate-400">{{ $apab->location_code ?? 'WORKSHOP G4' }}</div>
                <div class="col-span-2 px-3 py-2 border-r border-slate-400 font-semibold">ISI APAB</div>
                <div class="col-span-4 px-3 py-2">{{ $apab->isi_apab ?? 'CO2' }}</div>
            </div>

            <div class="grid grid-cols-12 text-xs border-b border-slate-400">
                <div class="col-span-2 px-3 py-2 border-r border-slate-400 font-semibold">KAPASITAS</div>
                <div class="col-span-4 px-3 py-2 border-r border-slate-400">{{ $apab->capacity ?? '25 Kg' }}</div>
                <div class="col-span-2 px-3 py-2 border-r border-slate-400 font-semibold">MASA BERLAKU</div>
                <div class="col-span-4 px-3 py-2">{{ $apab->masa_berlaku ? $apab->masa_berlaku->format('d F Y') : '11 September 2025' }}</div>
            </div>
        </div>

        {{-- FORM --}}
        @if ($errors->any())
            <div class="no-print mt-4 mb-4 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800">
                <div class="font-semibold mb-1">Periksa kembali:</div>
                <ul class="list-disc pl-4 space-y-0.5">
                    @foreach ($errors->all() as $msg)
                        <li>{{ $msg }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('apab.kartu.store') }}" class="mt-4 space-y-4">
            @csrf
            <input type="hidden" name="apab_id" value="{{ $apab->id }}">

            {{-- TABEL PEMERIKSAAN --}}
            <div class="border border-slate-400 text-xs">
                <div class="grid grid-cols-12 bg-slate-100 border-b border-slate-400 font-semibold">
                    <div class="col-span-6 px-3 py-2 border-r border-slate-400">PEMERIKSAAN</div>
                    <div class="col-span-6 px-3 py-2 text-center">KONDISI</div>
                </div>

                @foreach ([
                    'pressure_gauge' => 'Pressure Gauge',
                    'pin_segel'      => 'Pin/Segel',
                    'selang'         => 'Selang',
                    'klem_selang'    => 'Klem Selang',
                    'handle'         => 'Handle',
                    'kondisi_fisik'  => 'Kondisi Fisik',
                ] as $field => $label)
                    <div class="grid grid-cols-12 border-t border-slate-300">
                        <div class="col-span-6 px-3 py-2 border-r border-slate-300">{{ $label }}</div>
                        <div class="col-span-6 px-3 py-1.5">
                            <div class="flex items-center gap-6">
                                <label class="inline-flex items-center gap-1.5">
                                    <input type="radio" name="{{ $field }}" value="baik"
                                           class="border-slate-300 text-red-600 focus:ring-red-500"
                                           {{ old($field) === 'baik' ? 'checked' : '' }}>
                                    <span>Baik</span>
                                </label>
                                <label class="inline-flex items-center gap-1.5">
                                    <input type="radio" name="{{ $field }}" value="tidak_baik"
                                           class="border-slate-300 text-red-600 focus:ring-red-500"
                                           {{ old($field) === 'tidak_baik' ? 'checked' : '' }}>
                                    <span>Tidak Baik</span>
                                </label>
                            </div>
                            @error($field)
                                <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- KESIMPULAN --}}
            <div class="border border-slate-400 text-xs">
                <div class="grid grid-cols-12 border-b border-slate-300">
                    <div class="col-span-3 px-3 py-2 border-r border-slate-300 font-semibold">KESIMPULAN</div>
                    <div class="col-span-9 px-3 py-2">
                        <div class="flex items-center gap-6">
                            <label class="inline-flex items-center gap-1.5">
                                <input type="radio" name="kesimpulan" value="baik"
                                       class="border-slate-300 text-red-600 focus:ring-red-500"
                                       {{ old('kesimpulan') === 'baik' ? 'checked' : '' }}>
                                <span>Baik</span>
                            </label>
                            <label class="inline-flex items-center gap-1.5">
                                <input type="radio" name="kesimpulan" value="tidak_baik"
                                       class="border-slate-300 text-red-600 focus:ring-red-500"
                                       {{ old('kesimpulan') === 'tidak_baik' ? 'checked' : '' }}>
                                <span>Tidak Baik</span>
                            </label>
                        </div>
                        @error('kesimpulan')
                            <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-12 border-b border-slate-300">
                    <div class="col-span-3 px-3 py-2 border-r border-slate-300">Tanggal Pemeriksaan</div>
                    <div class="col-span-9 px-3 py-2">
                        <input type="date" name="tgl_periksa"
                               value="{{ old('tgl_periksa', now()->toDateString()) }}"
                               class="border border-slate-300 rounded-md px-2 py-1 text-xs">
                        @error('tgl_periksa')
                            <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-12">
                    <div class="col-span-3 px-3 py-2 border-r border-slate-300">Petugas</div>
                    <div class="col-span-9 px-3 py-2">
                        <input type="text" name="petugas"
                               value="{{ old('petugas') }}"
                               placeholder="Nama Petugas"
                               class="border border-slate-300 rounded-md px-2 py-1 text-xs w-64">
                        @error('petugas')
                            <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- FOOTER TOMBOL --}}
            <div class="no-print pt-4 mt-2 border-t border-dashed border-slate-200 flex items-center justify-between gap-3 text-xs">
                <p class="text-slate-500">Data Kartu Kendali akan disimpan dan bisa dicetak ulang dari modul APAB.</p>
                <div class="flex gap-2">
                    <a href="{{ route('apab.index') }}"
                       class="px-3 py-2 rounded-lg border text-sm hover:bg-slate-50">Batal</a>
                    <button type="submit"
                            class="px-4 py-2 rounded-lg bg-gradient-to-r from-red-600 to-orange-600 text-white text-sm font-medium hover:from-red-700 hover:to-orange-700">
                        Simpan Kartu Kendali
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

</body>
</html>
