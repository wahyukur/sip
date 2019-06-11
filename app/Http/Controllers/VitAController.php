<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VitA;
use Illuminate\Support\Facades\DB;

class VitAController extends Controller
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
        $data = DB::table('vit_as as V')
                ->leftjoin('anaks as A', 'V.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->select('V.id_vitA', 'A.nama_anak', 'A.jenis_kelamin', 'A.tgl_lhr', 'I.alamat', 'I.rt', 'I.rw', 'V.tgl_vitA', 'V.keterangan')
                ->orderBy('tgl_vitA', 'desc')
                ->get();
        return view('admin.vitA.view', compact('data'));
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
        //
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
        $data = DB::table('vit_as as V')
                ->leftjoin('anaks as A', 'V.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->where('V.id_vitA', $id)
                ->first();
        $data2 = DB::table('anaks as A')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->orderBy('nama_anak', 'asc')
                ->get();
        return view('admin.vitA.edit', compact('data', 'data2'));
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
        $data = VitA::where('id_vitA', $id)->first();
        $data->id_anak    = $request->get('id_anak');
        $data->tgl_vitA   = $request->get('tgl_vitA');
        $data->keterangan = $request->get('keterangan');
        $data->save();

        return redirect()->route('vitA.index')->with(['success' => 'Data Berhasil Di Update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = VitA::where('id_vitA', $id)->first();
        $data->delete();
        return redirect()->route('vitA.index')->with(['success' => 'Data Berhasil Di Hapus']);
    }
}
