{{-- resources/views/referensi/index.blade.php --}}
<x-layouts.app :title="'Referensi — Master Data'">
  <div class="max-w-7xl mx-auto px-4 py-6 space-y-6">

    {{-- Back Button --}}
    <div class="mb-4">
        <a href="{{ route('dashboard') }}"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white border-2 border-slate-200 text-slate-700 text-sm font-medium hover:bg-slate-50 hover:border-slate-300 transition-all duration-200 shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span>Kembali ke Dashboard</span>
        </a>
    </div>

    {{-- Header --}}
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold tracking-tight bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">
                    Manajemen Referensi
                </h1>
                <p class="text-sm text-slate-600 mt-1">
                    Kelola master data kategori, lokasi, dan petugas
                </p>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-purple-500 to-indigo-600 p-5 shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-full -mr-12 -mt-12"></div>
                <div class="relative">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-white/80 text-sm font-medium">Total Kategori</p>
                    <p class="text-3xl font-bold text-white mt-1">{{ $categories->count() }}</p>
                </div>
            </div>

            <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-500 to-cyan-600 p-5 shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-full -mr-12 -mt-12"></div>
                <div class="relative">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-white/80 text-sm font-medium">Total Lokasi</p>
                    <p class="text-3xl font-bold text-white mt-1">{{ $locations->count() }}</p>
                </div>
            </div>

            <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 p-5 shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-full -mr-12 -mt-12"></div>
                <div class="relative">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-white/80 text-sm font-medium">Total Petugas</p>
                    <p class="text-3xl font-bold text-white mt-1">{{ $petugas->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Flash message --}}
    @if(session('success'))
        <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <p class="text-sm text-emerald-800 font-medium">{{ session('success') }}</p>
        </div>
    @endif

    {{-- Tabs --}}
    <div class="border-b border-slate-200">
        <nav class="flex gap-4" aria-label="Tabs">
            <button onclick="switchTab('kategori')" id="tab-kategori" class="ref-tab active px-4 py-3 text-sm font-semibold border-b-2 transition-all">
                Kategori
            </button>
            <button onclick="switchTab('lokasi')" id="tab-lokasi" class="ref-tab px-4 py-3 text-sm font-semibold border-b-2 transition-all">
                Lokasi
            </button>
            <button onclick="switchTab('petugas')" id="tab-petugas" class="ref-tab px-4 py-3 text-sm font-semibold border-b-2 transition-all">
                Petugas
            </button>
        </nav>
    </div>

    {{-- Tab Content --}}
    <div id="content-kategori" class="tab-content">
        @include('referensi.partials.kategori')
    </div>

    <div id="content-lokasi" class="tab-content hidden">
        @include('referensi.partials.lokasi')
    </div>

    <div id="content-petugas" class="tab-content hidden">
        @include('referensi.partials.petugas')
    </div>

  </div>

  <script>
    function switchTab(tab) {
      // Hide all content
      document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
      });
      
      // Remove active from all tabs
      document.querySelectorAll('.ref-tab').forEach(tabBtn => {
        tabBtn.classList.remove('active', 'border-purple-600', 'text-purple-600');
        tabBtn.classList.add('border-transparent', 'text-slate-600', 'hover:text-slate-900', 'hover:border-slate-300');
      });
      
      // Show selected content
      document.getElementById('content-' + tab).classList.remove('hidden');
      
      // Add active to selected tab
      const activeTab = document.getElementById('tab-' + tab);
      activeTab.classList.remove('border-transparent', 'text-slate-600', 'hover:text-slate-900', 'hover:border-slate-300');
      activeTab.classList.add('active', 'border-purple-600', 'text-purple-600');
    }
  </script>

  <style>
    .ref-tab {
      @apply border-transparent text-slate-600 hover:text-slate-900 hover:border-slate-300;
    }
    .ref-tab.active {
      @apply border-purple-600 text-purple-600;
    }
  </style>
</x-layouts.app>
