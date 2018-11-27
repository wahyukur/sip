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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $Y = [];
        $nY = Carbon::now()->format('Y'); // Tanggal sekarang tahun
        $x = 2017;
 
        while($x <= $nY) {
            array_push($Y, $x);
            $x++;
        }
        // dd($Y);
        return view('admin.laporan.create', compact('Y'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = $request->get('form');
        $tahun = $request->get('tahun');
        $bulan = $request->get('bulan');

        ////Bla bla bla bla abla bla bla;
        if ($form = "form1") {
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

        }

        return redirect()->route('jenisimunisasi.index')->with(['success' => 'Data Berhasil Di Tambah']);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function form1(){
        $data = DB::table('ibus as I')
                ->leftjoin('anaks as A', 'I.id_ibu', '=', 'A.id_ibu')
                ->get();
        $pdf = PDF::loadView('admin.laporan.form1', $data);
        $pdf->setPaper('A4', 'portrait');
        // $pdf->save(storage_path().'_filename.pdf');
        return $pdf->stream('Form 1-Laporan Bulanan Pelayanan Gizi.pdf', array("Attachment" => false));
    }
    public function form2(){
        $data = DB::table('ibus as I')
                ->leftjoin('anaks as A', 'I.id_ibu', '=', 'A.id_ibu')
                ->get();
        $pdf = PDF::loadView('admin.laporan.form2', $data);
        $pdf->setPaper('A4', 'portrait');
        // $pdf->save(storage_path().'_filename.pdf');
        return $pdf->stream('Form 2-Data Balita Tidak Hadir.pdf', array("Attachment" => false));
    }
    public function form3(){
        $data = DB::table('ibus as I')
                ->leftjoin('anaks as A', 'I.id_ibu', '=', 'A.id_ibu')
                ->get();
        $pdf = PDF::loadView('admin.laporan.form3', $data);
        $pdf->setPaper('A4', 'landscape');
        // $pdf->save(storage_path().'_filename.pdf');
        return $pdf->stream('Form 3-Balita Gizi Buruk.pdf', array("Attachment" => false));
    }
    public function form4(){
        $data = DB::table('ibus as I')
                ->leftjoin('anaks as A', 'I.id_ibu', '=', 'A.id_ibu')
                ->get();
        $pdf = PDF::loadView('admin.laporan.form4', $data);
        $pdf->setPaper('A4', 'landscape');
        // $pdf->save(storage_path().'_filename.pdf');
        return $pdf->stream('Form 4-Balita 2T dan BGM.pdf', array("Attachment" => false));
    }
    public function form5(){
        $data = DB::table('ibus as I')
                ->leftjoin('anaks as A', 'I.id_ibu', '=', 'A.id_ibu')
                ->get();
        $pdf = PDF::loadView('admin.laporan.form5', $data);
        $pdf->setPaper('A4', 'landscape');
        // $pdf->save(storage_path().'_filename.pdf');
        return $pdf->stream('Form 5-Balita Gizi Lebih.pdf', array("Attachment" => false));
    }
    public function form6(){
        $data = DB::table('vit_as as V')
                ->leftjoin('anaks as A', 'V.id_anak', '=', 'A.id_anak')
                ->leftjoin('ibus as I', 'A.id_ibu', '=', 'I.id_ibu')
                ->select('I.No_KK', 'A.NIK_anak', 'A.nama_anak', 'A.jenis_kelamin', 'A.tgl_lhr', 'I.alamat', 'I.rt', 'I.rw', 'V.tgl_vitA', 'V.keterangan')
                ->get();
        $pdf = PDF::loadView('admin.laporan.form6', $data);
        $pdf->setPaper('A4', 'landscape');
        // $pdf->save(storage_path().'_filename.pdf');
        return $pdf->stream('Form 6-Pemberian Vitamin A.pdf', array("Attachment" => false));
    }
    public function form7(){
        $data = DB::table('ibus as I')
                ->leftjoin('anaks as A', 'I.id_ibu', '=', 'A.id_ibu')
                ->get();
        $pdf = PDF::loadView('admin.laporan.form7', $data);
        $pdf->setPaper('A4', 'portrait');
        // $pdf->save(storage_path().'_filename.pdf');
        return $pdf->stream('Form 7-Dokumentasi Kegiatan.pdf', array("Attachment" => false));
    }
}
