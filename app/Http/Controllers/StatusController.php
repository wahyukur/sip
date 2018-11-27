<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Timbang;

class StatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $nm = Carbon::now()->format('m'); // Tanggal sekarang bulan
        $nY = Carbon::now()->format('Y'); // Tanggal sekarang tahun
        $data = DB::table('timbangs as T')
            ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
            ->whereMonth('T.tgl_timbang', $nm)
            ->whereYear('T.tgl_timbang', $nY)
            ->where(function ($query) {
                $query->where('status_gizi', '=', 'BB Lebih')
                      ->orWhere('status_gizi', '=', 'BB Sangat Kurang');
            })
            ->get();
        // dd($data);
        $data2 = DB::table('timbangs as T')
            ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
            ->where(function ($query) {
                $query->where('status_gizi', '=', 'BB Lebih')
                      ->orWhere('status_gizi', '=', 'BB Sangat Kurang');
            })
            ->get();
        return view('admin.timbang.viewStatus', compact('data', 'data2'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $data = DB::table('timbangs as T')
            ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
            ->where('T.id_timbang', $id)->first();
        return view('admin.timbang.detailDataStatus', compact('data'));
    }

    public function edit($id)
    {
        $data = DB::table('timbangs as T')
            ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
            ->where('T.id_timbang', $id)->first();
        return view('admin.timbang.editDataStatus', compact('data'));
    }

    public function update(Request $request, $id)
    {
        // menerima data request
        $data = Anak::where('id_timbang', $id)->first();
        $data->gibur_klinis = $request->get('gibur_klinis');
        $data->id_ibu       = $request->get('st_gizi_bbtb');
        $data->tempat_lhr   = $request->get('penanganan');
        $data->tgl_lhr      = $request->get('penyebab_utama');
        $data->bb_lahir     = $request->get('alasan_gibur');
        $data->tb_lahir     = $request->get('tindakan');
        $data->save();

        return redirect()->route('statusgizi.index')->with(['success' => 'Data Berhasil Di Update']);
    }

    public function destroy($id)
    {
        //
    }

    ////////
    public function viewBGM()
    {
        date_default_timezone_set('Asia/Jakarta');
        $nm = Carbon::now()->format('m'); // Tanggal sekarang bulan
        $nY = Carbon::now()->format('Y'); // Tanggal sekarang tahun
        $data = DB::table('timbangs as T')
            ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
            ->whereMonth('T.tgl_timbang', $nm)
            ->whereYear('T.tgl_timbang', $nY)
            ->where(function ($query) {
                $query->where('ket_timbang', '=', 'Balita BGM')
                      ->orWhere('ket_timbang', '=', 'Balita 2T');
            })
            ->get();
        // dd($data);
        $data2 = DB::table('timbangs as T')
            ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
            ->where(function ($query) {
                $query->where('ket_timbang', '=', 'Balita BGM')
                      ->orWhere('ket_timbang', '=', 'Balita 2T');
            })
            ->get();
        return view('admin.timbang.viewBGM', compact('data', 'data2'));
    }
}
