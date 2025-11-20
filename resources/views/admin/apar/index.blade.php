<x-layouts.app :title="'Manage APAR — Admin'">
  <div class="mb-6 flex items-center justify-between">
    <div>
      <h1 class="text-2xl font-bold text-gray-900">Manage APAR</h1>
      <p class="text-sm text-gray-600 mt-1">Kelola semua Alat Pemadam Api Ringan</p>
    </div>
    <a href="{{ route('admin.apar.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors shadow-md">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
      </svg>
      Tambah APAR
    </a>
  </div>

  @if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center gap-3">
      <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
      </svg>
      <span class="text-green-800 font-medium">{{ session('success') }}</span>
    </div>
  @endif

  {{-- Stats Cards --}}
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl p-6 shadow-lg ring-1 ring-slate-200">
      <div class="flex items-start justify-between mb-4">
        <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
          <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
          </svg>
        </div>
      </div>
      <p class="text-gray-600 text-sm font-medium">Total APAR</p>
      <p class="text-3xl font-bold text-blue-600 mt-2">{{ $stats['total'] }}</p>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-lg ring-1 ring-slate-200">
      <div class="flex items-start justify-between mb-4">
        <div class="w-12 h-12 rounded-lg bg-green-100 flex items-center justify-center">
          <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
        </div>
      </div>
      <p class="text-gray-600 text-sm font-medium">Kondisi Baik</p>
      <p class="text-3xl font-bold text-green-600 mt-2">{{ $stats['baik'] }}</p>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-lg ring-1 ring-slate-200">
      <div class="flex items-start justify-between mb-4">
        <div class="w-12 h-12 rounded-lg bg-yellow-100 flex items-center justify-center">
          <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
        </div>
      </div>
      <p class="text-gray-600 text-sm font-medium">Perlu Isi Ulang</p>
      <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $stats['isi_ulang'] }}</p>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-lg ring-1 ring-slate-200">
      <div class="flex items-start justify-between mb-4">
        <div class="w-12 h-12 rounded-lg bg-red-100 flex items-center justify-center">
          <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
          </svg>
        </div>
      </div>
      <p class="text-gray-600 text-sm font-medium">Rusak</p>
      <p class="text-3xl font-bold text-red-600 mt-2">{{ $stats['rusak'] }}</p>
    </div>
  </div>

  {{-- Table --}}
  <div class="bg-white rounded-xl shadow-lg ring-1 ring-slate-200 overflow-hidden" id="apar-table-container">
    <div class="overflow-x-auto">
      <table class="w-full">
        <thead class="bg-slate-50 border-b border-slate-200">
          <tr>
            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Serial No</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Lokasi</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Tipe</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Kapasitas</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Status</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Kartu</th>
            <th class="px-6 py-4 text-right text-xs font-semibold text-slate-700 uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-200">
          @forelse($apars as $apar)
            <tr class="hover:bg-slate-50 transition-colors">
              <td class="px-6 py-4">
                <p class="font-semibold text-gray-900">{{ $apar->serial_no }}</p>
                <p class="text-sm text-gray-500">{{ $apar->barcode }}</p>
              </td>
              <td class="px-6 py-4 text-sm text-gray-700">{{ $apar->location_code }}</td>
              <td class="px-6 py-4 text-sm text-gray-700">{{ $apar->type }}</td>
              <td class="px-6 py-4 text-sm text-gray-700">{{ $apar->capacity }}</td>
              <td class="px-6 py-4">
                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                  @if(strtolower($apar->status) === 'baik') bg-green-100 text-green-700
                  @elseif(strtolower($apar->status) === 'isi ulang') bg-yellow-100 text-yellow-700
                  @else bg-red-100 text-red-700 @endif">
                  {{ ucfirst($apar->status) }}
                </span>
              </td>
              <td class="px-6 py-4">
                @php
                  $totalKartu = $apar->kartuApars->count();
                  $approvedKartu = $apar->kartuApars->whereNotNull('approved_at')->count();
                @endphp
                <div class="flex items-center gap-2">
                  <span class="text-sm font-medium text-gray-700">{{ $totalKartu }}</span>
                  @if($approvedKartu > 0)
                    <span class="text-xs text-green-600">({{ $approvedKartu }} approved)</span>
                  @endif
                </div>
              </td>
              <td class="px-6 py-4 text-right">
                <div class="flex items-center justify-end gap-2">
                  <a href="{{ route('admin.apar.show', $apar) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Detail">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                  </a>
                  <a href="{{ route('admin.apar.edit', $apar) }}" class="p-2 text-purple-600 hover:bg-purple-50 rounded-lg transition-colors" title="Edit">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                  </a>
                  <form action="{{ route('admin.apar.destroy', $apar) }}" method="POST" onsubmit="return confirm('Yakin hapus APAR ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                      </svg>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                <svg class="w-12 h-12 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                <p class="font-medium">Belum ada data APAR</p>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($apars->hasPages())
      <div class="px-6 py-4 border-t border-slate-200">
        {{ $apars->links() }}
      </div>
    @endif
  </div>
</x-layouts.app>


  {{-- Real-time Update Script --}}
  <script>
    let isUpdating = false;

    // Auto refresh every 5 seconds
    setInterval(async () => {
      if (isUpdating) return;
      
      try {
        isUpdating = true;
        const response = await fetch('{{ route("admin.apar.index") }}?ajax=1&t=' + Date.now(), {
          headers: {
            'X-Requested-With': 'XMLHttpRequest'
          }
        });
        
        if (response.ok) {
          const html = await response.text();
          const parser = new DOMParser();
          const doc = parser.parseFromString(html, 'text/html');
          
          // Update stats
          const newStats = doc.querySelectorAll('.text-3xl.font-bold');
          const currentStats = document.querySelectorAll('.text-3xl.font-bold');
          newStats.forEach((stat, index) => {
            if (currentStats[index] && stat.textContent !== currentStats[index].textContent) {
              currentStats[index].textContent = stat.textContent;
              currentStats[index].classList.add('animate-pulse');
              setTimeout(() => currentStats[index].classList.remove('animate-pulse'), 1000);
            }
          });
          
          // Update table
          const newTable = doc.querySelector('#apar-table-container');
          const currentTable = document.querySelector('#apar-table-container');
          if (newTable && currentTable) {
            const newContent = newTable.innerHTML;
            if (newContent !== currentTable.innerHTML) {
              currentTable.innerHTML = newContent;
              // Flash animation
              currentTable.classList.add('ring-2', 'ring-green-500');
              setTimeout(() => currentTable.classList.remove('ring-2', 'ring-green-500'), 1000);
            }
          }
        }
      } catch (error) {
        console.error('Auto-refresh error:', error);
      } finally {
        isUpdating = false;
      }
    }, 5000); // Refresh every 5 seconds

    // Show indicator
    const indicator = document.createElement('div');
    indicator.className = 'fixed bottom-4 right-4 px-3 py-2 bg-green-600 text-white text-xs rounded-lg shadow-lg flex items-center gap-2 z-50';
    indicator.innerHTML = `
      <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
      <span>Live</span>
    `;
    document.body.appendChild(indicator);
  </script>
