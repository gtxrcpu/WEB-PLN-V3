{{-- Petugas Tab Content --}}
<div class="space-y-6">
    <div class="flex justify-end">
        <button onclick="openModal('addPetugasModal')" 
                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 text-white text-sm font-semibold hover:from-emerald-700 hover:to-teal-700 shadow-lg shadow-emerald-500/30 hover:shadow-xl hover:shadow-emerald-500/40 transition-all duration-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span>Tambah Petugas</span>
        </button>
    </div>

    <div class="bg-white rounded-2xl shadow-lg ring-1 ring-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase">Nama</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase">NIP</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase">Jabatan</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase">Departemen</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase">Telepon</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-slate-700 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @forelse($petugas as $p)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-slate-900">{{ $p->name }}</div>
                                @if($p->email)
                                    <div class="text-xs text-slate-500">{{ $p->email }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">
                                    {{ $p->nip }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $p->position ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $p->department ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $p->phone ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($p->is_active)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">Aktif</span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button onclick="editPetugas({{ $p->id }}, '{{ $p->name }}', '{{ $p->nip }}', '{{ $p->phone }}', '{{ $p->email }}', '{{ $p->position }}', '{{ $p->department }}', '{{ $p->address }}', {{ $p->is_active ? 'true' : 'false' }})"
                                        class="text-blue-600 hover:text-blue-900 mr-3">Edit</button>
                                <form action="{{ route('referensi.petugas.delete', $p) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-slate-500">Belum ada data petugas</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Add Modal --}}
<div id="addPetugasModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full p-6 max-h-[90vh] overflow-y-auto">
        <h3 class="text-xl font-bold text-slate-900 mb-4">Tambah Petugas</h3>
        <form action="{{ route('referensi.petugas.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Nama *</label>
                    <input type="text" name="name" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">NIP *</label>
                    <input type="text" name="nip" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Telepon</label>
                    <input type="text" name="phone" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                    <input type="email" name="email" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Jabatan</label>
                    <input type="text" name="position" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Departemen</label>
                    <input type="text" name="department" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Alamat</label>
                    <textarea name="address" rows="2" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent"></textarea>
                </div>
            </div>
            <div class="flex gap-3 pt-4">
                <button type="button" onclick="closeModal('addPetugasModal')" class="flex-1 px-4 py-2 border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-50">Batal</button>
                <button type="submit" class="flex-1 px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- Edit Modal --}}
<div id="editPetugasModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full p-6 max-h-[90vh] overflow-y-auto">
        <h3 class="text-xl font-bold text-slate-900 mb-4">Edit Petugas</h3>
        <form id="editPetugasForm" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Nama *</label>
                    <input type="text" name="name" id="edit_pet_name" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">NIP *</label>
                    <input type="text" name="nip" id="edit_pet_nip" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Telepon</label>
                    <input type="text" name="phone" id="edit_pet_phone" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                    <input type="email" name="email" id="edit_pet_email" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Jabatan</label>
                    <input type="text" name="position" id="edit_pet_position" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Departemen</label>
                    <input type="text" name="department" id="edit_pet_department" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Alamat</label>
                    <textarea name="address" id="edit_pet_address" rows="2" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent"></textarea>
                </div>
                <div class="col-span-2">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="is_active" id="edit_pet_is_active" value="1" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                        <span class="text-sm font-medium text-slate-700">Aktif</span>
                    </label>
                </div>
            </div>
            <div class="flex gap-3 pt-4">
                <button type="button" onclick="closeModal('editPetugasModal')" class="flex-1 px-4 py-2 border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-50">Batal</button>
                <button type="submit" class="flex-1 px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
function editPetugas(id, name, nip, phone, email, position, department, address, isActive) {
    document.getElementById('editPetugasForm').action = `/referensi/petugas/${id}`;
    document.getElementById('edit_pet_name').value = name;
    document.getElementById('edit_pet_nip').value = nip;
    document.getElementById('edit_pet_phone').value = phone || '';
    document.getElementById('edit_pet_email').value = email || '';
    document.getElementById('edit_pet_position').value = position || '';
    document.getElementById('edit_pet_department').value = department || '';
    document.getElementById('edit_pet_address').value = address || '';
    document.getElementById('edit_pet_is_active').checked = isActive;
    openModal('editPetugasModal');
}
</script>
