<?php

namespace App\Http\Controllers\Api;

use App\Anggaran;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\AnggaranExport;
use App\Exports\AnggaranExcel;
use Illuminate\Support\Facades\Date;
// use App\Exports\SiswaExport;
use Maatwebsite\Excel\Facades\Excel;

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

    public function anggaran_excel()
    {
        // return Excel::download(new AnggaranExport, 'Anggaran.xlsx');
        // return Excel::download(new AnggaranExportVie, 'Anggaran.xlsx');
        return Excel::download(new AnggaranExcel, 'RAB.xlsx');
    }
}
