<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anak;
use App\Ibu;
use Illuminate\Support\Facades\DB;

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
        //
        $data = Anak::all();
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
}
