<x-layouts.app :title="'Kartu Settings — Admin'">
  <div class="mb-4 sm:mb-6">
    <a href="{{ route('admin.dashboard') }}" 
            class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-white hover:bg-slate-50 text-slate-700 transition-colors shadow-sm border border-slate-200 mb-4">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
      </svg>
      <span class="text-sm font-medium">Kembali ke Dashboard</span>
    </a>

    <h1 class="text-2xl font-bold text-gray-900">Kartu Kendali Settings</h1>
    <p class="text-sm text-gray-600 mt-1">Kelola informasi header kartu kendali (No. Dokumen, Revisi, dll)</p>
  </div>

  @if(session('success'))
    <div class="mb-6 p-4 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 rounded-lg flex items-center gap-3 shadow-sm">
      <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
      </div>
      <span class="text-green-800 font-medium">{{ session('success') }}</span>
    </div>
  @endif

  <div class="bg-white rounded-xl shadow-lg ring-1 ring-slate-200 p-6">
    <div class="flex items-center gap-3 mb-6">
      <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center shadow-lg">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
      </div>
      <div>
        <h2 class="text-lg font-bold text-gray-900">Header Information</h2>
        <p class="text-sm text-gray-600">Settings ini akan muncul di bagian atas kartu kendali</p>
      </div>
    </div>

    <form action="{{ route('admin.kartu-settings.update') }}" method="POST" class="space-y-5">
      @csrf
      @method('PUT')

      @foreach($settings as $setting)
        <div class="p-4 bg-slate-50 rounded-lg border border-slate-200">
          <label class="block text-sm font-semibold text-gray-700 mb-2">
            {{ $setting->label }}
            @if($setting->description)
              <span class="text-xs text-gray-500 font-normal block mt-1">{{ $setting->description }}</span>
            @endif
          </label>
          <input type="text" 
                 name="settings[{{ $setting->key }}]" 
                 value="{{ old('settings.' . $setting->key, $setting->value) }}"
                 class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                 placeholder="Masukkan {{ strtolower($setting->label) }}">
        </div>
      @endforeach

      <div class="pt-4 flex items-center gap-3">
        <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all shadow-md font-semibold">
          <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
          </svg>
          Simpan Settings
        </button>
        <a href="{{ route('admin.dashboard') }}" class="px-6 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors font-semibold">
          Batal
        </a>
      </div>
    </form>
  </div>

  {{-- Preview Section --}}
  <div class="mt-6 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 border-2 border-indigo-200">
    <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
      <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
      </svg>
      Preview Header Kartu Kendali
    </h3>
    <div class="bg-white rounded-lg p-4 shadow-sm">
      <div class="border-2 border-gray-800">
        <table class="w-full text-xs">
          <tr>
            <td rowspan="4" class="border-r-2 border-gray-800 p-3 text-center align-middle w-2/3">
              <div class="font-bold text-lg">KARTU KENDALI</div>
              <div class="font-semibold mt-1">ALAT PEMADAM API RINGAN (APAR)</div>
              <div class="font-semibold">TAHUN {{ date('Y') }}</div>
            </td>
            <td class="border-r border-b border-gray-800 p-2 font-semibold bg-gray-100">No. Dokumen</td>
            <td class="border-b border-gray-800 p-2">{{ $settings->where('key', 'no_dokumen')->first()->value ?? '-' }}</td>
          </tr>
          <tr>
            <td class="border-r border-b border-gray-800 p-2 font-semibold bg-gray-100">Revisi</td>
            <td class="border-b border-gray-800 p-2">{{ $settings->where('key', 'revisi')->first()->value ?? '-' }}</td>
          </tr>
          <tr>
            <td class="border-r border-b border-gray-800 p-2 font-semibold bg-gray-100">Tanggal</td>
            <td class="border-b border-gray-800 p-2">{{ $settings->where('key', 'tanggal_berlaku')->first()->value ?? '-' }}</td>
          </tr>
          <tr>
            <td class="border-r border-gray-800 p-2 font-semibold bg-gray-100">Halaman</td>
            <td class="p-2">{{ $settings->where('key', 'halaman')->first()->value ?? '-' }}</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</x-layouts.app>
