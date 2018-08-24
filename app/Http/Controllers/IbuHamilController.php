<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IbuHamil;

class IbuHamilController extends Controller
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
        $data = IbuHamil::all();
        return view('admin.ibuhamil.view', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ibuhamil.create');
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
		$data                    = new IbuHamil;
		$data->nama_bumil        = $request->get('nama_bumil');
		$data->nama_suami        = $request->get('nama_suami');
		$data->umur              = $request->get('umur');
		$data->alamat            = $request->get('alamat');
		$data->bb_sebelum_hamil  = $request->get('bb_sebelum_hamil');
		$data->bb_sekarang       = $request->get('bb_sekarang');
		$data->tb_bumil          = $request->get('tb_bumil');
		$data->hamil_ke          = $request->get('hamil_ke');
		$data->usia_kehamilan    = $request->get('usia_kehamilan');
		$data->penyakit_penyerta = $request->get('penyakit_penyerta');
		$data->lila              = $request->get('lila');
		$data->periksa_kehamilan = $request->get('periksa_kehamilan');
        $data->save();

        return redirect()->route('ibuhamil.index')->with(['success' => 'Data Berhasil Di Tambah']);
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
        $data = IbuHamil::where('id_bumil', $id)->get();
        return view('admin.ibuhamil.edit', compact('data'));
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
        $data = IbuHamil::where('id_bumil', $id)->first();
        $data->nama_bumil        = $request->get('nama_bumil');
		$data->nama_suami        = $request->get('nama_suami');
		$data->umur              = $request->get('umur');
		$data->alamat            = $request->get('alamat');
		$data->bb_sebelum_hamil  = $request->get('bb_sebelum_hamil');
		$data->bb_sekarang       = $request->get('bb_sekarang');
		$data->tb_bumil          = $request->get('tb_bumil');
		$data->hamil_ke          = $request->get('hamil_ke');
		$data->usia_kehamilan    = $request->get('usia_kehamilan');
		$data->penyakit_penyerta = $request->get('penyakit_penyerta');
		$data->lila              = $request->get('lila');
		$data->periksa_kehamilan = $request->get('periksa_kehamilan');
        $data->save();

        if ($data->save() == true) {
        	return redirect()->route('ibuhamil.index')->with(['success' => 'Data Berhasil Di Update']);
        } else {
        	return redirect()->route('ibuhamil.index')->with(['error' => 'Data Gagal Di Update']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$data = IbuHamil::where('id_bumil', $id)->first();
        $data->delete();
        return redirect()->route('ibuhamil.index')->with(['success' => 'Data Berhasil Di Hapus']);
    }
}
