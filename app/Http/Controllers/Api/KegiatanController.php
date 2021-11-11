<?php

namespace App\Http\Controllers\Api;

use App\Bidang;
use App\Http\Controllers\Controller;
use App\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KegiatanController extends Controller
{
    //
    public function index()
    {
        $kegiatan = DB::table('kegiatan')
            ->orderByRaw('created_at DESC')
            ->get();

        if ($kegiatan)
            return ResponseFormatter::success($kegiatan, 'Data kegiatan Berhasil Di ambil');
        else
            return ResponseFormatter::error('error', 'Data Kegiatan Kosong', 404);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $kegiatan = Kegiatan::create($data);

        if ($kegiatan)
            return ResponseFormatter::success($kegiatan, 'Berhasil Menambah Kegiatan');
    }

    public function delete($id)
    {
        $kegiatan = Kegiatan::find($id);

        if (!$kegiatan)
            return ResponseFormatter::error('error', 'Data Tidak Ditemukan', 404);

        $kegiatan->delete();

        if ($kegiatan)
            return ResponseFormatter::success($kegiatan, 'Berhasil Menghapus Kegiatan');

        else
            return ResponseFormatter::error($kegiatan, 'Gagal Menghapus Kegiatan', 404);
    }
}
