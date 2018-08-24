<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ibu;

class IbuController extends Controller
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
        $data = Ibu::all();
        return view('admin.ibu.view', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ibu.create');
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
        $data               = new Ibu;
        $data->nama_ibu     = $request->get('nama_ibu');
        $data->nama_suami   = $request->get('nama_suami');
        $data->tempat_lahir = $request->get('tempat_lahir');
        $data->tgl_lahir    = $request->get('tgl_lahir');
        $data->alamat       = $request->get('alamat');
        $data->rt           = $request->get('rt');
        $data->rw           = $request->get('rw');
        $data->kelurahan    = $request->get('kelurahan');
        $data->kecamatan    = $request->get('kecamatan');
        $data->No_tlp       = $request->get('No_tlp');
        $data->agama        = $request->get('agama');
        $data->NIK          = $request->get('NIK');
        $data->No_KK        = $request->get('No_KK');
        $data->No_BPJS      = $request->get('No_BPJS');
        $data->save();

        return redirect()->route('ibu.index')->with(['success' => 'Data Berhasil Di Tambah']);
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
        $data = Ibu::where('id_ibu', $id)->get();
        return view('admin.ibu.edit', compact('data'));
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
        $data = Ibu::where('id_ibu', $id)->first();
        $data->nama_ibu     = $request->get('nama_ibu');
        $data->nama_suami   = $request->get('nama_suami');
        $data->tempat_lahir = $request->get('tempat_lahir');
        $data->tgl_lahir    = $request->get('tgl_lahir');
        $data->alamat       = $request->get('alamat');
        $data->rt           = $request->get('rt');
        $data->rw           = $request->get('rw');
        $data->kelurahan    = $request->get('kelurahan');
        $data->kecamatan    = $request->get('kecamatan');
        $data->No_tlp       = $request->get('No_tlp');
        $data->agama        = $request->get('agama');
        $data->NIK          = $request->get('NIK');
        $data->No_KK        = $request->get('No_KK');
        $data->No_BPJS      = $request->get('No_BPJS');
        $data->save();

        return redirect()->route('ibu.index')->with(['success' => 'Data Berhasil Di Update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Ibu::where('id_ibu', $id)->first();
        $data->delete();
        return redirect()->route('ibu.index')->with(['success' => 'Data Berhasil Di Hapus']);
    }
}
