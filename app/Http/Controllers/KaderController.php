<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kader;

class KaderController extends Controller
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
        $data = Kader::all();
        return view('admin.kader.view', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.kader.create');
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
        // menerima data request
        $data             = new Kader;
        $data->nama_kader = $request->get('nama_kader');
        $data->alamat     = $request->get('alamat');
        $data->jabatan    = $request->get('jabatan');
        $data->no_telp    = $request->get('no_telp');
        $data->save();

        return redirect()->route('kader.index')->with(['success' => 'Data Berhasil Di Tambah']);
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
        $data = Kader::where('id_kader', $id)->get();
        return view('admin.kader.edit', compact('data'));
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
        $data = Kader::where('id_kader', $id)->first();
        $data->nama_kader = $request->get('nama_kader');
        $data->alamat     = $request->get('alamat');
        $data->jabatan    = $request->get('jabatan');
        $data->no_telp    = $request->get('no_telp');
        $data->save();

        return redirect()->route('kader.index')->with(['success' => 'Data Berhasil Di Update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Kader::where('id_kader', $id)->first();
        $data->delete();
        return redirect()->route('kader.index')->with(['success' => 'Data Berhasil Di Hapus']);
    }
}
