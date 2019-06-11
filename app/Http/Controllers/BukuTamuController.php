<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BukuTamu;
use Chart;

class BukuTamuController extends Controller
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
        $data = BukuTamu::all();
        return view('admin.bukutamu.view', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bukutamu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data            = new BukuTamu;
        $data->nama_tamu = $request->get('nama_tamu');
        $data->alamat    = $request->get('alamat');
        $data->jabatan   = $request->get('jabatan');
        $data->keperluan = $request->get('keperluan');
        $data->save();

        return redirect()->route('bukutamu.index')->with(['success' => 'Data Berhasil Di Tambah']);
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
        $data = BukuTamu::where('id_tamu', $id)->get();
        return view('admin.bukutamu.edit', compact('data'));
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
        $data = BukuTamu::where('id_tamu', $id)->first();
        $data->nama_tamu = $request->get('nama_tamu');
        $data->alamat    = $request->get('alamat');
        $data->jabatan   = $request->get('jabatan');
        $data->keperluan = $request->get('keperluan');
        $data->save();

        return redirect()->route('bukutamu.index')->with(['success' => 'Data Berhasil Di Update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = BukuTamu::where('id_tamu', $id)->first();
        $data->delete();
        return redirect()->route('bukutamu.index')->with(['success' => 'Data Berhasil Di Hapus']);
    }
}
