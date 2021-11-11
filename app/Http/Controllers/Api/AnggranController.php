<?php

namespace App\Http\Controllers\Api;

use App\Anggaran;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnggranController extends Controller
{
    public function index()
    {
        $anggaran = DB::table('anggaran')
            ->orderByRaw('created_at DESC')
            ->get();

        if ($anggaran)
            return ResponseFormatter::success($anggaran, 'Data Anggaran Berhasil Di ambil');
        else
            return ResponseFormatter::error('error', 'Data Anggaran Kosong', 404);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $anggaran = Anggaran::create($data);

        if ($anggaran)
            return ResponseFormatter::success($anggaran, 'Berhasil Menambah Anggaran');
    }

    public function delete($id)
    {
        $anggaran = Anggaran::find($id);

        if (!$anggaran)
            return ResponseFormatter::error('error', 'Data Tidak Ditemukan', 404);

        $anggaran->delete();

        if ($anggaran)
            return ResponseFormatter::success($anggaran, 'Berhasil Menghapus Anggaran');

        else
            return ResponseFormatter::error($anggaran, 'Gagal Menghapus Anggaran', 404);
    }

    public function download_excel()
    {
        echo "tes";
    }
}
