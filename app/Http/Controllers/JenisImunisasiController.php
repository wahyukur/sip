<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JenisImunisasi;
use Illuminate\Support\Facades\DB;

class JenisImunisasiController extends Controller
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
        $data = DB::table('jenis_imunisasis')
                ->orderBy('umur', 'asc')
                ->get();
        return view('admin.jenisimunisasi.view', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jenisimunisasi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data             = new JenisImunisasi;
        $data->nama_imun  = $request->get('nama_imun');
        $data->umur       = $request->get('umur');
        $data->save();

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
        $data = JenisImunisasi::where('id_j_imun', $id)->get();
        return view('admin.jenisimunisasi.edit', compact('data'));
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
        $data = JenisImunisasi::where('id_j_imun', $id)->first();
        $data->nama_imun  = $request->get('nama_imun');
        $data->umur       = $request->get('umur');
        $data->save();

        return redirect()->route('jenisimunisasi.index')->with(['success' => 'Data Berhasil Di Update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = JenisImunisasi::where('id_j_imun', $id)->first();
        $data->delete();
        return redirect()->route('jenisimunisasi.index')->with(['success' => 'Data Berhasil Di Hapus']);
    }
}
