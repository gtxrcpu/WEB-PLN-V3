<x-layouts.app :title="'Item — User'">
  <h1 class="text-2xl font-bold mb-4">Item Saya</h1>
  <p class="text-slate-600 mb-6">Daftar item yang kamu miliki. (Nanti akan kita filter by owner & tambah cari/pagination.)</p>

  <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach (range(1,6) as $i)
      <div class="rounded-2xl bg-white p-4 ring-1 ring-slate-200 shadow-sm hover:shadow-md transition">
        <div class="aspect-[16/9] rounded-xl bg-slate-100 grid place-items-center text-slate-400">
          Gambar / Barcode
        </div>
        <div class="mt-3">
          <h3 class="font-semibold">Item #{{ $i }}</h3>
          <p class="text-sm text-slate-600">Lokasi / Kategori</p>
        </div>
        <div class="mt-3 flex gap-2">
          <a href="#" class="text-sm px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-700">Detail</a>
          <a href="#" class="text-sm px-3 py-1.5 rounded-lg bg-indigo-50 text-indigo-700">Inspeksi</a>
        </div>
      </div>
    @endforeach
  </div>
</x-layouts.app>
