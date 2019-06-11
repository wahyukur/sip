<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anak;
use App\Timbang;
use App\VitA;
use App\JenisImunisasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TimbangController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $nm = Carbon::now()->format('m'); // Tanggal sekarang bulan
        $nY = Carbon::now()->format('Y'); // Tanggal sekarang tahun
        $data = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->whereMonth('T.tgl_timbang', $nm)
                ->whereYear('T.tgl_timbang', $nY)
                ->get();
        $data2 = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->get();
        return view('admin.timbang.view', compact('data','data2'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataKelamin = null;
        $grafik = array(60);
        for ($i=0; $i < 60; $i++) { 
            $grafik[$i] = null;
        }
        $dataCreate = DB::table('anaks as A')
                ->leftjoin('users as I', 'I.id', '=', 'A.id_ibu')
                ->orderBy('nama_anak', 'asc')
                ->get();
        return view('admin.timbang.create', compact('dataCreate','dataKelamin'))->with('grafik',json_encode($grafik,JSON_NUMERIC_CHECK));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idA = $request->get('id_anak');
        date_default_timezone_set('Asia/Jakarta');
        $nm = Carbon::now()->format('m'); // Tanggal sekarang bulan
        $nY = Carbon::now()->format('Y'); // Tanggal sekarang tahun
        $check = DB::table('timbangs')
                ->whereMonth('tgl_timbang', $nm)->whereYear('tgl_timbang', $nY)
                ->where('id_anak', $idA)
                ->first();
        if ($check == null) {
            // menerima data request
            $data               = new Timbang;
            $data->id_anak      = $request->get('id_anak');
            $data->berat_badan  = $request->get('berat_badan');
            $data->tinggi_badan = $request->get('tinggi_badan');

            //////////Umur
            $id = $request->get('id_anak');
            $anak = Anak::where('id_anak', $id)->first();
            date_default_timezone_set('Asia/Jakarta');
            $now = Carbon::now()->format('Y-m-d'); // Tanggal sekarang
            $b_day = Carbon::parse($anak->tgl_lhr); // Tanggal Lahir
            $age = $b_day->diffInMonths($now);  // Menghitung umur

            $data->umur = $age;
            $data->tgl_timbang = $now;
            /////////Umur End

            ////////Status Gizi Cek BB/U
            $umur = $age;
            $bb = $data->berat_badan;
            $jk = $anak->jenis_kelamin;
            if ($jk == 1) {
                if ($umur <= 1) {
                    if ($bb < 2.8) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 2.8 && $bb < 3.1) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 3.1 && $bb < 5.5) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 2) {
                    if ($bb < 3.4) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 3.4 && $bb < 3.9) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 3.9 && $bb < 6.6) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 3) {
                    if ($bb < 4.0) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 4.0 && $bb < 4.5) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 4.5 && $bb < 7.5) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 4) {
                    if ($bb < 4.4) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 4.4 && $bb < 5.0) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 5.0 && $bb < 8.2) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 5) {
                    if ($bb < 4.8) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 4.8 && $bb < 5.4) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 5.4 && $bb < 8.8) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 6) {
                    if ($bb < 5.1) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 5.1 && $bb < 5.7) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 5.7 && $bb < 9.3) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 7) {
                    if ($bb < 5.3) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 5.3 && $bb < 6) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 6 && $bb < 9.8) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 8) {
                    if ($bb < 5.6) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 5.6 && $bb < 6.2) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 6.2 && $bb < 10.2) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 9) {
                    if ($bb < 5.8) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 5.8 && $bb < 6.5) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 6.5 && $bb < 10.5) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 10) {
                    if ($bb < 6) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 6 && $bb < 6.7) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 6.7 && $bb < 10.9) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 11) {
                    if ($bb < 6.1) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 6.1 && $bb < 6.9) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 6.9 && $bb < 11.2) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 12) {
                    if ($bb < 6.3) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 6.3 && $bb < 7) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 7 && $bb < 11.5) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 13) {
                    if ($bb < 6.4) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 6.4 && $bb < 7.2) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 7.2 && $bb < 11.8) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 14) {
                    if ($bb < 6.6) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 6.6 && $bb < 7.4) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 7.4 && $bb < 12.1) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 15) {
                    if ($bb < 6.8) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 6.8 && $bb < 7.6) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 7.6 && $bb < 12.4) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 16) {
                    if ($bb < 6.9) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 6.9 && $bb < 7.7) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 7.7 && $bb < 12.6) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 17) {
                    if ($bb < 7) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 7 && $bb < 7.9) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 7.9 && $bb < 12.9) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 18) {
                    if ($bb < 7.2) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 7.2 && $bb < 8.1) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 8.1 && $bb < 13.2) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 19) {
                    if ($bb < 7.3) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 7.3 && $bb < 8.2) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 8.2 && $bb < 13.5) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 20) {
                    if ($bb < 7.5) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 7.5 && $bb < 8.4) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 8.4 && $bb < 13.7) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 21) {
                    if ($bb < 7.6) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 7.6 && $bb < 8.6) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 8.6 && $bb < 14) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 22) {
                    if ($bb < 7.8) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 7.8 && $bb < 8.7) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 8.7 && $bb < 14.3) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 23) {
                    if ($bb < 7.9) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 7.9 && $bb < 8.9) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 8.9 && $bb < 14.6) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 24) {
                    if ($bb < 8.1) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 8.1 && $bb < 9) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 9 && $bb < 14.9) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 25) {
                    if ($bb < 8.2) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 8.2 && $bb < 9.2) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 9.2 && $bb < 15.1) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 26) {
                    if ($bb < 8.3) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 8.3 && $bb < 9.3) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 9.3 && $bb < 15.4) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 27) {
                    if ($bb < 8.5) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 8.5 && $bb < 9.5) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 9.5 && $bb < 15.7) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 28) {
                    if ($bb < 8.6) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 8.6 && $bb < 9.7) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 9.7 && $bb < 16) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 29) {
                    if ($bb < 8.8) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 8.8 && $bb < 9.8) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 9.8 && $bb < 16.2) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 30) {
                    if ($bb < 8.9) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 8.9 && $bb < 10) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 10 && $bb < 16.5) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 31) {
                    if ($bb < 9) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 9 && $bb < 10.1) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 10.1 && $bb < 16.8) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 32) {
                    if ($bb < 9.1) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 9.1 && $bb < 10.3) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 10.3 && $bb < 17) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 33) {
                    if ($bb < 9.2) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 9.2 && $bb < 10.4) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 10.4 && $bb < 17.3) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 34) {
                    if ($bb < 9.4) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 9.4 && $bb < 10.5) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 10.5 && $bb < 17.6) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 35) {
                    if ($bb < 9.5) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 9.5 && $bb < 10.7) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 10.7 && $bb < 17.9) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 36) {
                    if ($bb < 9.6) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 9.6 && $bb < 10.8) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 10.8 && $bb < 18.1) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 37) {
                    if ($bb < 9.7) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 9.7 && $bb < 10.9) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 10.9 && $bb < 18.4) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 38) {
                    if ($bb < 9.8) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 9.8 && $bb < 11.1) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 11.1 && $bb < 18.7) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 39) {
                    if ($bb < 10) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10 && $bb < 11.2) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 11.2 && $bb < 19) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 40) {
                    if ($bb < 10.1) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10.1 && $bb < 11.3) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 11.3 && $bb < 19.2) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 41) {
                    if ($bb < 10.2) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10.2 && $bb < 11.4) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 11.4 && $bb < 19.5) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 42) {
                    if ($bb < 10.3) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10.3 && $bb < 11.6) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 11.6 && $bb < 19.8) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 43) {
                    if ($bb < 10.4) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10.4 && $bb < 11.7) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 11.7 && $bb < 20.1) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 44) {
                    if ($bb < 10.5) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10.5 && $bb < 11.8) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 11.8 && $bb < 20.4) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 45) {
                    if ($bb < 10.6) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10.6 && $bb < 12) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 12 && $bb < 20.7) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 46) {
                    if ($bb < 10.7) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10.7 && $bb < 12.1) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 12.1 && $bb < 20.9) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 47) {
                    if ($bb < 10.8) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10.8 && $bb < 12.4) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 12.4 && $bb < 21.2) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 48) {
                    if ($bb < 10.9) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10.9 && $bb < 12.3) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 12.3 && $bb < 21.5) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 49) {
                    if ($bb < 11) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11 && $bb < 12.4) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 12.4 && $bb < 21.8) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 50) {
                    if ($bb < 11.1) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11.1 && $bb < 12.6) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 12.6 && $bb < 22.1) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 51) {
                    if ($bb < 11.2) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11.2 && $bb < 12.7) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 12.7 && $bb < 22.4) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 52) {
                    if ($bb < 11.3) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11.3 && $bb < 12.8) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 12.8 && $bb < 22.7) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 53) {
                    if ($bb < 11.4) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11.4 && $bb < 12.9) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 12.9 && $bb < 22.5) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 54) {
                    if ($bb < 11.5) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11.5 && $bb < 13) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 13 && $bb < 23.2) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 55) {
                    if ($bb < 11.6) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11.6 && $bb < 13.2) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 13.2 && $bb < 23.5) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 56) {
                    if ($bb < 11.7) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11.7 && $bb < 13.3) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 13.3 && $bb < 23.8) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 57) {
                    if ($bb < 11.8) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11.8 && $bb < 13.4) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 13.4 && $bb < 24.1) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 58) {
                    if ($bb < 11.9) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11.9 && $bb < 13.5) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 13.5 && $bb < 24.4) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 59) {
                    if ($bb < 12) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 12 && $bb < 13.6) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 13.6 && $bb < 24.6) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 60) {
                    if ($bb < 12.1) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 12.1 && $bb < 13.7) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 13.7 && $bb < 24.9) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } else {
                    "Bayi Lulus";
                }
            } else {
                if ($umur <= 1) {
                    if ($bb < 2.9) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 2.9 && $bb < 3.4) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 3.4 && $bb < 5.8) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 2) {
                    if ($bb < 3.8) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 3.8 && $bb < 4.3) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 4.3 && $bb < 7.1) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 3) {
                    if ($bb < 4.4) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 4.4 && $bb < 5) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 5 && $bb < 8) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 4) {
                    if ($bb < 4.9) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 4.9 && $bb < 5.5) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 5.5 && $bb < 8.7) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 5) {
                    if ($bb < 5.3) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 5.3 && $bb < 6) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 6 && $bb < 9.3) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 6) {
                    if ($bb < 5.7) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 5.7 && $bb < 6.3) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 6.3 && $bb < 9.8) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 7) {
                    if ($bb < 5.9) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 5.9 && $bb < 6.7) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 6.7 && $bb < 10.3) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 8) {
                    if ($bb < 6.2) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 6.2 && $bb < 6.9) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 6.9 && $bb < 10.7) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 9) {
                    if ($bb < 6.4) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 6.4 && $bb < 7.1) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 7.1 && $bb < 11) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 10) {
                    if ($bb < 6.6) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 6.6 && $bb < 7.3) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 7.3 && $bb < 11.4) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 11) {
                    if ($bb < 6.8) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 6.8 && $bb < 7.6) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 7.6 && $bb < 11.7) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 12) {
                    if ($bb < 6.9) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 6.9 && $bb < 7.7) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 7.7 && $bb < 12) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 13) {
                    if ($bb < 7.1) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 7.1 && $bb < 7.9) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 7.9 && $bb < 12.3) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 14) {
                    if ($bb < 7.3) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 7.3 && $bb < 8.1) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 8.1 && $bb < 12.6) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 15) {
                    if ($bb < 7.4) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 7.4 && $bb < 8.3) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 8.3 && $bb < 12.8) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 16) {
                    if ($bb < 7.6) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 7.6 && $bb < 8.4) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 8.4 && $bb < 13.1) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 17) {
                    if ($bb < 7.7) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 7.7 && $bb < 8.6) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 8.6 && $bb < 13.4) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 18) {
                    if ($bb < 7.8) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 7.8 && $bb < 8.8) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 8.8 && $bb < 13.6) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 19) {
                    if ($bb < 8) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 8 && $bb < 8.9) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 8.9 && $bb < 13.9) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 20) {
                    if ($bb < 8.1) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 8.1 && $bb < 9.1) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 9.1 && $bb < 14.2) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 21) {
                    if ($bb < 8.2) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 8.2 && $bb < 9.2) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 9.2 && $bb < 14.4) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 22) {
                    if ($bb < 8.4) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 8.4 && $bb < 9.4) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 9.4 && $bb < 14.7) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 23) {
                    if ($bb < 8.5) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 8.5 && $bb < 9.5) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 9.5 && $bb < 15) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 24) {
                    if ($bb < 8.6) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 8.6 && $bb < 9.7) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 9.7 && $bb < 15.2) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 25) {
                    if ($bb < 8.8) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 8.8 && $bb < 9.8) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 9.8 && $bb < 15.6) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 26) {
                    if ($bb < 8.9) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 8.9 && $bb < 10) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 10 && $bb < 15.8) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 27) {
                    if ($bb < 9) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 9 && $bb < 10.1) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 10.1 && $bb < 16.1) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 28) {
                    if ($bb < 9.1) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 9.1 && $bb < 10.2) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 10.2 && $bb < 16.3) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 29) {
                    if ($bb < 9.2) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 9.2 && $bb < 10.4) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 10.4 && $bb < 16.6) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 30) {
                    if ($bb < 9.4) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 9.4 && $bb < 10.5) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 10.5 && $bb < 16.9) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 31) {
                    if ($bb < 9.5) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 9.5 && $bb < 10.6) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 10.6 && $bb < 17.1) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 32) {
                    if ($bb < 9.6) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 9.6 && $bb < 10.8) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 10.8 && $bb < 17.3) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 33) {
                    if ($bb < 9.7) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 9.7 && $bb < 10.9) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 10.9 && $bb < 17.6) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 34) {
                    if ($bb < 9.8) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 9.8 && $bb < 11) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 11 && $bb < 17.8) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 35) {
                    if ($bb < 9.9) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 9.9 && $bb < 11.2) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 11.2 && $bb < 18.1) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 36) {
                    if ($bb < 10) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10 && $bb < 11.3) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 11.3 && $bb < 18.3) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 37) {
                    if ($bb < 10.1) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10.1 && $bb < 11.4) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 11.4 && $bb < 18.5) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 38) {
                    if ($bb < 10.2) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10.2 && $bb < 11.5) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 11.5 && $bb < 18.8) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 39) {
                    if ($bb < 10.3) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10.3 && $bb < 11.7) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 11.7 && $bb < 19) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 40) {
                    if ($bb < 10.4) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10.4 && $bb < 11.8) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 11.8 && $bb < 19.2) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 41) {
                    if ($bb < 10.5) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10.5 && $bb < 11.9) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 11.9 && $bb < 19.5) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 42) {
                    if ($bb < 10.6) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10.6 && $bb < 12) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 12 && $bb < 19.7) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 43) {
                    if ($bb < 10.7) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10.7 && $bb < 12.1) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 12.1 && $bb < 20) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 44) {
                    if ($bb < 10.8) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10.8 && $bb < 12.2) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 12.2 && $bb < 20.2) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 45) {
                    if ($bb < 10.9) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10.9 && $bb < 12.4) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 12.4 && $bb < 20.4) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 46) {
                    if ($bb < 11) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11 && $bb < 12.5) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 12.5 && $bb < 20.7) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 47) {
                    if ($bb < 11.1) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11.1 && $bb < 12.6) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 12.6 && $bb < 21) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 48) {
                    if ($bb < 11.2) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11.2 && $bb < 12.7) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 12.7 && $bb < 21.2) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 49) {
                    if ($bb < 11.3) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11.3 && $bb < 12.8) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 12.8 && $bb < 21.4) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 50) {
                    if ($bb < 11.4) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11.4 && $bb < 12.9) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 12.9 && $bb < 21.7) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 51) {
                    if ($bb < 11.5) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11.5 && $bb < 13) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 13 && $bb < 21.9) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 52) {
                    if ($bb < 11.6) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11.6 && $bb < 13.2) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 13.2 && $bb < 22.2) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 53) {
                    if ($bb < 11.7) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11.7 && $bb < 13.3) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 13.3 && $bb < 22.4) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 54) {
                    if ($bb < 11.8) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11.8 && $bb < 13.4) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 13.4 && $bb < 22.7) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 55) {
                    if ($bb < 11.9) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11.9 && $bb < 13.5) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 13.5 && $bb < 22.9) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 56) {
                    if ($bb < 12) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 12 && $bb < 13.6) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 13.6 && $bb < 23.2) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 57) {
                    if ($bb < 12.1) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 12.1 && $bb < 13.7) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 13.7 && $bb < 23.4) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 58) {
                    if ($bb < 12.2) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 12.2 && $bb < 13.9) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 13.9 && $bb < 23.7) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 59) {
                    if ($bb < 12.3) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 12.3 && $bb < 14) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 14 && $bb < 23.9) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 60) {
                    if ($bb < 12.4) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 12.4 && $bb < 14.1) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 14.1 && $bb < 24.1) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } else {
                    "Bayi Lulus";
                }
            }

            $data->status_gizi = $q;
            if ($q == 'BB Sangat Kurang') {
                $cek_kasus = DB::table('timbangs')
                            ->where('id_anak', $id)
                            ->orderBy('id_timbang', 'desc')
                            ->first();
                if ($cek_kasus->status_gizi == 'BB Sangat Kurang') {
                    $data->kasus = 0; // Lama
                } else {
                    $data->kasus = 1; // Baru
                }
                // dd($cek_kasus);
            }
            ////////Status Gizi End

            ////////Ket Timbang Cek
            $ct_count = Timbang::where('id_anak', $id)->count();
            if ($ct_count > 2) {
                $ct = DB::table('timbangs')
                    ->where('id_anak', $id)
                    ->orderBy('tgl_timbang', 'desc')
                    ->first();
                $ct1 = DB::table('timbangs')
                    ->where('id_anak', $id)
                    ->orderBy('tgl_timbang', 'desc')
                    ->offset(1)
                    ->limit(1)
                    ->first();
                $bb_kemarin = $ct->berat_badan;
                $bb_kemarin_lusa = $ct1->berat_badan;
                // dd($bb_kemarin_lusa , $bb_kemarin);
                if ($bb_kemarin < $bb_kemarin_lusa && $bb < $bb_kemarin && $q == 'BB Sangat Kurang') {
                    $ket_t = "Balita 2T & BGM";
                } elseif ($bb_kemarin < $bb_kemarin_lusa && $bb < $bb_kemarin) {
                    $ket_t = "Balita 2T";
                } elseif ($q == 'BB Sangat Kurang') {
                    $ket_t = "Balita BGM";
                } elseif ($q == 'BB Lebih') {
                    $ket_t = "Balita Gemuk";
                } else {
                    $ket_t = "Balita Normal";
                }
            } else {
                if ($q == 'BB Sangat Kurang') {
                    $ket_t = "Balita BGM";
                } elseif ($q == 'BB Lebih') {
                    $ket_t = "Balita Gemuk";
                } else {
                    $ket_t = "Balita Normal";
                }
            }
            // dd($t_bln_now, $temp_t_bln, $aaa);
            $data->ket_timbang = $ket_t;
            ////////Ket Timbang End

            //////// INDIKASI Naik Cek
            $ct_countt = Timbang::where('id_anak', $id)->count();
            // dd($ct_countt);
            if ($ct_countt >= 1) {
                $ct = DB::table('timbangs')
                    ->where('id_anak', $id)
                    ->orderBy('tgl_timbang', 'desc')
                    ->first();
                $bb_kemarin = $ct->berat_badan;
                if ($bb < $bb_kemarin) {
                    $ind_naik = "tdk naik";
                } else {
                    $ind_naik = "naik";
                }
            } else {
                $ind_naik = "belum";
            }
            // dd($t_bln_now, $temp_t_bln, $aaa);
            $data->ind_naik = $ind_naik;
            ////////Ket Timbang End

            //////// INDIKASI tidak timbang bulan lalu Cek
            $bln_lalu = Carbon::now()->addMonth(-1)->format('m'); // Tanggal sekarang bulan
            if ($ct_countt >= 1) {
                $t_lalu = DB::table('timbangs')
                        ->whereMonth('tgl_timbang', $bln_lalu)
                        ->where('id_anak', $id)
                        ->first();
                if ($t_lalu == null) {
                    $ind_t_lalu = 0; // tidak timbang
                } else {
                    $ind_t_lalu = 1; // timbang
                }
            } else {
                $ind_t_lalu = 1;
            }
            $data->ind_t_lalu = $ind_t_lalu;
            ////////Ket Timbang End

            //////// INDIKASI baru timbang bulan lalu Cek
            $b_lalu_c = DB::table('timbangs as T')
                    ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                    ->where('T.id_anak', $id)
                    ->count();
            if ($b_lalu_c == 1) {
                $b_lalu = DB::table('timbangs')
                        ->where('id_anak', $id)
                        ->first();
                // $bln = Carbon::parse('2018-08-12')->format('m');
                if (Carbon::parse($b_lalu->tgl_timbang)->format('m') == $bln_lalu) {
                    $ind_b_lalu = 0; //baru timbang
                } else {
                    $ind_b_lalu = 1;
                }
            } else {
                $ind_b_lalu = 1;
            }
            // dd($b_lalu);
            $data->ind_b_lalu = $ind_b_lalu;
            ////////Ket Timbang End

            $data->save();

            ////////Vit A Cek
            $vitamin = 'n';
            date_default_timezone_set('Asia/Jakarta');
            // $bln = Carbon::parse('2018-08-12')->format('m');
            $bln = Carbon::now()->format('m');
            if ($bln == '02' or $bln == '08') {
                if ($umur >= 6 && $umur <= 11) { ///Vit A Biru
                    $vitamin = 'y';
                    $q1 = "Anak : ".$anak->nama_anak.", Umur : ".$umur." || Waktu Pemberian Vitamin A Biru";
                    ///input data vit A
                    $vitA = new VitA;
                    $vitA->id_anak = $request->get('id_anak');
                    $vitA->tgl_vitA = $now;
                    $vitA->keterangan = "Vitamin A Biru";
                    $vitA->save();
                } elseif ($umur >= 12 && $umur <= 60) { ///Vit A Merah
                    $vitamin = 'y';
                    $q1 = "Anak : ".$anak->nama_anak.", Umur : ".$umur." || Waktu Pemberian Vitamin A Merah";
                    ///input data vit A
                    $vitA = new VitA;
                    $vitA->id_anak = $request->get('id_anak');
                    $vitA->tgl_vitA = $now;
                    $vitA->keterangan = "Vitamin A Merah";
                    $vitA->save();
                } else {
                    "Bayi Lulus";
                }
            }
            ////////Vit A End

            /////////Imunisasi Cek
            $var_array=[];
            $imunisasi = 'n';
            $imuns = JenisImunisasi::all();
            foreach ($imuns as $imun) {
                if ($imun->umur == $umur) {
                    array_push($var_array, $imun->nama_imun);
                    $imunisasi = 'y';
                }
            }
            // dd($var_array);
            /////////Imunisasi End

            /////////Get Data Timbang Anak
            // $dataKelamin = Anak::where('id_anak', $id)->first();
            $dK = DB::table('anaks')
                        ->where('id_anak', $id)
                        ->first();
            $dataKelamin = $dK->jenis_kelamin;

            // dd($dataKelamin);

            $dataCreate = DB::table('anaks as A')
                    ->leftjoin('users as I', 'I.id', '=', 'A.id_ibu')
                    ->orderBy('nama_anak', 'asc')
                    ->get();

            $t = DB::table('anaks as A')
                    ->leftjoin('timbangs as T', 'A.id_anak', '=', 'T.id_anak')
                    ->select('A.id_anak', 'A.nama_anak', 'T.umur', 'T.berat_badan', 'T.tinggi_badan', 'T.tgl_timbang')
                    ->where('A.id_anak', $id)
                    ->get();
            $grafik = array(61);
            for ($i=0; $i < 61; $i++) { 
                $grafik[$i] = null;
            }
            $grafik[0] = $dK->bb_lahir;
            foreach ($t as $some) {
                $grafik[$some->umur] = $some->berat_badan;
            }
            // dd($grafik);
            /////////

            if ($data->save() == true && $vitamin == 'y') {
                if ($imunisasi == 'y') {
                    return redirect()->route('timbang.create')
                        ->with([
                            'success&vitA' => $q1,
                            'info_imun' => $var_array,
                            'dataKelamin' => $dataKelamin,
                            'grafik' => json_encode($grafik,JSON_NUMERIC_CHECK)
                        ]);
                } else {
                    return redirect()->route('timbang.create')
                        ->with([
                            'success&vitA' => $q1,
                            'dataKelamin' => $dataKelamin,
                            'grafik' => json_encode($grafik,JSON_NUMERIC_CHECK)
                        ]);
                }
            } elseif ($data->save() == true && $vitamin == 'n') {
                if ($imunisasi == 'y') {
                    return redirect()->route('timbang.create')
                        ->with([
                            'success' => 'Data Berhasil Di Tambah',
                            'info_imun' => $var_array,
                            'dataKelamin' => $dataKelamin,
                            'grafik' => json_encode($grafik,JSON_NUMERIC_CHECK)
                        ]);
                } else {
                    return redirect()->route('timbang.create')
                        ->with([
                            'success' => 'Data Berhasil Di Tambah',
                            'dataKelamin' => $dataKelamin,
                            'grafik' => json_encode($grafik,JSON_NUMERIC_CHECK)
                        ]);
                }
            } else {
                return redirect()->route('timbang.create')->with(['error' => 'Data Gagal Di Tambah']);
            }

        } else {
            return redirect()->route('timbang.create')->with(['error' => 'Balita Sudah Melakukan Timbang']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table('timbangs as T')
                ->leftjoin('anaks as A', 'T.id_anak', '=', 'A.id_anak')
                ->where('T.id_timbang', $id)->get();
        $data2 = DB::table('anaks as A')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->orderBy('nama_anak', 'asc')
                ->get();
        return view('admin.timbang.edit', compact('data', 'data2'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Timbang::where('id_timbang', $id)->first();
        $data->id_anak      = $request->get('id_anak');
        $data->berat_badan  = $request->get('berat_badan');
        $data->tinggi_badan = $request->get('tinggi_badan');
        $data->tgl_timbang  = $request->get('tgl_timbang');

        //////////Umur
        $id_a = $request->get('id_anak');
        $anak = Anak::where('id_anak', $id_a)->first();
        date_default_timezone_set('Asia/Jakarta');
        $now = Carbon::now()->format('Y-m-d'); // Tanggal sekarang
        $b_day = Carbon::parse($anak->tgl_lhr); // Tanggal Lahir
        $age = $b_day->diffInMonths($now);  // Menghitung umur

        $data->umur = $age;
        /////////Umur End

        ////////Status Gizi Cek BB/U
        $umur = $age;
        $bb = $data->berat_badan;
        $jk = $anak->jenis_kelamin;
        if ($jk == 1) {
            if ($umur <= 1) {
                if ($bb < 2.8) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 2.8 && $bb < 3.1) {
                    $q = "BB Kurang";
                } elseif ($bb >= 3.1 && $bb < 5.5) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 2) {
                if ($bb < 3.4) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 3.4 && $bb < 3.9) {
                    $q = "BB Kurang";
                } elseif ($bb >= 3.9 && $bb < 6.6) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 3) {
                if ($bb < 4.0) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 4.0 && $bb < 4.5) {
                    $q = "BB Kurang";
                } elseif ($bb >= 4.5 && $bb < 7.5) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 4) {
                if ($bb < 4.4) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 4.4 && $bb < 5.0) {
                    $q = "BB Kurang";
                } elseif ($bb >= 5.0 && $bb < 8.2) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 5) {
                if ($bb < 4.8) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 4.8 && $bb < 5.4) {
                    $q = "BB Kurang";
                } elseif ($bb >= 5.4 && $bb < 8.8) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 6) {
                if ($bb < 5.1) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 5.1 && $bb < 5.7) {
                    $q = "BB Kurang";
                } elseif ($bb >= 5.7 && $bb < 9.3) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 7) {
                if ($bb < 5.3) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 5.3 && $bb < 6) {
                    $q = "BB Kurang";
                } elseif ($bb >= 6 && $bb < 9.8) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 8) {
                if ($bb < 5.6) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 5.6 && $bb < 6.2) {
                    $q = "BB Kurang";
                } elseif ($bb >= 6.2 && $bb < 10.2) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 9) {
                if ($bb < 5.8) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 5.8 && $bb < 6.5) {
                    $q = "BB Kurang";
                } elseif ($bb >= 6.5 && $bb < 10.5) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 10) {
                if ($bb < 6) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 6 && $bb < 6.7) {
                    $q = "BB Kurang";
                } elseif ($bb >= 6.7 && $bb < 10.9) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 11) {
                if ($bb < 6.1) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 6.1 && $bb < 6.9) {
                    $q = "BB Kurang";
                } elseif ($bb >= 6.9 && $bb < 11.2) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 12) {
                if ($bb < 6.3) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 6.3 && $bb < 7) {
                    $q = "BB Kurang";
                } elseif ($bb >= 7 && $bb < 11.5) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 13) {
                if ($bb < 6.4) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 6.4 && $bb < 7.2) {
                    $q = "BB Kurang";
                } elseif ($bb >= 7.2 && $bb < 11.8) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 14) {
                if ($bb < 6.6) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 6.6 && $bb < 7.4) {
                    $q = "BB Kurang";
                } elseif ($bb >= 7.4 && $bb < 12.1) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 15) {
                if ($bb < 6.8) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 6.8 && $bb < 7.6) {
                    $q = "BB Kurang";
                } elseif ($bb >= 7.6 && $bb < 12.4) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 16) {
                if ($bb < 6.9) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 6.9 && $bb < 7.7) {
                    $q = "BB Kurang";
                } elseif ($bb >= 7.7 && $bb < 12.6) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 17) {
                if ($bb < 7) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 7 && $bb < 7.9) {
                    $q = "BB Kurang";
                } elseif ($bb >= 7.9 && $bb < 12.9) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 18) {
                if ($bb < 7.2) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 7.2 && $bb < 8.1) {
                    $q = "BB Kurang";
                } elseif ($bb >= 8.1 && $bb < 13.2) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 19) {
                if ($bb < 7.3) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 7.3 && $bb < 8.2) {
                    $q = "BB Kurang";
                } elseif ($bb >= 8.2 && $bb < 13.5) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 20) {
                if ($bb < 7.5) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 7.5 && $bb < 8.4) {
                    $q = "BB Kurang";
                } elseif ($bb >= 8.4 && $bb < 13.7) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 21) {
                if ($bb < 7.6) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 7.6 && $bb < 8.6) {
                    $q = "BB Kurang";
                } elseif ($bb >= 8.6 && $bb < 14) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 22) {
                if ($bb < 7.8) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 7.8 && $bb < 8.7) {
                    $q = "BB Kurang";
                } elseif ($bb >= 8.7 && $bb < 14.3) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 23) {
                if ($bb < 7.9) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 7.9 && $bb < 8.9) {
                    $q = "BB Kurang";
                } elseif ($bb >= 8.9 && $bb < 14.6) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 24) {
                if ($bb < 8.1) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 8.1 && $bb < 9) {
                    $q = "BB Kurang";
                } elseif ($bb >= 9 && $bb < 14.9) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 25) {
                if ($bb < 8.2) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 8.2 && $bb < 9.2) {
                    $q = "BB Kurang";
                } elseif ($bb >= 9.2 && $bb < 15.1) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 26) {
                if ($bb < 8.3) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 8.3 && $bb < 9.3) {
                    $q = "BB Kurang";
                } elseif ($bb >= 9.3 && $bb < 15.4) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 27) {
                if ($bb < 8.5) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 8.5 && $bb < 9.5) {
                    $q = "BB Kurang";
                } elseif ($bb >= 9.5 && $bb < 15.7) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 28) {
                if ($bb < 8.6) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 8.6 && $bb < 9.7) {
                    $q = "BB Kurang";
                } elseif ($bb >= 9.7 && $bb < 16) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 29) {
                if ($bb < 8.8) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 8.8 && $bb < 9.8) {
                    $q = "BB Kurang";
                } elseif ($bb >= 9.8 && $bb < 16.2) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 30) {
                if ($bb < 8.9) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 8.9 && $bb < 10) {
                    $q = "BB Kurang";
                } elseif ($bb >= 10 && $bb < 16.5) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 31) {
                if ($bb < 9) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 9 && $bb < 10.1) {
                    $q = "BB Kurang";
                } elseif ($bb >= 10.1 && $bb < 16.8) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 32) {
                if ($bb < 9.1) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 9.1 && $bb < 10.3) {
                    $q = "BB Kurang";
                } elseif ($bb >= 10.3 && $bb < 17) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 33) {
                if ($bb < 9.2) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 9.2 && $bb < 10.4) {
                    $q = "BB Kurang";
                } elseif ($bb >= 10.4 && $bb < 17.3) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 34) {
                if ($bb < 9.4) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 9.4 && $bb < 10.5) {
                    $q = "BB Kurang";
                } elseif ($bb >= 10.5 && $bb < 17.6) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 35) {
                if ($bb < 9.5) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 9.5 && $bb < 10.7) {
                    $q = "BB Kurang";
                } elseif ($bb >= 10.7 && $bb < 17.9) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 36) {
                if ($bb < 9.6) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 9.6 && $bb < 10.8) {
                    $q = "BB Kurang";
                } elseif ($bb >= 10.8 && $bb < 18.1) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 37) {
                if ($bb < 9.7) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 9.7 && $bb < 10.9) {
                    $q = "BB Kurang";
                } elseif ($bb >= 10.9 && $bb < 18.4) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 38) {
                if ($bb < 9.8) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 9.8 && $bb < 11.1) {
                    $q = "BB Kurang";
                } elseif ($bb >= 11.1 && $bb < 18.7) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 39) {
                if ($bb < 10) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 10 && $bb < 11.2) {
                    $q = "BB Kurang";
                } elseif ($bb >= 11.2 && $bb < 19) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 40) {
                if ($bb < 10.1) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 10.1 && $bb < 11.3) {
                    $q = "BB Kurang";
                } elseif ($bb >= 11.3 && $bb < 19.2) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 41) {
                if ($bb < 10.2) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 10.2 && $bb < 11.4) {
                    $q = "BB Kurang";
                } elseif ($bb >= 11.4 && $bb < 19.5) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 42) {
                if ($bb < 10.3) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 10.3 && $bb < 11.6) {
                    $q = "BB Kurang";
                } elseif ($bb >= 11.6 && $bb < 19.8) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 43) {
                if ($bb < 10.4) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 10.4 && $bb < 11.7) {
                    $q = "BB Kurang";
                } elseif ($bb >= 11.7 && $bb < 20.1) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 44) {
                if ($bb < 10.5) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 10.5 && $bb < 11.8) {
                    $q = "BB Kurang";
                } elseif ($bb >= 11.8 && $bb < 20.4) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 45) {
                if ($bb < 10.6) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 10.6 && $bb < 12) {
                    $q = "BB Kurang";
                } elseif ($bb >= 12 && $bb < 20.7) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 46) {
                if ($bb < 10.7) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 10.7 && $bb < 12.1) {
                    $q = "BB Kurang";
                } elseif ($bb >= 12.1 && $bb < 20.9) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 47) {
                if ($bb < 10.8) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 10.8 && $bb < 12.4) {
                    $q = "BB Kurang";
                } elseif ($bb >= 12.4 && $bb < 21.2) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 48) {
                if ($bb < 10.9) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 10.9 && $bb < 12.3) {
                    $q = "BB Kurang";
                } elseif ($bb >= 12.3 && $bb < 21.5) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 49) {
                if ($bb < 11) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 11 && $bb < 12.4) {
                    $q = "BB Kurang";
                } elseif ($bb >= 12.4 && $bb < 21.8) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 50) {
                if ($bb < 11.1) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 11.1 && $bb < 12.6) {
                    $q = "BB Kurang";
                } elseif ($bb >= 12.6 && $bb < 22.1) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 51) {
                if ($bb < 11.2) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 11.2 && $bb < 12.7) {
                    $q = "BB Kurang";
                } elseif ($bb >= 12.7 && $bb < 22.4) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 52) {
                if ($bb < 11.3) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 11.3 && $bb < 12.8) {
                    $q = "BB Kurang";
                } elseif ($bb >= 12.8 && $bb < 22.7) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 53) {
                if ($bb < 11.4) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 11.4 && $bb < 12.9) {
                    $q = "BB Kurang";
                } elseif ($bb >= 12.9 && $bb < 22.5) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 54) {
                if ($bb < 11.5) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 11.5 && $bb < 13) {
                    $q = "BB Kurang";
                } elseif ($bb >= 13 && $bb < 23.2) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 55) {
                if ($bb < 11.6) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 11.6 && $bb < 13.2) {
                    $q = "BB Kurang";
                } elseif ($bb >= 13.2 && $bb < 23.5) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 56) {
                if ($bb < 11.7) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 11.7 && $bb < 13.3) {
                    $q = "BB Kurang";
                } elseif ($bb >= 13.3 && $bb < 23.8) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 57) {
                if ($bb < 11.8) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 11.8 && $bb < 13.4) {
                    $q = "BB Kurang";
                } elseif ($bb >= 13.4 && $bb < 24.1) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 58) {
                if ($bb < 11.9) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 11.9 && $bb < 13.5) {
                    $q = "BB Kurang";
                } elseif ($bb >= 13.5 && $bb < 24.4) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 59) {
                if ($bb < 12) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 12 && $bb < 13.6) {
                    $q = "BB Kurang";
                } elseif ($bb >= 13.6 && $bb < 24.6) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 60) {
                if ($bb < 12.1) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 12.1 && $bb < 13.7) {
                    $q = "BB Kurang";
                } elseif ($bb >= 13.7 && $bb < 24.9) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } else {
                "Bayi Lulus";
            }
        } else {
            if ($umur <= 1) {
                if ($bb < 2.9) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 2.9 && $bb < 3.4) {
                    $q = "BB Kurang";
                } elseif ($bb >= 3.4 && $bb < 5.8) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 2) {
                if ($bb < 3.8) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 3.8 && $bb < 4.3) {
                    $q = "BB Kurang";
                } elseif ($bb >= 4.3 && $bb < 7.1) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 3) {
                if ($bb < 4.4) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 4.4 && $bb < 5) {
                    $q = "BB Kurang";
                } elseif ($bb >= 5 && $bb < 8) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 4) {
                if ($bb < 4.9) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 4.9 && $bb < 5.5) {
                    $q = "BB Kurang";
                } elseif ($bb >= 5.5 && $bb < 8.7) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 5) {
                if ($bb < 5.3) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 5.3 && $bb < 6) {
                    $q = "BB Kurang";
                } elseif ($bb >= 6 && $bb < 9.3) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 6) {
                if ($bb < 5.7) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 5.7 && $bb < 6.3) {
                    $q = "BB Kurang";
                } elseif ($bb >= 6.3 && $bb < 9.8) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 7) {
                if ($bb < 5.9) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 5.9 && $bb < 6.7) {
                    $q = "BB Kurang";
                } elseif ($bb >= 6.7 && $bb < 10.3) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 8) {
                if ($bb < 6.2) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 6.2 && $bb < 6.9) {
                    $q = "BB Kurang";
                } elseif ($bb >= 6.9 && $bb < 10.7) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 9) {
                if ($bb < 6.4) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 6.4 && $bb < 7.1) {
                    $q = "BB Kurang";
                } elseif ($bb >= 7.1 && $bb < 11) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 10) {
                if ($bb < 6.6) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 6.6 && $bb < 7.3) {
                    $q = "BB Kurang";
                } elseif ($bb >= 7.3 && $bb < 11.4) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 11) {
                if ($bb < 6.8) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 6.8 && $bb < 7.6) {
                    $q = "BB Kurang";
                } elseif ($bb >= 7.6 && $bb < 11.7) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 12) {
                if ($bb < 6.9) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 6.9 && $bb < 7.7) {
                    $q = "BB Kurang";
                } elseif ($bb >= 7.7 && $bb < 12) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 13) {
                if ($bb < 7.1) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 7.1 && $bb < 7.9) {
                    $q = "BB Kurang";
                } elseif ($bb >= 7.9 && $bb < 12.3) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 14) {
                if ($bb < 7.3) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 7.3 && $bb < 8.1) {
                    $q = "BB Kurang";
                } elseif ($bb >= 8.1 && $bb < 12.6) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 15) {
                if ($bb < 7.4) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 7.4 && $bb < 8.3) {
                    $q = "BB Kurang";
                } elseif ($bb >= 8.3 && $bb < 12.8) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 16) {
                if ($bb < 7.6) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 7.6 && $bb < 8.4) {
                    $q = "BB Kurang";
                } elseif ($bb >= 8.4 && $bb < 13.1) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 17) {
                if ($bb < 7.7) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 7.7 && $bb < 8.6) {
                    $q = "BB Kurang";
                } elseif ($bb >= 8.6 && $bb < 13.4) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 18) {
                if ($bb < 7.8) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 7.8 && $bb < 8.8) {
                    $q = "BB Kurang";
                } elseif ($bb >= 8.8 && $bb < 13.6) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 19) {
                if ($bb < 8) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 8 && $bb < 8.9) {
                    $q = "BB Kurang";
                } elseif ($bb >= 8.9 && $bb < 13.9) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 20) {
                if ($bb < 8.1) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 8.1 && $bb < 9.1) {
                    $q = "BB Kurang";
                } elseif ($bb >= 9.1 && $bb < 14.2) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 21) {
                if ($bb < 8.2) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 8.2 && $bb < 9.2) {
                    $q = "BB Kurang";
                } elseif ($bb >= 9.2 && $bb < 14.4) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 22) {
                if ($bb < 8.4) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 8.4 && $bb < 9.4) {
                    $q = "BB Kurang";
                } elseif ($bb >= 9.4 && $bb < 14.7) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 23) {
                if ($bb < 8.5) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 8.5 && $bb < 9.5) {
                    $q = "BB Kurang";
                } elseif ($bb >= 9.5 && $bb < 15) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 24) {
                if ($bb < 8.6) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 8.6 && $bb < 9.7) {
                    $q = "BB Kurang";
                } elseif ($bb >= 9.7 && $bb < 15.2) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 25) {
                if ($bb < 8.8) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 8.8 && $bb < 9.8) {
                    $q = "BB Kurang";
                } elseif ($bb >= 9.8 && $bb < 15.6) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 26) {
                if ($bb < 8.9) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 8.9 && $bb < 10) {
                    $q = "BB Kurang";
                } elseif ($bb >= 10 && $bb < 15.8) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 27) {
                if ($bb < 9) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 9 && $bb < 10.1) {
                    $q = "BB Kurang";
                } elseif ($bb >= 10.1 && $bb < 16.1) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 28) {
                if ($bb < 9.1) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 9.1 && $bb < 10.2) {
                    $q = "BB Kurang";
                } elseif ($bb >= 10.2 && $bb < 16.3) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 29) {
                if ($bb < 9.2) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 9.2 && $bb < 10.4) {
                    $q = "BB Kurang";
                } elseif ($bb >= 10.4 && $bb < 16.6) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 30) {
                if ($bb < 9.4) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 9.4 && $bb < 10.5) {
                    $q = "BB Kurang";
                } elseif ($bb >= 10.5 && $bb < 16.9) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 31) {
                if ($bb < 9.5) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 9.5 && $bb < 10.6) {
                    $q = "BB Kurang";
                } elseif ($bb >= 10.6 && $bb < 17.1) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 32) {
                if ($bb < 9.6) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 9.6 && $bb < 10.8) {
                    $q = "BB Kurang";
                } elseif ($bb >= 10.8 && $bb < 17.3) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 33) {
                if ($bb < 9.7) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 9.7 && $bb < 10.9) {
                    $q = "BB Kurang";
                } elseif ($bb >= 10.9 && $bb < 17.6) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 34) {
                if ($bb < 9.8) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 9.8 && $bb < 11) {
                    $q = "BB Kurang";
                } elseif ($bb >= 11 && $bb < 17.8) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 35) {
                if ($bb < 9.9) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 9.9 && $bb < 11.2) {
                    $q = "BB Kurang";
                } elseif ($bb >= 11.2 && $bb < 18.1) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 36) {
                if ($bb < 10) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 10 && $bb < 11.3) {
                    $q = "BB Kurang";
                } elseif ($bb >= 11.3 && $bb < 18.3) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 37) {
                if ($bb < 10.1) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 10.1 && $bb < 11.4) {
                    $q = "BB Kurang";
                } elseif ($bb >= 11.4 && $bb < 18.5) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 38) {
                if ($bb < 10.2) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 10.2 && $bb < 11.5) {
                    $q = "BB Kurang";
                } elseif ($bb >= 11.5 && $bb < 18.8) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 39) {
                if ($bb < 10.3) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 10.3 && $bb < 11.7) {
                    $q = "BB Kurang";
                } elseif ($bb >= 11.7 && $bb < 19) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 40) {
                if ($bb < 10.4) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 10.4 && $bb < 11.8) {
                    $q = "BB Kurang";
                } elseif ($bb >= 11.8 && $bb < 19.2) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 41) {
                if ($bb < 10.5) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 10.5 && $bb < 11.9) {
                    $q = "BB Kurang";
                } elseif ($bb >= 11.9 && $bb < 19.5) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 42) {
                if ($bb < 10.6) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 10.6 && $bb < 12) {
                    $q = "BB Kurang";
                } elseif ($bb >= 12 && $bb < 19.7) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 43) {
                if ($bb < 10.7) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 10.7 && $bb < 12.1) {
                    $q = "BB Kurang";
                } elseif ($bb >= 12.1 && $bb < 20) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 44) {
                if ($bb < 10.8) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 10.8 && $bb < 12.2) {
                    $q = "BB Kurang";
                } elseif ($bb >= 12.2 && $bb < 20.2) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 45) {
                if ($bb < 10.9) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 10.9 && $bb < 12.4) {
                    $q = "BB Kurang";
                } elseif ($bb >= 12.4 && $bb < 20.4) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 46) {
                if ($bb < 11) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 11 && $bb < 12.5) {
                    $q = "BB Kurang";
                } elseif ($bb >= 12.5 && $bb < 20.7) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 47) {
                if ($bb < 11.1) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 11.1 && $bb < 12.6) {
                    $q = "BB Kurang";
                } elseif ($bb >= 12.6 && $bb < 21) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 48) {
                if ($bb < 11.2) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 11.2 && $bb < 12.7) {
                    $q = "BB Kurang";
                } elseif ($bb >= 12.7 && $bb < 21.2) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 49) {
                if ($bb < 11.3) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 11.3 && $bb < 12.8) {
                    $q = "BB Kurang";
                } elseif ($bb >= 12.8 && $bb < 21.4) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 50) {
                if ($bb < 11.4) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 11.4 && $bb < 12.9) {
                    $q = "BB Kurang";
                } elseif ($bb >= 12.9 && $bb < 21.7) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 51) {
                if ($bb < 11.5) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 11.5 && $bb < 13) {
                    $q = "BB Kurang";
                } elseif ($bb >= 13 && $bb < 21.9) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 52) {
                if ($bb < 11.6) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 11.6 && $bb < 13.2) {
                    $q = "BB Kurang";
                } elseif ($bb >= 13.2 && $bb < 22.2) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 53) {
                if ($bb < 11.7) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 11.7 && $bb < 13.3) {
                    $q = "BB Kurang";
                } elseif ($bb >= 13.3 && $bb < 22.4) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 54) {
                if ($bb < 11.8) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 11.8 && $bb < 13.4) {
                    $q = "BB Kurang";
                } elseif ($bb >= 13.4 && $bb < 22.7) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 55) {
                if ($bb < 11.9) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 11.9 && $bb < 13.5) {
                    $q = "BB Kurang";
                } elseif ($bb >= 13.5 && $bb < 22.9) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 56) {
                if ($bb < 12) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 12 && $bb < 13.6) {
                    $q = "BB Kurang";
                } elseif ($bb >= 13.6 && $bb < 23.2) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 57) {
                if ($bb < 12.1) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 12.1 && $bb < 13.7) {
                    $q = "BB Kurang";
                } elseif ($bb >= 13.7 && $bb < 23.4) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 58) {
                if ($bb < 12.2) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 12.2 && $bb < 13.9) {
                    $q = "BB Kurang";
                } elseif ($bb >= 13.9 && $bb < 23.7) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 59) {
                if ($bb < 12.3) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 12.3 && $bb < 14) {
                    $q = "BB Kurang";
                } elseif ($bb >= 14 && $bb < 23.9) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } elseif ($umur == 60) {
                if ($bb < 12.4) {
                    $q = "BB Sangat Kurang";
                } elseif ($bb >= 12.4 && $bb < 14.1) {
                    $q = "BB Kurang";
                } elseif ($bb >= 14.1 && $bb < 24.1) {
                    $q = "BB Normal";
                } else {
                    $q = "BB Lebih";
                }
            } else {
                "Bayi Lulus";
            }
        }
        $data->status_gizi = $q;
        ////////Status Gizi End

        ////////Ket Timbang Cek
        $ct_count = Timbang::where('id_anak', $id)->count();
        if ($ct_count > 2) {
            $ct = DB::table('timbangs')
                ->where('id_anak', $id_a)
                ->orderBy('tgl_timbang', 'desc')
                ->offset(1)
                ->limit(1)
                ->first();
            $ct1 = DB::table('timbangs')
                ->where('id_anak', $id_a)
                ->orderBy('tgl_timbang', 'desc')
                ->offset(2)
                ->limit(1)
                ->first();
            $bb_kemarin = $ct->berat_badan;
            $bb_kemarin_lusa = $ct1->berat_badan;
            // dd($bb_kemarin_lusa , $bb_kemarin, $bb);
            if ($bb_kemarin < $bb_kemarin_lusa && $bb < $bb_kemarin && $q == 'BB Sangat Kurang') {
                $ket_t = "Balita 2T & BGM";
            } elseif ($bb_kemarin < $bb_kemarin_lusa && $bb < $bb_kemarin) {
                $ket_t = "Balita 2T";
            } elseif ($q == 'BB Sangat Kurang') {
                $ket_t = "Balita BGM";
            } elseif ($q == 'BB Lebih') {
                $ket_t = "Balita Gemuk";
            } else {
                $ket_t = "Balita Normal";
            }
        } else {
            if ($q == 'BB Sangat Kurang') {
                $ket_t = "Balita BGM";
            } elseif ($q == 'BB Lebih') {
                $ket_t = "Balita Gemuk";
            } else {
                $ket_t = "Balita Normal";
            }
        }
        // dd($t_bln_now, $temp_t_bln, $aaa);
        $data->ket_timbang = $ket_t;
        ////////Ket Timbang End
        $data->save();

        return redirect()->route('timbang.index')->with(['success' => 'Data Berhasil Di Update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Timbang::where('id_timbang', $id)->first();
        $data->delete();
        return redirect()->route('timbang.index')->with(['success' => 'Data Berhasil Di Hapus']);
    }
}
