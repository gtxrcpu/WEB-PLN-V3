{{-- resources/views/kartu/form.blade.php --}}
@extends('layouts.app')

@section('title', 'Kartu Kendali APAR')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-6 space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold tracking-tight">Kartu Kendali APAR</h1>
            <p class="text-sm text-slate-600">
                APAR:
                <span class="font-semibold">
                    {{ $apar->name ?? $apar->barcode ?? ('APAR A' . $apar->serial_no) }}
                </span>
                — Lokasi:
                <span class="font-semibold">
                    {{ $apar->location_code ?? $apar->lokasi ?? '-' }}
                </span>
            </p>
        </div>

        <a href="{{ route('apar.index') }}"
           class="inline-flex items-center px-3 py-2 rounded-lg border border-slate-200 text-sm text-slate-700 hover:bg-slate-50">
            ← Kembali
        </a>
    </div>

    {{-- Error validasi --}}
    @if ($errors->any())
        <div class="rounded-xl border border-rose-200 bg-rose-50 text-rose-800 px-4 py-3 text-sm space-y-1">
            <div class="font-semibold">Periksa kembali:</div>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Info APAR --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-4 text-sm space-y-1">
        <div class="font-semibold mb-1">Informasi APAR</div>
        <div><span class="text-slate-500 w-32 inline-block">Barcode</span>: {{ $apar->barcode ?? ('APAR A' . $apar->serial_no) }}</div>
        <div><span class="text-slate-500 w-32 inline-block">Jenis / Media</span>: {{ $apar->type ?? $apar->jenis ?? '-' }}</div>
        <div><span class="text-slate-500 w-32 inline-block">Kapasitas</span>: {{ $apar->capacity ?? $apar->kapasitas ?? '-' }}</div>
        <div><span class="text-slate-500 w-32 inline-block">Lokasi</span>: {{ $apar->location_code ?? $apar->lokasi ?? '-' }}</div>
    </div>

    {{-- FORM CHECKLIST --}}
    <form method="POST" action="{{ route('kartu.store') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="apar_id" value="{{ $apar->id }}">

        <div class="rounded-2xl border border-slate-200 bg-white p-4">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-sm font-semibold text-slate-800">Checklist Pemeriksaan</h2>
                <span class="text-xs text-slate-500">Ceklist sesuai kondisi aktual di lapangan</span>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-xs sm:text-sm">
                    <thead>
                        <tr class="bg-slate-50 text-slate-700">
                            <th class="px-3 py-2 text-left font-semibold border-b border-slate-200 w-1/4">Item</th>
                            <th class="px-3 py-2 text-center font-semibold border-b border-slate-200 w-1/4">Baik</th>
                            <th class="px-3 py-2 text-center font-semibold border-b border-slate-200 w-1/4">Perlu Perhatian</th>
                            <th class="px-3 py-2 text-center font-semibold border-b border-slate-200 w-1/4">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">

                        {{-- Helper kecil biar nggak nulis ulang --}}
                        @php
                            $val = fn($field) => old($field, $kartu->$field ?? '');
                        @endphp

                        {{-- PG --}}
                        <tr>
                            <td class="px-3 py-3">
                                <div class="font-medium text-slate-800">Pressure Gauge (PG)</div>
                                <div class="text-[11px] text-slate-500">Jarum di area hijau = normal</div>
                            </td>
                            <td class="px-3 py-3 text-center">
                                <input type="radio" name="pg" value="BAIK"
                                       {{ $val('pg') === 'BAIK' ? 'checked' : '' }}
                                       class="h-4 w-4 text-emerald-600 border-slate-300">
                            </td>
                            <td class="px-3 py-3 text-center">
                                <input type="radio" name="pg" value="TIDAK BAIK"
                                       {{ $val('pg') === 'TIDAK BAIK' ? 'checked' : '' }}
                                       class="h-4 w-4 text-amber-500 border-slate-300">
                            </td>
                            <td class="px-3 py-3 text-center text-[11px] text-slate-500">
                                Hijau / Kuning / Merah
                            </td>
                        </tr>

                        {{-- PIN --}}
                        <tr>
                            <td class="px-3 py-3">
                                <div class="font-medium text-slate-800">Pin Pengaman</div>
                                <div class="text-[11px] text-slate-500">Harus terpasang dan terseal</div>
                            </td>
                            <td class="px-3 py-3 text-center">
                                <input type="radio" name="pin" value="TERPASANG"
                                       {{ $val('pin') === 'TERPASANG' ? 'checked' : '' }}
                                       class="h-4 w-4 text-emerald-600 border-slate-300">
                            </td>
                            <td class="px-3 py-3 text-center">
                                <input type="radio" name="pin" value="TIDAK TERPASANG"
                                       {{ $val('pin') === 'TIDAK TERPASANG' ? 'checked' : '' }}
                                       class="h-4 w-4 text-amber-500 border-slate-300">
                            </td>
                            <td class="px-3 py-3 text-center text-[11px] text-slate-500">
                                Hilang / rusak / longgar
                            </td>
                        </tr>

                        {{-- SELANG --}}
                        <tr>
                            <td class="px-3 py-3">
                                <div class="font-medium text-slate-800">Selang</div>
                                <div class="text-[11px] text-slate-500">Pastikan tidak retak, bocor, atau terlipat permanen</div>
                            </td>
                            <td class="px-3 py-3 text-center">
                                <input type="radio" name="selang" value="BAIK"
                                       {{ $val('selang') === 'BAIK' ? 'checked' : '' }}
                                       class="h-4 w-4 text-emerald-600 border-slate-300">
                            </td>
                            <td class="px-3 py-3 text-center">
                                <input type="radio" name="selang" value="RETAS / BOCOR"
                                       {{ $val('selang') === 'RETAS / BOCOR' ? 'checked' : '' }}
                                       class="h-4 w-4 text-amber-500 border-slate-300">
                            </td>
                            <td class="px-3 py-3 text-center text-[11px] text-slate-500">
                                Retak / bocor / kaku
                            </td>
                        </tr>

                        {{-- KLEM --}}
                        <tr>
                            <td class="px-3 py-3">
                                <div class="font-medium text-slate-800">Klem</div>
                                <div class="text-[11px] text-slate-500">Mengikat selang dengan kuat</div>
                            </td>
                            <td class="px-3 py-3 text-center">
                                <input type="radio" name="klem" value="BAIK"
                                       {{ $val('klem') === 'BAIK' ? 'checked' : '' }}
                                       class="h-4 w-4 text-emerald-600 border-slate-300">
                            </td>
                            <td class="px-3 py-3 text-center">
                                <input type="radio" name="klem" value="RUSAK"
                                       {{ $val('klem') === 'RUSAK' ? 'checked' : '' }}
                                       class="h-4 w-4 text-amber-500 border-slate-300">
                            </td>
                            <td class="px-3 py-3 text-center text-[11px] text-slate-500">
                                Lepas / patah / longgar
                            </td>
                        </tr>

                        {{-- HANDLE --}}
                        <tr>
                            <td class="px-3 py-3">
                                <div class="font-medium text-slate-800">Handle / Tuas</div>
                                <div class="text-[11px] text-slate-500">Tidak macet, tidak bengkok</div>
                            </td>
                            <td class="px-3 py-3 text-center">
                                <input type="radio" name="handle" value="BAIK"
                                       {{ $val('handle') === 'BAIK' ? 'checked' : '' }}
                                       class="h-4 w-4 text-emerald-600 border-slate-300">
                            </td>
                            <td class="px-3 py-3 text-center">
                                <input type="radio" name="handle" value="MACET / RUSAK"
                                       {{ $val('handle') === 'MACET / RUSAK' ? 'checked' : '' }}
                                       class="h-4 w-4 text-amber-500 border-slate-300">
                            </td>
                            <td class="px-3 py-3 text-center text-[11px] text-slate-500">
                                Macet / bengkok / patah
                            </td>
                        </tr>

                        {{-- FISIK --}}
                        <tr>
                            <td class="px-3 py-3">
                                <div class="font-medium text-slate-800">Fisik Tabung</div>
                                <div class="text-[11px] text-slate-500">Tidak penyok berat, tidak berkarat parah</div>
                            </td>
                            <td class="px-3 py-3 text-center">
                                <input type="radio" name="fisik" value="BAIK"
                                       {{ $val('fisik') === 'BAIK' ? 'checked' : '' }}
                                       class="h-4 w-4 text-emerald-600 border-slate-300">
                            </td>
                            <td class="px-3 py-3 text-center">
                                <input type="radio" name="fisik" value="BERKARAT / PENYOK"
                                       {{ $val('fisik') === 'BERKARAT / PENYOK' ? 'checked' : '' }}
                                       class="h-4 w-4 text-amber-500 border-slate-300">
                            </td>
                            <td class="px-3 py-3 text-center text-[11px] text-slate-500">
                                Karat / penyok / cat terkelupas
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Kesimpulan & tanggal --}}
            <div class="mt-6 grid sm:grid-cols-2 gap-4">

                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-slate-800">Kesimpulan</label>
                    @php $kes = $val('kesimpulan'); @endphp
                    <div class="flex flex-col gap-2 text-sm">
                        <label class="inline-flex items-center gap-2">
                            <input type="radio" name="kesimpulan" value="BAIK"
                                   {{ $kes === 'BAIK' ? 'checked' : '' }}
                                   class="h-4 w-4 text-emerald-600 border-slate-300">
                            <span>BAIK (dapat digunakan)</span>
                        </label>
                        <label class="inline-flex items-center gap-2">
                            <input type="radio" name="kesimpulan" value="TIDAK BAIK"
                                   {{ $kes === 'TIDAK BAIK' ? 'checked' : '' }}
                                   class="h-4 w-4 text-amber-500 border-slate-300">
                            <span>TIDAK BAIK (perlu tindakan)</span>
                        </label>
                        <label class="inline-flex items-center gap-2">
                            <input type="radio" name="kesimpulan" value="PERLU ISI ULANG"
                                   {{ $kes === 'PERLU ISI ULANG' ? 'checked' : '' }}
                                   class="h-4 w-4 text-sky-500 border-slate-300">
                            <span>PERLU ISI ULANG</span>
                        </label>
                    </div>
                </div>

                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-semibold text-slate-800 mb-1">
                            Tanggal Periksa
                        </label>
                        <input type="date" name="tgl_periksa"
                               value="{{ old('tgl_periksa', isset($kartu->tgl_periksa) ? $kartu->tgl_periksa->format('Y-m-d') : '') }}"
                               class="block w-full rounded-lg border-slate-300 text-sm focus:border-sky-500 focus:ring-sky-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-800 mb-1">
                            Tanggal Surat
                        </label>
                        <input type="date" name="tgl_surat"
                               value="{{ old('tgl_surat', isset($kartu->tgl_surat) ? $kartu->tgl_surat->format('Y-m-d') : '') }}"
                               class="block w-full rounded-lg border-slate-300 text-sm focus:border-sky-500 focus:ring-sky-500">
                    </div>
                </div>
            </div>

            {{-- Catatan --}}
            <div class="mt-4">
                <label class="block text-sm font-semibold text-slate-800 mb-1">
                    Catatan
                </label>
                <textarea name="catatan" rows="3"
                          class="block w-full rounded-lg border-slate-300 text-sm focus:border-sky-500 focus:ring-sky-500">{{ old('catatan', $kartu->catatan ?? '') }}</textarea>
            </div>
        </div>

        {{-- Tombol --}}
        <div class="flex items-center gap-3">
            <button type="submit"
                    class="inline-flex items-center px-4 py-2 rounded-lg bg-emerald-600 text-white text-sm font-medium hover:bg-emerald-700">
                Simpan Checklist
            </button>

            @if($kartu ?? false)
                <a href="{{ route('kartu.show', $kartu->id) }}"
                   class="inline-flex items-center px-4 py-2 rounded-lg border border-slate-200 text-sm text-slate-700 hover:bg-slate-50">
                    Lihat / Cetak Kartu Kendali
                </a>
            @endif
        </div>
    </form>
</div>
@endsection
