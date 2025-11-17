{{-- resources/views/kartu/create.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Kartu Kendali APAR</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Tailwind via CDN (plain, tanpa layouts.app) --}}
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

{{-- BAR ATAS (HANYA LAYAR) --}}
<div class="no-print bg-white border-b mb-4">
    <div class="max-w-5xl mx-auto px-4 py-3 flex items-center justify-between gap-2">
        <div>
            <div class="text-xs text-slate-500">Kartu Kendali APAR</div>
            <div class="text-lg font-semibold">
                {{ $apar->barcode ?? $apar->serial_no ?? 'APAR' }}
            </div>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('apar.index') }}"
               class="inline-flex items-center px-3 py-1.5 rounded-lg border text-sm hover:bg-slate-50">
                ← Kembali ke Daftar APAR
            </a>
            <button onclick="window.print()"
                class="inline-flex items-center px-3 py-1.5 rounded-lg bg-slate-900 text-white text-sm hover:bg-slate-800">
                Cetak / PDF
            </button>
        </div>
    </div>
</div>

{{-- KONTEN UTAMA (A4 SHEET) --}}
<div class="max-w-5xl mx-auto px-2 sm:px-4 pb-10">
    <div class="sheet-a4 bg-white mx-auto rounded-xl shadow-sm border border-slate-200 p-4 sm:p-6">

        {{-- INFO APAR --}}
        <div class="grid sm:grid-cols-[2fr,1fr] gap-4 mb-4">
            <div>
                <h1 class="text-xl font-bold tracking-tight mb-1">KARTU KENDALI APAR</h1>
                <p class="text-sm text-slate-600">
                    Form inspeksi untuk alat pemadam api ringan.
                </p>

                <dl class="mt-3 text-sm grid grid-cols-2 gap-y-1 gap-x-4">
                    <div>
                        <dt class="text-xs text-slate-500">Kode / Barcode</dt>
                        <dd class="font-medium">
                            {{ $apar->barcode ?? $apar->serial_no ?? '-' }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs text-slate-500">Lokasi</dt>
                        <dd class="font-medium">
                            {{ $apar->location_code ?? $apar->lokasi ?? '-' }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs text-slate-500">Jenis</dt>
                        <dd class="font-medium">{{ $apar->type ?? $apar->jenis ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-slate-500">Kapasitas</dt>
                        <dd class="font-medium">{{ $apar->capacity ?? $apar->kapasitas ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-slate-500">Status saat ini</dt>
                        <dd class="font-medium uppercase text-xs">
                            {{ $apar->status ?? '-' }}
                        </dd>
                    </div>
                </dl>
            </div>

            {{-- QR SISI KANAN --}}
            <div class="flex flex-col items-end justify-between gap-3">
                <div class="border rounded-xl p-2 w-28 h-28 flex items-center justify-center bg-slate-50">
                    @php
                        $qrPath = $apar->qr_svg_path ?? $apar->qr_path ?? null;
                    @endphp
                    @if($qrPath && file_exists(public_path($qrPath)))
                        <img src="{{ asset($qrPath) }}" alt="QR APAR"
                             class="w-full h-full object-contain">
                    @else
                        <span class="text-[10px] text-slate-500 text-center">
                            QR belum tersedia
                        </span>
                    @endif
                </div>
                <div class="text-[10px] text-slate-500 text-right">
                    Kode: {{ $apar->barcode ?? $apar->serial_no ?? '-' }}<br>
                    Lokasi: {{ $apar->location_code ?? $apar->lokasi ?? '-' }}
                </div>
            </div>
        </div>

        {{-- ERROR MESSAGE GLOBAL --}}
        @if($errors->any())
            <div class="no-print mb-4 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800">
                <div class="font-semibold mb-1">Periksa kembali:</div>
                <ul class="list-disc pl-4 space-y-0.5">
                    @foreach($errors->all() as $msg)
                        <li>{{ $msg }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORM --}}
        <form method="POST" action="{{ route('kartu.store') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="apar_id" value="{{ $apar->id }}">

            @php
                $opsiKondisi = [
                    'baik'       => 'Baik',
                    'tidak_baik' => 'Tidak Baik',
                ];
            @endphp

            {{-- TABEL PEMERIKSAAN --}}
            <div>
                <h2 class="text-sm font-semibold mb-2">Pemeriksaan Fisik</h2>

                <div class="border border-slate-300 rounded-lg overflow-hidden text-sm">
                    <div class="grid grid-cols-2 bg-slate-100 border-b border-slate-300">
                        <div class="px-3 py-2 font-semibold">Komponen</div>
                        <div class="px-3 py-2 font-semibold">Kondisi</div>
                    </div>

                    @foreach ([
                        'pressure_gauge' => 'Pressure Gauge',
                        'pin_segel'      => 'Pin / Segel',
                        'selang'         => 'Selang',
                        'tabung'         => 'Tabung',
                        'label'          => 'Label',
                        'kondisi_fisik'  => 'Kondisi Fisik',
                    ] as $field => $label)
                        <div class="grid grid-cols-2 border-t border-slate-200">
                            <div class="px-3 py-2">{{ $label }}</div>
                            <div class="px-3 py-2">
                                <div class="flex flex-wrap gap-3">
                                    @foreach($opsiKondisi as $val => $text)
                                        <label class="inline-flex items-center gap-1.5 text-xs">
                                            <input type="radio"
                                                   name="{{ $field }}"
                                                   value="{{ $val }}"
                                                   class="border-slate-300 text-emerald-600 focus:ring-emerald-500"
                                                   {{ old($field) === $val ? 'checked' : '' }}>
                                            <span>{{ $text }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                @error($field)
                                    <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- KESIMPULAN & TANGGAL --}}
            <div class="grid sm:grid-cols-2 gap-4">
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium mb-1">
                            Kesimpulan
                        </label>
                        <select name="kesimpulan"
                                class="w-full rounded-md border-slate-300 text-sm focus:ring-sky-500 focus:border-sky-500">
                            <option value="">-- Pilih Kesimpulan --</option>
                            <option value="baik" {{ old('kesimpulan') === 'baik' ? 'selected' : '' }}>Baik</option>
                            <option value="tidak baik" {{ old('kesimpulan') === 'tidak baik' ? 'selected' : '' }}>
                                Tidak Baik
                            </option>
                        </select>
                        @error('kesimpulan')
                            <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">
                            Petugas
                        </label>
                        <input type="text"
                               name="petugas"
                               placeholder="Nama petugas inspeksi"
                               value="{{ old('petugas') }}"
                               class="w-full rounded-md border-slate-300 text-sm focus:ring-sky-500 focus:border-sky-500">
                        @error('petugas')
                            <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium mb-1">
                            Tanggal Pemeriksaan
                        </label>
                        <input type="date"
                               name="tgl_periksa"
                               value="{{ old('tgl_periksa', now()->toDateString()) }}"
                               class="w-full rounded-md border-slate-300 text-sm focus:ring-sky-500 focus:border-sky-500">
                        @error('tgl_periksa')
                            <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- TOMBOL SUBMIT --}}
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-200">
                <a href="{{ route('apar.index') }}"
                   class="px-4 py-2 rounded-lg border border-slate-300 text-sm font-medium hover:bg-slate-50">
                    Batal
                </a>
                <button type="submit"
                        class="px-6 py-2 rounded-lg bg-sky-600 text-white text-sm font-semibold hover:bg-sky-700">
                    Simpan Kartu Kendali
                </button>
            </div>
        </form>

    </div>
</div>

</body>
</html>
                            <label class="block text-sm font-medium mb-1">
                                Petugas Pemeriksa
                            </label>
                            <input type="text"
                                   name="petugas"
                                   value="{{ old('petugas') }}"
                                   placeholder="(isi nama)"
                                   class="w-full rounded-md border-slate-300 text-sm focus:ring-sky-500 focus:border-sky-500">
                            @error('petugas')
                                <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">
                                Pengawas
                            </label>
                            <input type="text"
                                   name="pengawas"
                                   value="{{ old('pengawas') }}"
                                   placeholder="(isi nama)"
                                   class="w-full rounded-md border-slate-300 text-sm focus:ring-sky-500 focus:border-sky-500">
                            @error('pengawas')
                                <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- BLOK TANDA TANGAN (HANYA TEAM LEADER DI KANAN BAWAH) --}}
            <div class="mt-6 pt-4 border-t border-slate-200">
                <div class="flex justify-end">
                    <div class="text-sm text-right w-64">
                        <div>
                            {{-- Lokasi + tanggal surat --}}
                            Surabaya, {{ old('tgl_surat', now()->format('d-m-Y')) }}
                        </div>
                        <div class="mt-2">Team Leader K3L &amp; KAM</div>
                        <div class="mt-12 font-semibold underline decoration-slate-400 decoration-dotted">
                            ........................
                        </div>
                    </div>
                </div>
            </div>

            {{-- FOOTER TOMBOL (HANYA LAYAR) --}}
            <div class="no-print pt-4 mt-2 border-t border-dashed border-slate-200 flex items-center justify-between gap-3">
                <p class="text-xs text-slate-500">
                    Data akan tersimpan ke database dan bisa diakses kembali dari modul APAR.
                </p>
                <div class="flex gap-2">
                    <a href="{{ route('apar.index') }}"
                       class="px-3 py-2 rounded-lg border text-sm hover:bg-slate-50">
                        Batal
                    </a>
                    <button type="submit"
                            class="px-4 py-2 rounded-lg bg-emerald-600 text-white text-sm font-medium hover:bg-emerald-700">
                        Simpan Kartu Kendali
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>

</body>
</html>
