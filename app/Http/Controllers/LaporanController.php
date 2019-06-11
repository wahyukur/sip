<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timbang;
use App\Kegiatan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use PDF;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $data = DB::table('kegiatans as K')
                ->leftjoin('agendas as A', 'K.id_agenda' , '=', 'A.id_agenda')
                ->where('A.j_kegiatan', '=', 0)
                ->get();
        $get_bln = DB::table('kegiatans as K')
                ->select(DB::raw('YEAR(A.start) year'))
                ->leftjoin('agendas as A', 'K.id_agenda' , '=', 'A.id_agenda')
                ->groupby('year')
                ->get();

        // dd($get_bln);
        return view('admin.laporan.create', compact('get_bln', 'data'));
    }

    public function store(Request $request)
    {
        $form = $request->get('form');
        $tahun = date('Y', strtotime($request->get('tahun')));
        $bulan = date('m', strtotime($request->get('bulan')));

        ////Bla bla bla bla abla bla bla;
        if ($form == "form1") {
            $data = DB::table('kegiatans as K')
                ->leftjoin('agendas as A', 'K.id_agenda', '=', 'A.id_agenda')
                ->whereMonth('A.start', $bulan)->whereYear('A.start', $tahun)
                ->where('A.j_kegiatan', '=', 0)
                ->first();

            // nomer1
            $S1AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)->whereNull('A.BPJS_anak')
                ->count();
            $S1AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)->whereNull('A.BPJS_anak')
                ->count();
            $S1BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)->whereNotNull('A.BPJS_anak')
                ->count();
            $S1BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)->whereNotNull('A.BPJS_anak')
                ->count();
            $S1TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 0)
                ->count();
            $S1TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 1)
                ->count();
            ///////////////
            // nomer2
            $S2AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)->whereNull('A.BPJS_anak')
                ->count();
            $S2AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)->whereNull('A.BPJS_anak')
                ->count();
            $S2BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)->whereNotNull('A.BPJS_anak')
                ->count();
            $S2BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)->whereNotNull('A.BPJS_anak')
                ->count();
            $S2TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 0)
                ->count();
            $S2TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 1)
                ->count();
            //////////////
            // nomer3
            $S3AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)->whereNull('A.BPJS_anak')
                ->count();
            $S3AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)->whereNull('A.BPJS_anak')
                ->count();
            $S3BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)->whereNotNull('A.BPJS_anak')
                ->count();
            $S3BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)->whereNotNull('A.BPJS_anak')
                ->count();
            $S3TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 0)
                ->count();
            $S3TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 1)
                ->count();
            //////////////
            // nomer4
            $S4AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)->whereNull('A.BPJS_anak')
                ->count();
            $S4AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)->whereNull('A.BPJS_anak')
                ->count();
            $S4BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)->whereNotNull('A.BPJS_anak')
                ->count();
            $S4BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)->whereNotNull('A.BPJS_anak')
                ->count();
            $S4TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 0)
                ->count();
            $S4TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 1)
                ->count();
            //////////////
            // nomer5
            $S5AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)->whereNull('A.BPJS_anak')
                ->count();
            $S5AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)->whereNull('A.BPJS_anak')
                ->count();
            $S5BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)->whereNotNull('A.BPJS_anak')
                ->count();
            $S5BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)->whereNotNull('A.BPJS_anak')
                ->count();
            $S5TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 0)
                ->count();
            $S5TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 1)
                ->count();
            //////////////
            // nomer6
            $K6AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 0)
                ->whereNull('A.BPJS_anak')->where('A.KMS', '=', 0)->where('I.gakin', '=', 1)
                ->count();
            $K6AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 1)
                ->whereNull('A.BPJS_anak')->where('A.KMS', '=', 0)->where('I.gakin', '=', 1)
                ->count();
            $K6BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 0)
                ->whereNotNull('A.BPJS_anak')->where('A.KMS', '=', 0)->where('I.gakin', '=', 1)
                ->count();
            $K6BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 1)
                ->whereNotNull('A.BPJS_anak')->where('A.KMS', '=', 0)->where('I.gakin', '=', 1)
                ->count();
            $K6TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 0)
                ->where('A.KMS', '=', 0)
                ->count();
            $K6TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 1)
                ->where('A.KMS', '=', 0)
                ->count();
            ///////////////
            // nomer7
            $K7AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 0)
                ->whereNull('A.BPJS_anak')->where('A.KMS', '=', 0)->where('I.gakin', '=', 1)
                ->count();
            $K7AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 1)
                ->whereNull('A.BPJS_anak')->where('A.KMS', '=', 0)->where('I.gakin', '=', 1)
                ->count();
            $K7BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 0)
                ->whereNotNull('A.BPJS_anak')->where('A.KMS', '=', 0)->where('I.gakin', '=', 1)
                ->count();
            $K7BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 1)
                ->whereNotNull('A.BPJS_anak')->where('A.KMS', '=', 0)->where('I.gakin', '=', 1)
                ->count();
            $K7TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 0)
                ->where('A.KMS', '=', 0)
                ->count();
            $K7TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 1)
                ->where('A.KMS', '=', 0)
                ->count();
            //////////////
            // nomer8
            $K8AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 0)
                ->whereNull('A.BPJS_anak')->where('A.KMS', '=', 0)->where('I.gakin', '=', 1)
                ->count();
            $K8AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 1)
                ->whereNull('A.BPJS_anak')->where('A.KMS', '=', 0)->where('I.gakin', '=', 1)
                ->count();
            $K8BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 0)
                ->whereNotNull('A.BPJS_anak')->where('A.KMS', '=', 0)->where('I.gakin', '=', 1)
                ->count();
            $K8BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 1)
                ->whereNotNull('A.BPJS_anak')->where('A.KMS', '=', 0)->where('I.gakin', '=', 1)
                ->count();
            $K8TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 0)
                ->where('A.KMS', '=', 0)
                ->count();
            $K8TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 1)
                ->where('A.KMS', '=', 0)
                ->count();
            //////////////
            // nomer9
            $K9AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 0)
                ->whereNull('A.BPJS_anak')->where('A.KMS', '=', 0)->where('I.gakin', '=', 1)
                ->count();
            $K9AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 1)
                ->whereNull('A.BPJS_anak')->where('A.KMS', '=', 0)->where('I.gakin', '=', 1)
                ->count();
            $K9BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 0)
                ->whereNotNull('A.BPJS_anak')->where('A.KMS', '=', 0)->where('I.gakin', '=', 1)
                ->count();
            $K9BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 1)
                ->whereNotNull('A.BPJS_anak')->where('A.KMS', '=', 0)->where('I.gakin', '=', 1)
                ->count();
            $K9TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 0)
                ->where('A.KMS', '=', 0)
                ->count();
            $K9TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 1)
                ->where('A.KMS', '=', 0)
                ->count();
            //////////////
            // nomer10
            $K10AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 0)
                ->whereNull('A.BPJS_anak')->where('A.KMS', '=', 0)->where('I.gakin', '=', 1)
                ->count();
            $K10AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 1)
                ->whereNull('A.BPJS_anak')->where('A.KMS', '=', 0)->where('I.gakin', '=', 1)
                ->count();
            $K10BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 0)
                ->whereNotNull('A.BPJS_anak')->where('A.KMS', '=', 0)->where('I.gakin', '=', 1)
                ->count();
            $K10BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 1)
                ->whereNotNull('A.BPJS_anak')->where('A.KMS', '=', 0)->where('I.gakin', '=', 1)
                ->count();
            $K10TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 0)
                ->where('A.KMS', '=', 0)
                ->count();
            $K10TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 1)
                ->where('A.KMS', '=', 0)
                ->count();
            //////////////
            // nomer11
            $D11AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 0)
                ->whereNull('A.BPJS_anak')->where('I.gakin', '=', 1)
                ->count();
            $D11AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 1)
                ->whereNull('A.BPJS_anak')->where('I.gakin', '=', 1)
                ->count();
            $D11BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 0)
                ->whereNotNull('A.BPJS_anak')->where('I.gakin', '=', 1)
                ->count();
            $D11BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 1)
                ->whereNotNull('A.BPJS_anak')->where('I.gakin', '=', 1)
                ->count();
            $D11TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 0)
                ->count();
            $D11TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 1)
                ->count();
            ///////////////
            // nomer12
            $D12AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 0)
                ->whereNull('A.BPJS_anak')->where('I.gakin', '=', 1)
                ->count();
            $D12AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 1)
                ->whereNull('A.BPJS_anak')->where('I.gakin', '=', 1)
                ->count();
            $D12BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 0)
                ->whereNotNull('A.BPJS_anak')->where('I.gakin', '=', 1)
                ->count();
            $D12BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 1)
                ->whereNotNull('A.BPJS_anak')->where('I.gakin', '=', 1)
                ->count();
            $D12TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 0)
                ->count();
            $D12TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 1)
                ->count();
            //////////////
            // nomer13
            $D13AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 0)
                ->whereNull('A.BPJS_anak')->where('I.gakin', '=', 1)
                ->count();
            $D13AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 1)
                ->whereNull('A.BPJS_anak')->where('I.gakin', '=', 1)
                ->count();
            $D13BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 0)
                ->whereNotNull('A.BPJS_anak')->where('I.gakin', '=', 1)
                ->count();
            $D13BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 1)
                ->whereNotNull('A.BPJS_anak')->where('I.gakin', '=', 1)
                ->count();
            $D13TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 0)
                ->count();
            $D13TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 1)
                ->count();
            //////////////
            // nomer14
            $D14AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 0)
                ->whereNull('A.BPJS_anak')->where('I.gakin', '=', 1)
                ->count();
            $D14AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 1)
                ->whereNull('A.BPJS_anak')->where('I.gakin', '=', 1)
                ->count();
            $D14BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 0)
                ->whereNotNull('A.BPJS_anak')->where('I.gakin', '=', 1)
                ->count();
            $D14BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 1)
                ->whereNotNull('A.BPJS_anak')->where('I.gakin', '=', 1)
                ->count();
            $D14TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 0)
                ->count();
            $D14TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 1)
                ->count();
            //////////////
            // nomer15
            $D15AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 0)
                ->whereNull('A.BPJS_anak')->where('I.gakin', '=', 1)
                ->count();
            $D15AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 1)
                ->whereNull('A.BPJS_anak')->where('I.gakin', '=', 1)
                ->count();
            $D15BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 0)
                ->whereNotNull('A.BPJS_anak')->where('I.gakin', '=', 1)
                ->count();
            $D15BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 1)
                ->whereNotNull('A.BPJS_anak')->where('I.gakin', '=', 1)
                ->count();
            $D15TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 0)
                ->count();
            $D15TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 1)
                ->count();
            //////////////
            // nomer16
            $N16AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 0)
                ->whereNull('A.BPJS_anak')->where('T.ind_naik', '=', 'naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $N16AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 1)
                ->whereNull('A.BPJS_anak')->where('T.ind_naik', '=', 'naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $N16BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 0)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_naik', '=', 'naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $N16BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 1)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_naik', '=', 'naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $N16TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 0)
                ->where('T.ind_naik', '=', 'naik')
                ->count();
            $N16TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 1)
                ->where('T.ind_naik', '=', 'naik')
                ->count();
            ///////////////
            // nomer17
            $N17AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 0)
                ->whereNull('A.BPJS_anak')->where('T.ind_naik', '=', 'naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $N17AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 1)
                ->whereNull('A.BPJS_anak')->where('T.ind_naik', '=', 'naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $N17BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 0)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_naik', '=', 'naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $N17BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 1)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_naik', '=', 'naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $N17TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 0)
                ->where('T.ind_naik', '=', 'naik')
                ->count();
            $N17TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 1)
                ->where('T.ind_naik', '=', 'naik')
                ->count();
            //////////////
            // nomer18
            $N18AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 0)
                ->whereNull('A.BPJS_anak')->where('T.ind_naik', '=', 'naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $N18AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 1)
                ->whereNull('A.BPJS_anak')->where('T.ind_naik', '=', 'naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $N18BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 0)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_naik', '=', 'naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $N18BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 1)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_naik', '=', 'naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $N18TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 0)
                ->where('T.ind_naik', '=', 'naik')
                ->count();
            $N18TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 1)
                ->where('T.ind_naik', '=', 'naik')
                ->count();
            //////////////
            // nomer19
            $N19AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 0)
                ->whereNull('A.BPJS_anak')->where('T.ind_naik', '=', 'naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $N19AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 1)
                ->whereNull('A.BPJS_anak')->where('T.ind_naik', '=', 'naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $N19BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 0)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_naik', '=', 'naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $N19BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 1)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_naik', '=', 'naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $N19TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 0)
                ->where('T.ind_naik', '=', 'naik')
                ->count();
            $N19TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 1)
                ->where('T.ind_naik', '=', 'naik')
                ->count();
            //////////////
            // nomer20
            $N20AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 0)
                ->whereNull('A.BPJS_anak')->where('T.ind_naik', '=', 'naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $N20AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 1)
                ->whereNull('A.BPJS_anak')->where('T.ind_naik', '=', 'naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $N20BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 0)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_naik', '=', 'naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $N20BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 1)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_naik', '=', 'naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $N20TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 0)
                ->where('T.ind_naik', '=', 'naik')
                ->count();
            $N20TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 1)
                ->where('T.ind_naik', '=', 'naik')
                ->count();
            //////////////
            // nomer21
            $T21AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 0)
                ->whereNull('A.BPJS_anak')->where('T.ind_naik', '=', 'tdk naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $T21AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 1)
                ->whereNull('A.BPJS_anak')->where('T.ind_naik', '=', 'tdk naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $T21BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 0)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_naik', '=', 'tdk naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $T21BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 1)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_naik', '=', 'tdk naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $T21TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 0)
                ->where('T.ind_naik', '=', 'tdk naik')
                ->count();
            $T21TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 1)
                ->where('T.ind_naik', '=', 'tdk naik')
                ->count();
            ///////////////
            // nomer22
            $T22AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 0)
                ->whereNull('A.BPJS_anak')->where('T.ind_naik', '=', 'tdk naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $T22AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 1)
                ->whereNull('A.BPJS_anak')->where('T.ind_naik', '=', 'tdk naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $T22BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 0)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_naik', '=', 'tdk naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $T22BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 1)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_naik', '=', 'tdk naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $T22TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 0)
                ->where('T.ind_naik', '=', 'tdk naik')
                ->count();
            $T22TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 1)
                ->where('T.ind_naik', '=', 'tdk naik')
                ->count();
            //////////////
            // nomer23
            $T23AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 0)
                ->whereNull('A.BPJS_anak')->where('T.ind_naik', '=', 'tdk naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $T23AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 1)
                ->whereNull('A.BPJS_anak')->where('T.ind_naik', '=', 'tdk naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $T23BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 0)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_naik', '=', 'tdk naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $T23BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 1)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_naik', '=', 'tdk naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $T23TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 0)
                ->where('T.ind_naik', '=', 'tdk naik')
                ->count();
            $T23TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 1)
                ->where('T.ind_naik', '=', 'tdk naik')
                ->count();
            //////////////
            // nomer24
            $T24AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 0)
                ->whereNull('A.BPJS_anak')->where('T.ind_naik', '=', 'tdk naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $T24AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 1)
                ->whereNull('A.BPJS_anak')->where('T.ind_naik', '=', 'tdk naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $T24BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 0)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_naik', '=', 'tdk naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $T24BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 1)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_naik', '=', 'tdk naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $T24TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 0)
                ->where('T.ind_naik', '=', 'tdk naik')
                ->count();
            $T24TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 1)
                ->where('T.ind_naik', '=', 'tdk naik')
                ->count();
            //////////////
            // nomer25
            $T25AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 0)
                ->whereNull('A.BPJS_anak')->where('T.ind_naik', '=', 'tdk naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $T25AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 1)
                ->whereNull('A.BPJS_anak')->where('T.ind_naik', '=', 'tdk naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $T25BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 0)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_naik', '=', 'tdk naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $T25BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 1)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_naik', '=', 'tdk naik')
                ->where('I.gakin', '=', 1)
                ->count();
            $T25TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 0)
                ->where('T.ind_naik', '=', 'tdk naik')
                ->count();
            $T25TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 1)
                ->where('T.ind_naik', '=', 'tdk naik')
                ->count();
            //////////////
            // nomer26
            $a2T26AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)
                ->whereNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita 2T')->orWhere('T.ket_timbang', '=', 'Balita 2T & BGM')
                ->count();
            $a2T26AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)
                ->whereNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita 2T')->orWhere('T.ket_timbang', '=', 'Balita 2T & BGM')
                ->count();
            $a2T26BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)
                ->whereNotNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita 2T')->orWhere('T.ket_timbang', '=', 'Balita 2T & BGM')
                ->count();
            $a2T26BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)
                ->whereNotNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita 2T')->orWhere('T.ket_timbang', '=', 'Balita 2T & BGM')
                ->count();
            $a2T26TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 0)
                ->where('T.ket_timbang', '=', 'Balita 2T')->orWhere('T.ket_timbang', '=', 'Balita 2T & BGM')
                ->count();
            $a2T26TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 1)
                ->where('T.ket_timbang', '=', 'Balita 2T')->orWhere('T.ket_timbang', '=', 'Balita 2T & BGM')
                ->count();
            ///////////////
            // nomer27
            $a2T27AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)
                ->whereNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita 2T')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $a2T27AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)
                ->whereNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita 2T')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $a2T27BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)
                ->whereNotNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita 2T')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $a2T27BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)
                ->whereNotNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita 2T')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $a2T27TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 0)
                ->where('T.ket_timbang', '=', 'Balita 2T')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $a2T27TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 1)
                ->where('T.ket_timbang', '=', 'Balita 2T')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            //////////////
            // nomer28
            $a2T28AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)
                ->whereNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita 2T')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $a2T28AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)
                ->whereNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita 2T')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $a2T28BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)
                ->whereNotNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita 2T')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $a2T28BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)
                ->whereNotNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita 2T')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $a2T28TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 0)
                ->where('T.ket_timbang', '=', 'Balita 2T')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $a2T28TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 1)
                ->where('T.ket_timbang', '=', 'Balita 2T')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            //////////////
            // nomer29
            $a2T29AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)
                ->whereNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita 2T')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $a2T29AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)
                ->whereNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita 2T')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $a2T29BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)
                ->whereNotNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita 2T')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $a2T29BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)
                ->whereNotNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita 2T')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $a2T29TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 0)
                ->where('T.ket_timbang', '=', 'Balita 2T')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $a2T29TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 1)
                ->where('T.ket_timbang', '=', 'Balita 2T')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            //////////////
            // nomer30
            $a2T30AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)
                ->whereNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita 2T')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $a2T30AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)
                ->whereNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita 2T')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $a2T30BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)
                ->whereNotNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita 2T')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $a2T30BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)
                ->whereNotNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita 2T')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $a2T30TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 0)
                ->where('T.ket_timbang', '=', 'Balita 2T')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $a2T30TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 1)
                ->where('T.ket_timbang', '=', 'Balita 2T')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            //////////////
            // nomer31
            $O31AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 0)
                ->whereNull('A.BPJS_anak')->where('T.ind_t_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $O31AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 1)
                ->whereNull('A.BPJS_anak')->where('T.ind_t_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $O31BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 0)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_t_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $O31BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 1)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_t_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $O31TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 0)
                ->where('T.ind_t_lalu', '=', 0)
                ->count();
            $O31TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 1)
                ->where('T.ind_t_lalu', '=', 0)
                ->count();
            ///////////////
            // nomer32
            $O32AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 0)
                ->whereNull('A.BPJS_anak')->where('T.ind_t_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $O32AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 1)
                ->whereNull('A.BPJS_anak')->where('T.ind_t_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $O32BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 0)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_t_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $O32BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 1)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_t_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $O32TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 0)
                ->where('T.ind_t_lalu', '=', 0)
                ->count();
            $O32TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 1)
                ->where('T.ind_t_lalu', '=', 0)
                ->count();
            //////////////
            // nomer33
            $O33AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 0)
                ->whereNull('A.BPJS_anak')->where('T.ind_t_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $O33AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 1)
                ->whereNull('A.BPJS_anak')->where('T.ind_t_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $O33BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 0)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_t_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $O33BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 1)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_t_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $O33TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 0)
                ->where('T.ind_t_lalu', '=', 0)
                ->count();
            $O33TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 1)
                ->where('T.ind_t_lalu', '=', 0)
                ->count();
            //////////////
            // nomer34
            $O34AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 0)
                ->whereNull('A.BPJS_anak')->where('T.ind_t_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $O34AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 1)
                ->whereNull('A.BPJS_anak')->where('T.ind_t_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $O34BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 0)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_t_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $O34BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 1)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_t_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $O34TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 0)
                ->where('T.ind_t_lalu', '=', 0)
                ->count();
            $O34TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 1)
                ->where('T.ind_t_lalu', '=', 0)
                ->count();
            //////////////
            // nomer35
            $O35AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 0)
                ->whereNull('A.BPJS_anak')->where('T.ind_t_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $O35AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 1)
                ->whereNull('A.BPJS_anak')->where('T.ind_t_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $O35BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 0)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_t_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $O35BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 1)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_t_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $O35TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 0)
                ->where('T.ind_t_lalu', '=', 0)
                ->count();
            $O35TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 1)
                ->where('T.ind_t_lalu', '=', 0)
                ->count();
            //////////////
            // nomer36
            $B36AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 0)
                ->whereNull('A.BPJS_anak')->where('T.ind_b_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $B36AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 1)
                ->whereNull('A.BPJS_anak')->where('T.ind_b_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $B36BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 0)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_b_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $B36BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 1)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_b_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $B36TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 0)
                ->where('T.ind_b_lalu', '=', 0)
                ->count();
            $B36TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 1)
                ->where('T.ind_b_lalu', '=', 0)
                ->count();
            ///////////////
            // nomer37
            $B37AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 0)
                ->whereNull('A.BPJS_anak')->where('T.ind_b_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $B37AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 1)
                ->whereNull('A.BPJS_anak')->where('T.ind_b_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $B37BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 0)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_b_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $B37BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 1)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_b_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $B37TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 0)
                ->where('T.ind_b_lalu', '=', 0)
                ->count();
            $B37TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 1)
                ->where('T.ind_b_lalu', '=', 0)
                ->count();
            //////////////
            // nomer38
            $B38AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 0)
                ->whereNull('A.BPJS_anak')->where('T.ind_b_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $B38AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 1)
                ->whereNull('A.BPJS_anak')->where('T.ind_b_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $B38BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 0)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_b_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $B38BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 1)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_b_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $B38TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 0)
                ->where('T.ind_b_lalu', '=', 0)
                ->count();
            $B38TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 1)
                ->where('T.ind_b_lalu', '=', 0)
                ->count();
            //////////////
            // nomer39
            $B39AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 0)
                ->whereNull('A.BPJS_anak')->where('T.ind_b_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $B39AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 1)
                ->whereNull('A.BPJS_anak')->where('T.ind_b_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $B39BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 0)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_b_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $B39BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 1)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_b_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $B39TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 0)
                ->where('T.ind_b_lalu', '=', 0)
                ->count();
            $B39TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 1)
                ->where('T.ind_b_lalu', '=', 0)
                ->count();
            //////////////
            // nomer40
            $B40AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 0)
                ->whereNull('A.BPJS_anak')->where('T.ind_b_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $B40AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 1)
                ->whereNull('A.BPJS_anak')->where('T.ind_b_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $B40BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 0)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_b_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $B40BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 1)
                ->whereNotNull('A.BPJS_anak')->where('T.ind_b_lalu', '=', 0)
                ->where('I.gakin', '=', 1)
                ->count();
            $B40TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 0)
                ->where('T.ind_b_lalu', '=', 0)
                ->count();
            $B40TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 1)
                ->where('T.ind_b_lalu', '=', 0)
                ->count();
            //////////////
            // nomer41
            $BGM41AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)
                ->whereNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita BGM')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $BGM41AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)
                ->whereNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita BGM')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $BGM41BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)
                ->whereNotNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita BGM')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $BGM41BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)
                ->whereNotNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita BGM')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $BGM41TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 0)
                ->where('T.ket_timbang', '=', 'Balita BGM')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $BGM41TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 1)
                ->where('T.ket_timbang', '=', 'Balita BGM')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            ///////////////
            // nomer42
            $BGM42AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)
                ->whereNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita BGM')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $BGM42AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)
                ->whereNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita BGM')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $BGM42BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)
                ->whereNotNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita BGM')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $BGM42BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)
                ->whereNotNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita BGM')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $BGM42TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 0)
                ->where('T.ket_timbang', '=', 'Balita BGM')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $BGM42TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 1)
                ->where('T.ket_timbang', '=', 'Balita BGM')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            //////////////
            // nomer43
            $BGM43AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)
                ->whereNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita BGM')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $BGM43AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)
                ->whereNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita BGM')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $BGM43BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)
                ->whereNotNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita BGM')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $BGM43BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)
                ->whereNotNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita BGM')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $BGM43TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 0)
                ->where('T.ket_timbang', '=', 'Balita BGM')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $BGM43TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 1)
                ->where('T.ket_timbang', '=', 'Balita BGM')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            //////////////
            // nomer44
            $BGM44AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)
                ->whereNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita BGM')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $BGM44AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)
                ->whereNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita BGM')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $BGM44BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)
                ->whereNotNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita BGM')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $BGM44BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)
                ->whereNotNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita BGM')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $BGM44TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 0)
                ->where('T.ket_timbang', '=', 'Balita BGM')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $BGM44TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 1)
                ->where('T.ket_timbang', '=', 'Balita BGM')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            //////////////
            // nomer45
            $BGM45AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)
                ->whereNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita BGM')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $BGM45AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)
                ->whereNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita BGM')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $BGM45BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)
                ->whereNotNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita BGM')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $BGM45BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)
                ->whereNotNull('A.BPJS_anak')
                ->where('T.ket_timbang', '=', 'Balita BGM')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $BGM45TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 0)
                ->where('T.ket_timbang', '=', 'Balita BGM')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            $BGM45TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 1)
                ->where('T.ket_timbang', '=', 'Balita BGM')->orWhere('T.ket_timbang', 'Balita 2T & BGM')
                ->count();
            //////////////
            // nomer46
            $BSK46AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)->whereNull('A.BPJS_anak')
                ->where('T.status_gizi', '=', 'BB Sangat Kurang')
                ->count();
            $BSK46AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)->whereNull('A.BPJS_anak')
                ->where('T.status_gizi', '=', 'BB Sangat Kurang')
                ->count();
            $BSK46BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)->whereNotNull('A.BPJS_anak')
                ->where('T.status_gizi', '=', 'BB Sangat Kurang')
                ->count();
            $BSK46BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)->whereNotNull('A.BPJS_anak')
                ->where('T.status_gizi', '=', 'BB Sangat Kurang')
                ->count();
            $BSK46TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->where('A.jenis_kelamin', '=', 0)
                ->where('T.status_gizi', '=', 'BB Sangat Kurang')
                ->count();
            $BSK46TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->where('A.jenis_kelamin', '=', 1)
                ->where('T.status_gizi', '=', 'BB Sangat Kurang')
                ->count();
            //////////////
            // nomer47
            $BBK47AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)->whereNull('A.BPJS_anak')
                ->where('status_gizi', '=', 'BB Kurang')
                ->count();
            $BBK47AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)->whereNull('A.BPJS_anak')
                ->where('status_gizi', '=', 'BB Kurang')
                ->count();
            $BBK47BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)->whereNotNull('A.BPJS_anak')
                ->where('status_gizi', '=', 'BB Kurang')
                ->count();
            $BBK47BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)->whereNotNull('A.BPJS_anak')
                ->where('status_gizi', '=', 'BB Kurang')
                ->count();
            $BBK47TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->where('A.jenis_kelamin', '=', 0)
                ->where('status_gizi', '=', 'BB Kurang')
                ->count();
            $BBK47TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->where('A.jenis_kelamin', '=', 1)
                ->where('status_gizi', '=', 'BB Kurang')
                ->count();
            //////////////
            // nomer48
            $BBN48AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)->whereNull('A.BPJS_anak')
                ->where('status_gizi', '=', 'BB Normal')
                ->count();
            $BBN48AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)->whereNull('A.BPJS_anak')
                ->where('status_gizi', '=', 'BB Normal')
                ->count();
            $BBN48BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)->whereNotNull('A.BPJS_anak')
                ->where('status_gizi', '=', 'BB Normal')
                ->count();
            $BBN48BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)->whereNotNull('A.BPJS_anak')
                ->where('status_gizi', '=', 'BB Normal')
                ->count();
            $BBN48TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->where('A.jenis_kelamin', '=', 0)
                ->where('status_gizi', '=', 'BB Normal')
                ->count();
            $BBN48TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->where('A.jenis_kelamin', '=', 1)
                ->where('status_gizi', '=', 'BB Normal')
                ->count();
            //////////////
            // nomer49
            $BBL49AL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)->whereNull('A.BPJS_anak')
                ->where('status_gizi', '=', 'BB Lebih')
                ->count();
            $BBL49AP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)->whereNull('A.BPJS_anak')
                ->where('status_gizi', '=', 'BB Lebih')
                ->count();
            $BBL49BL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->where('A.jenis_kelamin', '=', 0)
                ->where('I.gakin', '=', 1)->whereNotNull('A.BPJS_anak')
                ->where('status_gizi', '=', 'BB Lebih')
                ->count();
            $BBL49BP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->where('A.jenis_kelamin', '=', 1)
                ->where('I.gakin', '=', 1)->whereNotNull('A.BPJS_anak')
                ->where('status_gizi', '=', 'BB Lebih')
                ->count();
            $BBL49TL = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->where('A.jenis_kelamin', '=', 0)
                ->where('status_gizi', '=', 'BB Lebih')
                ->count();
            $BBL49TP = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->where('A.jenis_kelamin', '=', 1)
                ->where('status_gizi', '=', 'BB Lebih')
                ->count();
            //////////////

            $pdf = PDF::loadView('admin.laporan.form1', compact(
                'data',
                'S1AL','S1AP','S1BL','S1BP','S1TL','S1TP',
                'S2AL','S2AP','S2BL','S2BP','S2TL','S2TP',
                'S3AL','S3AP','S3BL','S3BP','S3TL','S3TP',
                'S4AL','S4AP','S4BL','S4BP','S4TL','S4TP',
                'S5AL','S5AP','S5BL','S5BP','S5TL','S5TP',
                'K6AL','K6AP','K6BL','K6BP','K6TL','K6TP',
                'K7AL','K7AP','K7BL','K7BP','K7TL','K7TP',
                'K8AL','K8AP','K8BL','K8BP','K8TL','K8TP',
                'K9AL','K9AP','K9BL','K9BP','K9TL','K9TP',
                'K10AL','K10AP','K10BL','K10BP','K10TL','K10TP',
                'D11AL','D11AP','D11BL','D11BP','D11TL','D11TP',
                'D12AL','D12AP','D12BL','D12BP','D12TL','D12TP',
                'D13AL','D13AP','D13BL','D13BP','D13TL','D13TP',
                'D14AL','D14AP','D14BL','D14BP','D14TL','D14TP',
                'D15AL','D15AP','D15BL','D15BP','D15TL','D15TP',
                'N16AL','N16AP','N16BL','N16BP','N16TL','N16TP',
                'N17AL','N17AP','N17BL','N17BP','N17TL','N17TP',
                'N18AL','N18AP','N18BL','N18BP','N18TL','N18TP',
                'N19AL','N19AP','N19BL','N19BP','N19TL','N19TP',
                'N20AL','N20AP','N20BL','N20BP','N20TL','N20TP',
                'T21AL','T21AP','T21BL','T21BP','T21TL','T21TP',
                'T22AL','T22AP','T22BL','T22BP','T22TL','T22TP',
                'T23AL','T23AP','T23BL','T23BP','T23TL','T23TP',
                'T24AL','T24AP','T24BL','T24BP','T24TL','T24TP',
                'T25AL','T25AP','T25BL','T25BP','T25TL','T25TP',
                'a2T26AL','a2T26AP','a2T26BL','a2T26BP','a2T26TL','a2T26TP',
                'a2T27AL','a2T27AP','a2T27BL','a2T27BP','a2T27TL','a2T27TP',
                'a2T28AL','a2T28AP','a2T28BL','a2T28BP','a2T28TL','a2T28TP',
                'a2T29AL','a2T29AP','a2T29BL','a2T29BP','a2T29TL','a2T29TP',
                'a2T30AL','a2T30AP','a2T30BL','a2T30BP','a2T30TL','a2T30TP',
                'O31AL','O31AP','O31BL','O31BP','O31TL','O31TP',
                'O32AL','O32AP','O32BL','O32BP','O32TL','O32TP',
                'O33AL','O33AP','O33BL','O33BP','O33TL','O33TP',
                'O34AL','O34AP','O34BL','O34BP','O34TL','O34TP',
                'O35AL','O35AP','O35BL','O35BP','O35TL','O35TP',
                'B36AL','B36AP','B36BL','B36BP','B36TL','B36TP',
                'B37AL','B37AP','B37BL','B37BP','B37TL','B37TP',
                'B38AL','B38AP','B38BL','B38BP','B38TL','B38TP',
                'B39AL','B39AP','B39BL','B39BP','B39TL','B39TP',
                'B40AL','B40AP','B40BL','B40BP','B40TL','B40TP',
                'BGM41AL','BGM41AP','BGM41BL','BGM41BP','BGM41TL','BGM41TP',
                'BGM42AL','BGM42AP','BGM42BL','BGM42BP','BGM42TL','BGM42TP',
                'BGM43AL','BGM43AP','BGM43BL','BGM43BP','BGM43TL','BGM43TP',
                'BGM44AL','BGM44AP','BGM44BL','BGM44BP','BGM44TL','BGM44TP',
                'BGM45AL','BGM45AP','BGM45BL','BGM45BP','BGM45TL','BGM45TP',
                'BSK46AL','BSK46AP','BSK46BL','BSK46BP','BSK46TL','BSK46TP',
                'BBK47AL','BBK47AP','BBK47BL','BBK47BP','BBK47TL','BBK47TP',
                'BBN48AL','BBN48AP','BBN48BL','BBN48BP','BBN48TL','BBN48TP',
                'BBL49AL','BBL49AP','BBL49BL','BBL49BP','BBL49TL','BBL49TP'
            ));
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('Form 1-Laporan Bulanan Pelayanan Gizi.pdf', array("Attachment" => false));
        } elseif ($form == "form2") {
            $data = DB::table('kehadirans as P')
                ->leftjoin('anaks as A', 'A.id_anak', '=', 'P.id_anak')
                ->leftjoin('timbangs as T', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('P.tgl_kunjungan', $bulan)->whereYear('P.tgl_kunjungan', $tahun)
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->get();
            $data1 = DB::table('anaks')->count();
            $pdf = PDF::loadView('admin.laporan.form2', compact('data','data1'));
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('Form 2-Data Balita Tidak Hadir.pdf', array("Attachment" => false));
        } elseif ($form == "form3") {
            $data = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'A.id_anak', '=', 'T.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->where('T.status_gizi', '=', 'BB Sangat Kurang')
                ->get();
            // dd($data);
            $data_bln = DB::table('timbangs')
                ->whereMonth('tgl_timbang', $bulan)->whereYear('tgl_timbang', $tahun)
                ->first();
            $pdf = PDF::loadView('admin.laporan.form3', compact(
                'data', 'data_bln'
            ));
            $pdf->setPaper('A4', 'landscape');
            return $pdf->stream('Form 3-Balita Gizi Buruk.pdf');
        } elseif ($form == "form4") {
            $data = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'A.id_anak', '=', 'T.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->where(function ($query) {
                    $query->where('T.ket_timbang', '=', 'Balita 2T & BGM')
                          ->orWhere('T.ket_timbang', '=', 'Balita 2T')
                          ->orWhere('T.ket_timbang', '=', 'Balita BGM');
                })
                ->get();
            // dd($data);
            $data_bln = DB::table('timbangs')
                ->whereMonth('tgl_timbang', $bulan)->whereYear('tgl_timbang', $tahun)
                ->first();
            $pdf = PDF::loadView('admin.laporan.form4', compact(
                'data', 'data_bln'
            ));
            $pdf->setPaper('A4', 'landscape');
            return $pdf->stream('Form 4-Balita 2T dan BGM.pdf');
        } elseif ($form == "form5") {
            $data = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'A.id_anak', '=', 'T.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->whereMonth('T.tgl_timbang', $bulan)->whereYear('T.tgl_timbang', $tahun)
                ->where('T.status_gizi', '=', 'BB Lebih')
                ->get();
            // dd($data);
            $data_bln = DB::table('timbangs')
                ->whereMonth('tgl_timbang', $bulan)->whereYear('tgl_timbang', $tahun)
                ->first();
            $pdf = PDF::loadView('admin.laporan.form5', compact(
                'data', 'data_bln'
            ));
            $pdf->setPaper('A4', 'landscape');
            return $pdf->stream('Form 5-Balita Gizi Lebih.pdf');
        } elseif ($form == "form6") {
            $data0_11L = DB::table('vit_as as V')
                    ->leftjoin('anaks as A', 'A.id_anak', '=', 'V.id_anak')
                    ->leftjoin('timbangs as T', 'A.id_anak', '=', 'T.id_anak')
                    ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                    ->whereMonth('V.tgl_vitA', $bulan)->whereYear('V.tgl_vitA', $tahun)
                    ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 0)
                    ->get();
            $data12_23L = DB::table('vit_as as V')
                    ->leftjoin('anaks as A', 'A.id_anak', '=', 'V.id_anak')
                    ->leftjoin('timbangs as T', 'A.id_anak', '=', 'T.id_anak')
                    ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                    ->whereMonth('V.tgl_vitA', $bulan)->whereYear('V.tgl_vitA', $tahun)
                    ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 0)
                    ->get();
            $data24_35L = DB::table('vit_as as V')
                    ->leftjoin('anaks as A', 'A.id_anak', '=', 'V.id_anak')
                    ->leftjoin('timbangs as T', 'A.id_anak', '=', 'T.id_anak')
                    ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                    ->whereMonth('V.tgl_vitA', $bulan)->whereYear('V.tgl_vitA', $tahun)
                    ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 0)
                    ->get();
            $data36_48L = DB::table('vit_as as V')
                    ->leftjoin('anaks as A', 'A.id_anak', '=', 'V.id_anak')
                    ->leftjoin('timbangs as T', 'A.id_anak', '=', 'T.id_anak')
                    ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                    ->whereMonth('V.tgl_vitA', $bulan)->whereYear('V.tgl_vitA', $tahun)
                    ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 0)
                    ->get();
            $data49_60L = DB::table('vit_as as V')
                    ->leftjoin('anaks as A', 'A.id_anak', '=', 'V.id_anak')
                    ->leftjoin('timbangs as T', 'A.id_anak', '=', 'T.id_anak')
                    ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                    ->whereMonth('V.tgl_vitA', $bulan)->whereYear('V.tgl_vitA', $tahun)
                    ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 0)
                    ->get();
            $data0_11P = DB::table('vit_as as V')
                    ->leftjoin('anaks as A', 'A.id_anak', '=', 'V.id_anak')
                    ->leftjoin('timbangs as T', 'A.id_anak', '=', 'T.id_anak')
                    ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                    ->whereMonth('V.tgl_vitA', $bulan)->whereYear('V.tgl_vitA', $tahun)
                    ->whereBetween('T.umur', [0, 11])->where('A.jenis_kelamin', '=', 1)
                    ->get();
            $data12_23P = DB::table('vit_as as V')
                    ->leftjoin('anaks as A', 'A.id_anak', '=', 'V.id_anak')
                    ->leftjoin('timbangs as T', 'A.id_anak', '=', 'T.id_anak')
                    ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                    ->whereMonth('V.tgl_vitA', $bulan)->whereYear('V.tgl_vitA', $tahun)
                    ->whereBetween('T.umur', [12, 23])->where('A.jenis_kelamin', '=', 1)
                    ->get();
            $data24_35P = DB::table('vit_as as V')
                    ->leftjoin('anaks as A', 'A.id_anak', '=', 'V.id_anak')
                    ->leftjoin('timbangs as T', 'A.id_anak', '=', 'T.id_anak')
                    ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                    ->whereMonth('V.tgl_vitA', $bulan)->whereYear('V.tgl_vitA', $tahun)
                    ->whereBetween('T.umur', [24, 35])->where('A.jenis_kelamin', '=', 1)
                    ->get();
            $data36_48P = DB::table('vit_as as V')
                    ->leftjoin('anaks as A', 'A.id_anak', '=', 'V.id_anak')
                    ->leftjoin('timbangs as T', 'A.id_anak', '=', 'T.id_anak')
                    ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                    ->whereMonth('V.tgl_vitA', $bulan)->whereYear('V.tgl_vitA', $tahun)
                    ->whereBetween('T.umur', [36, 48])->where('A.jenis_kelamin', '=', 1)
                    ->get();
            $data49_60P = DB::table('vit_as as V')
                    ->leftjoin('anaks as A', 'A.id_anak', '=', 'V.id_anak')
                    ->leftjoin('timbangs as T', 'A.id_anak', '=', 'T.id_anak')
                    ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                    ->whereMonth('V.tgl_vitA', $bulan)->whereYear('V.tgl_vitA', $tahun)
                    ->whereBetween('T.umur', [49, 60])->where('A.jenis_kelamin', '=', 1)
                    ->get();
            $data_bln = DB::table('vit_as')
                ->whereMonth('tgl_vitA', $bulan)->whereYear('tgl_vitA', $tahun)
                ->first();
            // dd($data_bln);
            $pdf = PDF::loadView('admin.laporan.form6', compact(
                'data0_11L', 'data12_23L', 'data24_35L', 'data36_48L', 'data49_60L',
                'data0_11P', 'data12_23P', 'data24_35P', 'data36_48P', 'data49_60P',
                 'data_bln'
            ));
            $pdf->setPaper('A4', 'landscape');
            return $pdf->stream('Form 6-Pemberian Vitamin A.pdf');
        } elseif ($form == "form7") {
            $data = DB::table('kegiatans as K')
                ->leftjoin('agendas as A', 'K.id_agenda', '=', 'A.id_agenda')
                ->leftjoin('ukms as U', 'K.id_ukm', '=', 'U.id_ukm')
                ->leftjoin('pkks as P', 'K.id_pkk', '=', 'P.id_pkk')
                ->whereMonth('A.start', $bulan)->whereYear('A.start', $tahun)
                ->where('A.j_kegiatan', '=', 0)
                ->first();
            // dd($data);
            $pdf = PDF::loadView('admin.laporan.form7', compact(
                'data'
            ));
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('Form 7-Dokumentasi Kegiatan.pdf');
        } else {
            'salah';
        }
    }
}
