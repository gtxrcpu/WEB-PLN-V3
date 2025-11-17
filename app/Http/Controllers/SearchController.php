<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SearchController extends Controller
{
    public function userItems(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $limit = (int) min(max((int) $request->query('limit', 8), 1), 20);

        // Jika tabel items belum ada, balas kosong agar UI tetap aman
        if (! Schema::hasTable('items')) {
            return response()->json(['data' => [], 'total' => 0]);
        }

        $builder = DB::table('items');

        // Batasi ke data milik user jika ada kolom user_id
        if (Schema::hasColumn('items', 'user_id') && $request->user()) {
            $builder->where('user_id', $request->user()->id);
        }

        // Cari di beberapa kolom jika ada
        $builder->when($q !== '', function ($b) use ($q) {
            $b->where(function ($w) use ($q) {
                foreach (['name','barcode','location','kode','nama','lokasi'] as $col) {
                    if (\Illuminate\Support\Facades\Schema::hasColumn('items', $col)) {
                        $w->orWhere($col, 'like', "%{$q}%");
                    }
                }
            });
        });

        // Kolom minimum yang kita kirim ke UI
        $select = array_values(array_filter([
            Schema::hasColumn('items', 'id') ? 'id' : null,
            Schema::hasColumn('items', 'name') ? 'name' : (Schema::hasColumn('items','nama') ? 'nama as name' : null),
            Schema::hasColumn('items', 'barcode') ? 'barcode' : null,
            Schema::hasColumn('items', 'location') ? 'location' : (Schema::hasColumn('items','lokasi') ? 'lokasi as location' : null),
            Schema::hasColumn('items', 'thumbnail_path') ? 'thumbnail_path' : null,
        ]));

        if (empty($select)) $select = ['*'];

        $rows = $builder->selectRaw(implode(',', $select))
                        ->orderByRaw(Schema::hasColumn('items','updated_at') ? 'updated_at desc' : '1')
                        ->limit($limit)
                        ->get();

        return response()->json([
            'data'  => $rows,
            'total' => $rows->count(),
        ]);
    }
}
