<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imunisasi;
use App\Anak;
use App\JenisImunisasi;
use App\Ibu;
use Illuminate\Support\Facades\DB;

class ImunisasiController extends Controller
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
        // $data = Imunisasi::all();
        $data = DB::table('imunisasis as M')
                ->leftjoin('anaks as A', 'M.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->leftjoin('jenis_imunisasis as J', 'M.id_j_imun', '=', 'J.id_j_imun')
                ->select('M.id_imun', 'A.nama_anak', 'J.nama_imun', 'M.tgl_imun', 'M.booster', 'M.ket_imun')
                ->orderBy('id_imun', 'asc')
                ->get();
        return view('admin.imunisasi.view', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = DB::table('anaks as A')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->orderBy('nama_anak', 'asc')
                ->get();
        $data2 = JenisImunisasi::all();
        return view('admin.imunisasi.create', compact('data', 'data2'));
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
        $imun = $request->get('id_j_imun');
        for ($i=0; $i < count($imun); $i++){
            $data            = new Imunisasi;
            $data->id_anak   = $request->get('id_anak');
            $data->id_j_imun = $imun[$i];
            $data->tgl_imun  = $request->get('tgl_imun');
            $data->booster   = $request->get('booster');
            $data->ket_imun  = $request->get('ket_imun');
            $data->save();
        }

        return redirect()->route('imunisasi.index')->with(['success' => 'Data Berhasil Di Tambah']);
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
        $data = DB::table('imunisasis as M')
                ->leftjoin('anaks as A', 'M.id_anak', '=', 'A.id_anak')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->leftjoin('jenis_imunisasis as J', 'M.id_j_imun', '=', 'J.id_j_imun')
                ->where('M.id_imun', $id)
                ->get();
        $data1 = DB::table('anaks as A')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->orderBy('nama_anak', 'asc')
                ->get();
        $data2 = JenisImunisasi::all();
        return view('admin.imunisasi.edit', compact('data', 'data1', 'data2'));
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
        $data = Imunisasi::where('id_imun', $id)->first();
        $data->id_anak   = $request->get('id_anak');
        $data->id_j_imun = $request->get('id_j_imun');
        $data->tgl_imun  = $request->get('tgl_imun');
        $data->booster   = $request->get('booster');
        $data->ket_imun  = $request->get('ket_imun');
        $data->save();

        return redirect()->route('imunisasi.index')->with(['success' => 'Data Berhasil Di Update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Imunisasi::where('id_imun', $id)->first();
        $data->delete();
        return redirect()->route('imunisasi.index')->with(['success' => 'Data Berhasil Di Hapus']);
    }
}
