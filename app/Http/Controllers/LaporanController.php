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
        // Fetch all customers from database
        // $data = Customer::get();
        // Send data to the view using loadView function of PDF facade
        // $pdf = PDF::loadView('laporan.form1');
        // // If you want to store the generated pdf to the server then you can use the store function
        // $pdf->save(storage_path().'_filename.pdf');
        // // Finally, you can download the file using download function
        // return $pdf->download('customers.pdf');

        // $pdf = PDF::loadView('admin.laporan.form1');
        // return $pdf->stream();

        $data = DB::table('ibus as I')
                ->leftjoin('anaks as A', 'I.id_ibu', '=', 'A.id_ibu')
                ->get();
        $pdf = PDF::loadView('admin.laporan.form1', $data);
        $pdf->setPaper('A4', 'portrait');
        $pdf->save(storage_path().'_filename.pdf');
        return $pdf->stream('Form 1 - Laporan Bulanan Pelayanan Gizi.pdf', array("Attachment" => false));
    }
    public function form2(){
        //
    }
    public function form3(){
        //
    }
    public function form4(){
        //
    }
    public function form5(){
        //
    }
    public function form6(){
        //
    }
    public function form7(){
        //
    }
}
