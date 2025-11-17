{{-- Lokasi Tab Content --}}
<div class="space-y-6">
    <div class="flex justify-end">
        <button onclick="openModal('addLocationModal')" 
                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-600 text-white text-sm font-semibold hover:from-blue-700 hover:to-cyan-700 shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-500/40 transition-all duration-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span>Tambah Lokasi</span>
        </button>
    </div>

    <div class="bg-white rounded-2xl shadow-lg ring-1 ring-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase">Nama</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase">Kode</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase">Gedung</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase">Lantai</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase">Zone</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-slate-700 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @forelse($locations as $location)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-slate-900">{{ $location->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                                    {{ $location->code }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $location->building ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $location->floor ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $location->zone ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($location->is_active)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">Aktif</span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button onclick="editLocation({{ $location->id }}, '{{ $location->name }}', '{{ $location->code }}', '{{ $location->building }}', '{{ $location->floor }}', '{{ $location->zone }}', '{{ $location->address }}', '{{ $location->description }}', {{ $location->is_active ? 'true' : 'false' }})"
                                        class="text-blue-600 hover:text-blue-900 mr-3">Edit</button>
                                <form action="{{ route('referensi.location.delete', $location) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-slate-500">Belum ada data lokasi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Add Modal --}}
<div id="addLocationModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full p-6 max-h-[90vh] overflow-y-auto">
        <h3 class="text-xl font-bold text-slate-900 mb-4">Tambah Lokasi</h3>
        <form action="{{ route('referensi.location.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Nama *</label>
                    <input type="text" name="name" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Kode *</label>
                    <input type="text" name="code" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Gedung</label>
                    <input type="text" name="building" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Lantai</label>
                    <input type="text" name="floor" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Zone</label>
                    <input type="text" name="zone" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Alamat</label>
                    <input type="text" name="address" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Deskripsi</label>
                    <textarea name="description" rows="2" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                </div>
            </div>
            <div class="flex gap-3 pt-4">
                <button type="button" onclick="closeModal('addLocationModal')" class="flex-1 px-4 py-2 border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-50">Batal</button>
                <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- Edit Modal --}}
<div id="editLocationModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full p-6 max-h-[90vh] overflow-y-auto">
        <h3 class="text-xl font-bold text-slate-900 mb-4">Edit Lokasi</h3>
        <form id="editLocationForm" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Nama *</label>
                    <input type="text" name="name" id="edit_loc_name" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Kode *</label>
                    <input type="text" name="code" id="edit_loc_code" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Gedung</label>
                    <input type="text" name="building" id="edit_loc_building" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Lantai</label>
                    <input type="text" name="floor" id="edit_loc_floor" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Zone</label>
                    <input type="text" name="zone" id="edit_loc_zone" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Alamat</label>
                    <input type="text" name="address" id="edit_loc_address" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Deskripsi</label>
                    <textarea name="description" id="edit_loc_description" rows="2" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                </div>
                <div class="col-span-2">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="is_active" id="edit_loc_is_active" value="1" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        <span class="text-sm font-medium text-slate-700">Aktif</span>
                    </label>
                </div>
            </div>
            <div class="flex gap-3 pt-4">
                <button type="button" onclick="closeModal('editLocationModal')" class="flex-1 px-4 py-2 border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-50">Batal</button>
                <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
function editLocation(id, name, code, building, floor, zone, address, description, isActive) {
    document.getElementById('editLocationForm').action = `/referensi/location/${id}`;
    document.getElementById('edit_loc_name').value = name;
    document.getElementById('edit_loc_code').value = code;
    document.getElementById('edit_loc_building').value = building || '';
    document.getElementById('edit_loc_floor').value = floor || '';
    document.getElementById('edit_loc_zone').value = zone || '';
    document.getElementById('edit_loc_address').value = address || '';
    document.getElementById('edit_loc_description').value = description || '';
    document.getElementById('edit_loc_is_active').checked = isActive;
    openModal('editLocationModal');
}
</script>
