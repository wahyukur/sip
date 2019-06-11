<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Kehadiran;
use App\Kegiatan;
use App\Anak;

class KehadiranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('kehadirans as P')
                ->leftjoin('kegiatans as K', 'K.id_kegiatan', '=', 'P.id_kegiatan')
                ->leftjoin('anaks as A', 'A.id_anak', '=', 'P.id_anak')
                ->select('P.id_kehadiran' ,'A.nama_anak', 'A.jenis_kelamin', 'A.tgl_lhr', 'P.alasan', 'P.tgl_kunjungan', 'P.ket_hadir')
                ->get();
        return view('admin.kehadiran.view', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data  = DB::table('anaks as A')
                ->leftjoin('users as I', 'I.id', '=', 'A.id_ibu')
                ->get();
        $data2 = DB::table('kegiatans as K')
                ->leftjoin('agendas as A', 'A.id_agenda', '=', 'K.id_agenda')
                ->where('A.j_kegiatan', '=', 0)
                ->get();
        return view('admin.kehadiran.create', compact('data', 'data2'));
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
        $data                = new Kehadiran;
        $data->id_kegiatan   = $request->get('id_kegiatan');
        $data->id_anak       = $request->get('id_anak');
        $data->alasan        = $request->get('alasan');
        $data->tgl_kunjungan = $request->get('tgl_kunjungan');
        $data->ket_hadir     = $request->get('ket_hadir');
        $data->save();

        return redirect()->route('kehadiran.index')->with(['success' => 'Data Berhasil Di Tambah']);
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
        $data = DB::table('kehadirans as P')
                ->leftjoin('kegiatans as K', 'K.id_kegiatan', '=', 'P.id_kegiatan')
                ->leftjoin('agendas as G', 'G.id_agenda', '=', 'K.id_agenda')
                ->leftjoin('anaks as A', 'A.id_anak', '=', 'P.id_anak')
                ->leftjoin('users as I', 'I.id', '=', 'A.id_ibu')
                ->where('id_kehadiran', $id)
                ->get();
        $data2  = DB::table('anaks as A')
                ->leftjoin('users as I', 'I.id', '=', 'A.id_ibu')
                ->get();
        $data3 = DB::table('kegiatans as K')
                ->leftjoin('agendas as A', 'A.id_agenda', '=', 'K.id_agenda')
                ->get();
        return view('admin.kehadiran.edit', compact('data', 'data2', 'data3'));
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
        $data = Kehadiran::where('id_kehadiran', $id)->first();
        $data->id_kegiatan   = $request->get('id_kegiatan');
        $data->id_anak       = $request->get('id_anak');
        $data->alasan        = $request->get('alasan');
        $data->tgl_kunjungan = $request->get('tgl_kunjungan');
        $data->ket_hadir     = $request->get('ket_hadir');
        $data->save();

        return redirect()->route('kehadiran.index')->with(['success' => 'Data Berhasil Di Update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Kehadiran::where('id_kehadiran', $id)->first();
        $data->delete();
        return redirect()->route('kehadiran.index')->with(['success' => 'Data Berhasil Di Hapus']);
    }
}
