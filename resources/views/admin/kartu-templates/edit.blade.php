<x-layouts.app :title="'Edit Template — ' . $moduleName">
  <div class="mb-4 sm:mb-6">
    <a href="{{ route('admin.kartu-templates.index') }}" 
            class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-white hover:bg-slate-50 text-slate-700 transition-colors shadow-sm border border-slate-200 mb-4">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
      </svg>
      <span class="text-sm font-medium">Kembali</span>
    </a>

    <h1 class="text-2xl font-bold text-gray-900">Edit Template: {{ $moduleName }}</h1>
    <p class="text-sm text-gray-600 mt-1">Customize header, inspection fields, dan footer untuk modul ini</p>
  </div>

  <form action="{{ route('admin.kartu-templates.update', $template->module) }}" method="POST" 
        x-data="{
          headerFields: {{ json_encode($template->header_fields) }},
          inspectionFields: {{ json_encode($template->inspection_fields) }},
          footerFields: {{ json_encode($template->footer_fields) }}
        }">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      {{-- Basic Info --}}
      <div class="bg-white rounded-xl shadow-lg ring-1 ring-slate-200 p-6">
        <h2 class="text-lg font-bold mb-4 flex items-center gap-2">
          <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
          Informasi Dasar
        </h2>
        
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Title</label>
            <input type="text" name="title" value="{{ old('title', $template->title) }}" required
              class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
          </div>

          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Subtitle</label>
            <input type="text" name="subtitle" value="{{ old('subtitle', $template->subtitle) }}" required
              class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
          </div>
        </div>
      </div>

      {{-- Header Fields --}}
      <div class="bg-white rounded-xl shadow-lg ring-1 ring-slate-200 p-6">
        <div class="flex items-center justify-between mb-4">
          <h2 class="text-lg font-bold flex items-center gap-2">
            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
            </svg>
            Header Fields
          </h2>
          <button type="button" @click="headerFields.push({key: 'field_' + Date.now(), label: '', value: ''})"
                  class="text-sm px-3 py-1 bg-purple-100 text-purple-700 rounded-lg hover:bg-purple-200 font-semibold">
            + Add
          </button>
        </div>

        <div class="space-y-3">
          <template x-for="(field, index) in headerFields" :key="index">
            <div class="p-4 bg-gradient-to-r from-purple-50 to-indigo-50 rounded-lg border-2 border-purple-200">
              <input type="hidden" :name="'header_fields[' + index + '][key]'" :value="field.key">
              <div class="grid grid-cols-2 gap-3 mb-3">
                <div>
                  <label class="block text-xs font-bold text-purple-700 mb-1.5 uppercase tracking-wide">Label (Judul)</label>
                  <input type="text" :name="'header_fields[' + index + '][label]'" x-model="field.label" placeholder="Contoh: Lokasi" required
                         class="w-full px-3 py-2 text-sm font-semibold border-2 border-purple-300 rounded-lg focus:ring-2 focus:ring-purple-500 bg-white">
                </div>
                <div>
                  <label class="block text-xs font-bold text-indigo-700 mb-1.5 uppercase tracking-wide">Value (Isi)</label>
                  <input type="text" :name="'header_fields[' + index + '][value]'" x-model="field.value" placeholder="Contoh: Surabaya" required
                         class="w-full px-3 py-2 text-sm border-2 border-indigo-300 rounded-lg focus:ring-2 focus:ring-indigo-500 bg-white">
                </div>
              </div>
              <div class="flex items-center justify-between pt-2 border-t border-purple-200">
                <div class="text-xs text-gray-600">
                  <span class="font-semibold text-purple-700" x-text="field.label || 'Label'"></span>
                  <span class="mx-1">:</span>
                  <span x-text="field.value || 'Value'"></span>
                </div>
                <button type="button" @click="headerFields.splice(index, 1)" 
                        class="text-xs px-2 py-1 bg-red-100 text-red-700 rounded hover:bg-red-200 font-semibold">
                  <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                  </svg>
                  Hapus
                </button>
              </div>
            </div>
          </template>
        </div>
      </div>

      {{-- Inspection Fields --}}
      <div class="bg-white rounded-xl shadow-lg ring-1 ring-slate-200 p-6 lg:col-span-2">
        <div class="flex items-center justify-between mb-4">
          <h2 class="text-lg font-bold flex items-center gap-2">
            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
            </svg>
            Inspection Fields
          </h2>
          <button type="button" @click="inspectionFields.push({key: 'field_' + Date.now(), label: '', type: 'text'})"
                  class="text-sm px-3 py-1 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 font-semibold">
            + Add Field
          </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <template x-for="(field, index) in inspectionFields" :key="index">
            <div class="p-4 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-lg border-2 border-blue-200">
              <input type="hidden" :name="'inspection_fields[' + index + '][key]'" :value="field.key">
              <div class="space-y-3">
                <div>
                  <label class="block text-xs font-bold text-blue-700 mb-1.5 uppercase tracking-wide">Field Label</label>
                  <input type="text" :name="'inspection_fields[' + index + '][label]'" x-model="field.label" placeholder="Contoh: Kondisi Tabung" required
                         class="w-full px-3 py-2 text-sm font-semibold border-2 border-blue-300 rounded-lg focus:ring-2 focus:ring-blue-500 bg-white">
                </div>
                <div>
                  <label class="block text-xs font-bold text-cyan-700 mb-1.5 uppercase tracking-wide">Field Type</label>
                  <select :name="'inspection_fields[' + index + '][type]'" x-model="field.type" required
                          class="w-full px-3 py-2 text-sm border-2 border-cyan-300 rounded-lg focus:ring-2 focus:ring-cyan-500 bg-white font-medium">
                    <option value="text">📝 Text</option>
                    <option value="checkbox">☑️ Checkbox</option>
                    <option value="textarea">📄 Textarea</option>
                    <option value="number">🔢 Number</option>
                    <option value="date">📅 Date</option>
                  </select>
                </div>
                <div class="pt-2 border-t border-blue-200">
                  <div class="text-xs text-gray-600 mb-2">
                    <span class="font-semibold text-blue-700" x-text="field.label || 'Field Label'"></span>
                    <span class="ml-2 px-2 py-0.5 bg-cyan-100 text-cyan-700 rounded text-xs font-bold" x-text="'(' + field.type + ')'"></span>
                  </div>
                  <button type="button" @click="inspectionFields.splice(index, 1)" 
                          class="w-full text-xs px-2 py-1 bg-red-100 text-red-700 rounded hover:bg-red-200 font-semibold">
                    <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus
                  </button>
                </div>
              </div>
            </div>
          </template>
        </div>
      </div>

      {{-- Footer Fields --}}
      <div class="bg-white rounded-xl shadow-lg ring-1 ring-slate-200 p-6 lg:col-span-2">
        <div class="flex items-center justify-between mb-4">
          <h2 class="text-lg font-bold flex items-center gap-2">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            Footer Fields
          </h2>
          <button type="button" @click="footerFields.push({key: 'field_' + Date.now(), label: '', value: ''})"
                  class="text-sm px-3 py-1 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 font-semibold">
            + Add
          </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <template x-for="(field, index) in footerFields" :key="index">
            <div class="p-4 bg-gradient-to-br from-green-50 to-emerald-50 rounded-lg border-2 border-green-200">
              <input type="hidden" :name="'footer_fields[' + index + '][key]'" :value="field.key">
              <div class="space-y-3">
                <div>
                  <label class="block text-xs font-bold text-green-700 mb-1.5 uppercase tracking-wide">Label (Judul)</label>
                  <input type="text" :name="'footer_fields[' + index + '][label]'" x-model="field.label" placeholder="Contoh: Lokasi" required
                         class="w-full px-3 py-2 text-sm font-semibold border-2 border-green-300 rounded-lg focus:ring-2 focus:ring-green-500 bg-white">
                </div>
                <div>
                  <label class="block text-xs font-bold text-emerald-700 mb-1.5 uppercase tracking-wide">Value (Isi)</label>
                  <input type="text" :name="'footer_fields[' + index + '][value]'" x-model="field.value" placeholder="Contoh: Surabaya" required
                         class="w-full px-3 py-2 text-sm border-2 border-emerald-300 rounded-lg focus:ring-2 focus:ring-emerald-500 bg-white">
                </div>
                <div class="pt-2 border-t border-green-200">
                  <div class="text-xs text-gray-600 mb-2">
                    <span class="font-semibold text-green-700" x-text="field.label || 'Label'"></span>
                    <span class="mx-1">:</span>
                    <span x-text="field.value || 'Value'"></span>
                  </div>
                  <button type="button" @click="footerFields.splice(index, 1)" 
                          class="w-full text-xs px-2 py-1 bg-red-100 text-red-700 rounded hover:bg-red-200 font-semibold">
                    <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus
                  </button>
                </div>
              </div>
            </div>
          </template>
        </div>
      </div>
    </div>

    {{-- Submit Button --}}
    <div class="mt-6 flex items-center gap-3">
      <button type="submit" class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all shadow-md font-semibold">
        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        Simpan Template
      </button>
      <a href="{{ route('admin.kartu-templates.index') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors font-semibold">
        Batal
      </a>
    </div>
  </form>
</x-layouts.app>
