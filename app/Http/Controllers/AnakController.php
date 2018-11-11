<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anak;
use App\Ibu;
use App\Imunisasi;
use App\VitA;
use App\Timbang;
use Illuminate\Support\Facades\DB;
use PDF;

class AnakController extends Controller
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
        $data = DB::table('ibus as I')
                ->leftjoin('anaks as A', 'I.id_ibu', '=', 'A.id_ibu')
                ->get();
        return view('admin.anak.view', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = Ibu::select('id_ibu', 'nama_ibu', 'nama_suami')->get();
        return view('admin.anak.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // menerima data request
        $data                    = new Anak;
        $data->nama_anak         = $request->get('nama_anak');
        $data->id_ibu            = $request->get('id_ibu');
        $data->tempat_lhr        = $request->get('tempat_lhr');
        $data->tgl_lhr           = $request->get('tgl_lhr');
        $data->bb_lahir          = $request->get('bb_lahir');
        $data->tb_lahir          = $request->get('tb_lahir');
        $data->jenis_kelamin     = $request->get('jenis_kelamin');
        $data->anak_ke           = $request->get('anak_ke');
        $data->jenis_persalinan  = $request->get('jenis_persalinan');
        $data->tempat_persalinan = $request->get('tempat_persalinan');
        $data->dokter            = $request->get('dokter');
        $data->NIK_anak          = $request->get('NIK_anak');
        $data->save();

        return redirect()->route('anak.index')->with(['success' => 'Data Berhasil Di Tambah']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DB::table('anaks as A')
                ->leftjoin('ibus as I', 'A.id_ibu', '=', 'I.id_ibu')
                ->where('A.id_anak', $id)->first();
        $data1 = DB::table('anaks as A')
                ->leftjoin('imunisasis as M', 'A.id_anak', '=', 'M.id_anak')
                ->leftjoin('jenis_imunisasis as J', 'M.id_j_imun', '=', 'J.id_j_imun')
                ->where('A.id_anak', $id)->get();
        $data2 = VitA::where('id_anak', $id)->get();
        $t1_24 = DB::table('anaks as A')
                ->leftjoin('timbangs as T', 'A.id_anak', '=', 'T.id_anak')
                ->select('A.id_anak', 'A.nama_anak', 'T.umur', 'T.berat_badan', 'T.tinggi_badan', 'T.tgl_timbang')
                ->where('A.id_anak', $id)
                ->whereBetween('umur', [1, 24])
                ->get();
        $grafik = array(24);
        for ($i=0; $i < 24; $i++) { 
            $grafik[$i] = null;
        }
        foreach ($t1_24 as $some) {
            $grafik[$some->umur-1] = $some->berat_badan;
        }
        // dd($grafik);
        $t25_60 = DB::table('anaks as A')
                ->leftjoin('timbangs as T', 'A.id_anak', '=', 'T.id_anak')
                ->select('A.id_anak', 'A.nama_anak', 'T.umur', 'T.berat_badan', 'T.tinggi_badan', 'T.tgl_timbang')
                ->where('A.id_anak', $id)
                ->whereBetween('umur', [25, 60])
                ->get();
        $grafik1 = array(36);
        for ($i=0; $i < 36; $i++) { 
            $grafik1[$i] = null;
        }
        foreach ($t25_60 as $some1) {
            $grafik1[$some1->umur-1] = $some1->berat_badan;
        }
        return view('admin.anak.detail', compact('data', 'data1', 'data2'))
            ->with('grafik',json_encode($grafik,JSON_NUMERIC_CHECK))
            ->with('grafik1',json_encode($grafik1,JSON_NUMERIC_CHECK));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table('ibus as I')
                ->leftjoin('anaks as A', 'I.id_ibu', '=', 'A.id_ibu')
                ->where('A.id_anak', $id)->get();
        $data2 = Ibu::select('id_ibu', 'nama_ibu', 'nama_suami')->get();
        return view('admin.anak.edit', compact('data', 'data2'));
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
        // menerima data request
        $data = Anak::where('id_anak', $id)->first();
        $data->nama_anak         = $request->get('nama_anak');
        $data->id_ibu            = $request->get('id_ibu');
        $data->tempat_lhr        = $request->get('tempat_lhr');
        $data->tgl_lhr           = $request->get('tgl_lhr');
        $data->bb_lahir          = $request->get('bb_lahir');
        $data->tb_lahir          = $request->get('tb_lahir');
        $data->jenis_kelamin     = $request->get('jenis_kelamin');
        $data->anak_ke           = $request->get('anak_ke');
        $data->jenis_persalinan  = $request->get('jenis_persalinan');
        $data->tempat_persalinan = $request->get('tempat_persalinan');
        $data->dokter            = $request->get('dokter');
        $data->NIK_anak          = $request->get('NIK_anak');
        $data->save();

        return redirect()->route('anak.index')->with(['success' => 'Data Berhasil Di Update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Anak::where('id_anak', $id)->first();
        $data->delete();
        return redirect()->route('anak.index')->with(['success' => 'Data Berhasil Di Hapus']);
    }

    public function printAnak()
    {
        $data = DB::table('ibus as I')
                ->leftjoin('anaks as A', 'I.id_ibu', '=', 'A.id_ibu')
                ->get();
        $pdf = PDF::loadView('admin.anak.pdf', $data);
        $pdf->setPaper('A4', 'landscape');
        $pdf->save(storage_path().'_filename.pdf');
        return $pdf->stream('Data Anak.pdf', array("Attachment" => false));

        // $data = DB::table('ibus as I')
        //         ->leftjoin('anaks as A', 'I.id_ibu', '=', 'A.id_ibu')
        //         ->get();
        // return view('admin.anak.pdf', compact('data'));
    }
}
