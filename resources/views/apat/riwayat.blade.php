{{-- resources/views/apat/riwayat.blade.php --}}
<x-layouts.app :title="'Riwayat Inspeksi APAT'">
  <div class="max-w-7xl mx-auto px-4 py-6 space-y-6">

    {{-- Back Button --}}
    <div class="mb-4">
        <a href="{{ route('apat.index') }}"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white border-2 border-slate-200 text-slate-700 text-sm font-medium hover:bg-slate-50 hover:border-slate-300 transition-all duration-200 shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span>Kembali ke Daftar APAT</span>
        </a>
    </div>

    {{-- Header --}}
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-cyan-600 via-sky-600 to-blue-600 p-8 shadow-xl">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
        <div class="relative">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-16 h-16 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center shadow-lg">
                    <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-white">Riwayat Inspeksi</h1>
                    <p class="text-cyan-100 text-sm">APAT {{ $apat->barcode ?? $apat->serial_no }}</p>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-4 mt-6">
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4">
                    <p class="text-cyan-100 text-xs mb-1">Lokasi</p>
                    <p class="text-white font-semibold">{{ $apat->lokasi ?? '-' }}</p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4">
                    <p class="text-cyan-100 text-xs mb-1">Jenis</p>
                    <p class="text-white font-semibold">{{ $apat->jenis ?? '-' }}</p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4">
                    <p class="text-cyan-100 text-xs mb-1">Total Inspeksi</p>
                    <p class="text-white font-semibold">{{ $riwayatInspeksi->count() }} kali</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Riwayat List --}}
    @if($riwayatInspeksi->count() > 0)
        <div class="space-y-4">
            @foreach($riwayatInspeksi as $index => $kartu)
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-start justify-between gap-4 mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-cyan-500 to-sky-500 flex items-center justify-center text-white font-bold shadow-lg">
                                    #{{ $riwayatInspeksi->count() - $index }}
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-slate-900">
                                        Inspeksi {{ $kartu->tgl_periksa->format('d M Y') }}
                                    </h3>
                                    <p class="text-sm text-slate-600">{{ $kartu->tgl_periksa->diffForHumans() }}</p>
                                </div>
                            </div>
                            <span class="inline-flex items-center gap-1.5 rounded-full border px-4 py-2 text-sm font-semibold 
                                {{ $kartu->kesimpulan === 'baik' ? 'bg-emerald-100 text-emerald-700 border-emerald-200' : 'bg-rose-100 text-rose-700 border-rose-200' }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    @if($kartu->kesimpulan === 'baik')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    @else
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    @endif
                                </svg>
                                {{ strtoupper($kartu->kesimpulan) }}
                            </span>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-4">
                            <div class="rounded-xl bg-slate-50 p-3 border border-slate-100">
                                <p class="text-xs text-slate-500 mb-1">Kondisi Fisik</p>
                                <p class="text-sm font-semibold {{ $kartu->kondisi_fisik === 'baik' ? 'text-emerald-600' : 'text-rose-600' }}">
                                    {{ ucfirst(str_replace('_', ' ', $kartu->kondisi_fisik)) }}
                                </p>
                            </div>
                            <div class="rounded-xl bg-slate-50 p-3 border border-slate-100">
                                <p class="text-xs text-slate-500 mb-1">Kelengkapan</p>
                                <p class="text-sm font-semibold {{ $kartu->kelengkapan === 'baik' ? 'text-emerald-600' : 'text-rose-600' }}">
                                    {{ ucfirst(str_replace('_', ' ', $kartu->kelengkapan)) }}
                                </p>
                            </div>
                            <div class="rounded-xl bg-slate-50 p-3 border border-slate-100">
                                <p class="text-xs text-slate-500 mb-1">Isi Media</p>
                                <p class="text-sm font-semibold {{ $kartu->isi_media === 'baik' ? 'text-emerald-600' : 'text-rose-600' }}">
                                    {{ ucfirst(str_replace('_', ' ', $kartu->isi_media)) }}
                                </p>
                            </div>
                            <div class="rounded-xl bg-slate-50 p-3 border border-slate-100">
                                <p class="text-xs text-slate-500 mb-1">Akses</p>
                                <p class="text-sm font-semibold {{ $kartu->akses === 'baik' ? 'text-emerald-600' : 'text-rose-600' }}">
                                    {{ ucfirst(str_replace('_', ' ', $kartu->akses)) }}
                                </p>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-slate-200 flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-cyan-500 to-sky-500 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-500">Petugas</p>
                                        <p class="text-sm font-semibold text-slate-900">{{ $kartu->petugas }}</p>
                                    </div>
                                </div>
                                @if($kartu->user)
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-slate-500 to-slate-600 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-slate-500">Diinput oleh</p>
                                            <p class="text-sm font-semibold text-slate-900">{{ $kartu->user->name }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-slate-500">Tanggal Inspeksi</p>
                                <p class="text-sm font-semibold text-slate-900">{{ $kartu->tgl_periksa->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="relative rounded-2xl border-2 border-dashed border-slate-300 p-12 text-center bg-gradient-to-br from-slate-50 to-white overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-cyan-500/5 rounded-full -mr-32 -mt-32"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-sky-500/5 rounded-full -ml-32 -mb-32"></div>
            
            <div class="relative">
                <div class="w-20 h-20 mx-auto mb-6 rounded-2xl bg-gradient-to-br from-cyan-500 to-sky-500 flex items-center justify-center shadow-xl">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                
                <h3 class="text-xl font-bold text-slate-900 mb-2">Belum Ada Riwayat Inspeksi</h3>
                <p class="text-slate-600 text-sm mb-1">
                    APAT ini belum pernah diinspeksi. Buat kartu kendali untuk memulai inspeksi.
                </p>
                <p class="text-xs text-slate-500 mb-6">
                    Setelah membuat kartu kendali, riwayat inspeksi akan muncul di sini
                </p>
                
                <a href="{{ route('apat.kartu.create', ['apat_id' => $apat->id]) }}"
                   class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-cyan-600 to-sky-600 text-white text-sm font-semibold hover:from-cyan-700 hover:to-sky-700 shadow-lg shadow-cyan-500/30 hover:shadow-xl hover:shadow-cyan-500/40 transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Buat Kartu Kendali Pertama</span>
                </a>
            </div>
        </div>
    @endif

  </div>
</x-layouts.app>
