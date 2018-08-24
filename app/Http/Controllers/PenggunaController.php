<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PenggunaController extends Controller
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
        $data = User::all();
        return view('admin.user.view', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::where('id', $id)->get();
        return view('admin.user.edit', compact('data'));
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
        $data->save();

        return redirect()->route('ibu.index')->with('success', 'Data Berhasil Diupdate');
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
        return redirect()->route('ibu.index')->with('success', 'Data Berhasil Dihapus');
    }
}
