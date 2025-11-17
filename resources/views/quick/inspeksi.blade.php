<x-layouts.app :title="'Buat Inspeksi Cepat'">
  <div class="max-w-4xl mx-auto px-4 py-6 space-y-6">
    <div class="mb-4">
        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white border-2 border-slate-200 text-slate-700 text-sm font-medium hover:bg-slate-50 hover:border-slate-300 transition-all duration-200 shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span>Kembali</span>
        </a>
    </div>

    <div class="text-center mb-8">
        <div class="w-20 h-20 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-sky-500 to-blue-500 flex items-center justify-center shadow-xl">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
        </div>
        <h1 class="text-3xl font-bold tracking-tight bg-gradient-to-r from-sky-600 to-blue-600 bg-clip-text text-transparent mb-2">
            Buat Inspeksi Cepat
        </h1>
        <p class="text-sm text-slate-600">Pilih modul dan peralatan untuk membuat inspeksi</p>
    </div>

    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-slate-200 p-8">
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            <a href="{{ route('apar.index') }}" class="group p-6 rounded-xl border-2 border-slate-200 hover:border-blue-400 hover:shadow-lg transition-all">
                <div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-gradient-to-br from-blue-500 to-teal-500 flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <h3 class="text-center font-bold text-slate-900 mb-1">APAR</h3>
                <p class="text-center text-xs text-slate-600">{{ $apars->count() }} unit</p>
            </a>

            <a href="{{ route('apat.index') }}" class="group p-6 rounded-xl border-2 border-slate-200 hover:border-cyan-400 hover:shadow-lg transition-all">
                <div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-gradient-to-br from-cyan-500 to-sky-500 flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <h3 class="text-center font-bold text-slate-900 mb-1">APAT</h3>
                <p class="text-center text-xs text-slate-600">{{ $apats->count() }} unit</p>
            </a>

            <a href="{{ route('apab.index') }}" class="group p-6 rounded-xl border-2 border-slate-200 hover:border-red-400 hover:shadow-lg transition-all">
                <div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-gradient-to-br from-red-500 to-orange-500 flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <h3 class="text-center font-bold text-slate-900 mb-1">APAB</h3>
                <p class="text-center text-xs text-slate-600">{{ $apabs->count() }} unit</p>
            </a>

            <a href="{{ route('fire-alarm.index') }}" class="group p-6 rounded-xl border-2 border-slate-200 hover:border-pink-400 hover:shadow-lg transition-all">
                <div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-gradient-to-br from-red-500 to-pink-500 flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </div>
                <h3 class="text-center font-bold text-slate-900 mb-1">Fire Alarm</h3>
                <p class="text-center text-xs text-slate-600">{{ $fireAlarms->count() }} unit</p>
            </a>

            <a href="{{ route('box-hydrant.index') }}" class="group p-6 rounded-xl border-2 border-slate-200 hover:border-blue-400 hover:shadow-lg transition-all">
                <div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-gradient-to-br from-blue-700 to-cyan-500 flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </div>
                <h3 class="text-center font-bold text-slate-900 mb-1">Box Hydrant</h3>
                <p class="text-center text-xs text-slate-600">{{ $boxHydrants->count() }} unit</p>
            </a>

            <a href="{{ route('rumah-pompa.index') }}" class="group p-6 rounded-xl border-2 border-slate-200 hover:border-purple-400 hover:shadow-lg transition-all">
                <div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-gradient-to-br from-purple-600 to-indigo-600 flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>
                <h3 class="text-center font-bold text-slate-900 mb-1">Rumah Pompa</h3>
                <p class="text-center text-xs text-slate-600">{{ $rumahPompas->count() }} unit</p>
            </a>
        </div>
    </div>
  </div>
</x-layouts.app>
