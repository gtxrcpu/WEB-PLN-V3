<x-layouts.app :title="'Tambah APAR — Admin'">
  <div class="mb-6">
    <a href="{{ route('admin.apar.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 transition-colors mb-4">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
      </svg>
      Kembali
    </a>
    <h1 class="text-2xl font-bold text-gray-900">Tambah APAR Baru</h1>
    <p class="text-sm text-gray-600 mt-1">Serial Number: <span class="font-semibold">{{ $nextSerial }}</span></p>
  </div>

  <div class="bg-white rounded-xl shadow-lg ring-1 ring-slate-200 p-6">
    <form action="{{ route('admin.apar.store') }}" method="POST" class="space-y-6">
      @csrf

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2">Lokasi *</label>
          <input type="text" name="location_code" value="{{ old('location_code') }}" required
            placeholder="Contoh: BDG-A1"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('location_code') border-red-500 @enderror">
          @error('location_code')
            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2">Tipe *</label>
          <input type="text" name="type" value="{{ old('type') }}" required
            placeholder="Contoh: Powder, CO2, Foam"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('type') border-red-500 @enderror">
          @error('type')
            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2">Kapasitas *</label>
          <input type="text" name="capacity" value="{{ old('capacity') }}" required
            placeholder="Contoh: 5 Kg, 3 Liter"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('capacity') border-red-500 @enderror">
          @error('capacity')
            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2">Agent</label>
          <input type="text" name="agent" value="{{ old('agent') }}"
            placeholder="Contoh: ABC Powder"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
        </div>

        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2">Status *</label>
          <select name="status" required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('status') border-red-500 @enderror">
            <option value="">-- Pilih Status --</option>
            <option value="baik" {{ old('status') === 'baik' ? 'selected' : '' }}>Baik</option>
            <option value="isi ulang" {{ old('status') === 'isi ulang' ? 'selected' : '' }}>Isi Ulang</option>
            <option value="rusak" {{ old('status') === 'rusak' ? 'selected' : '' }}>Rusak</option>
          </select>
          @error('status')
            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>
      </div>

      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan</label>
        <textarea name="notes" rows="3"
          placeholder="Catatan tambahan..."
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">{{ old('notes') }}</textarea>
      </div>

      <div class="flex items-center gap-3 pt-4 border-t border-gray-200">
        <button type="submit" class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors shadow-md font-semibold">
          Simpan APAR
        </button>
        <a href="{{ route('admin.apar.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors font-semibold">
          Batal
        </a>
      </div>
    </form>
  </div>
</x-layouts.app>
