<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IbuHamil;
use Illuminate\Support\Facades\DB;

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
        $data = DB::table('ibu_hamils')
                ->where('status', null)
                ->get();
        $data2 = DB::table('ibu_hamils')
                ->where('status', 'Meninggal')
                ->get();
        $data3 = DB::table('ibu_hamils')
                ->where('status', 'Melahirkan')
                ->get();
        return view('admin.ibuhamil.view', compact('data', 'data2', 'data3'));
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
        $data = IbuHamil::where('id_bumil', $id)->get();
        $data2 = DB::table('ibu_hamils')
                ->where('status', 'Meninggal')
                ->get();
        $data3 = DB::table('ibu_hamils')
                ->where('status', 'Melahirkan')
                ->get();
        return view('admin.ibuhamil.detail', compact('data', 'data2', 'data3'));
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

    public function meninggal(Request $request)
    {
        $id                     = $request->get('idbumil');
        $data                   = IbuHamil::where('id_bumil', $id)->first();
        $status                 = "Meninggal";
        $data->status           = $status;
        $data->umur_meninggal   = $request->get('umur_meninggal');
        $data->tempat_meninggal = $request->get('tempat_meninggal');
        $data->save();

        if ($data->save() == true) {
            return redirect()->route('ibuhamil.index')->with(['success' => 'Data Berhasil Di Update']);
        } else {
            return redirect()->route('ibuhamil.index')->with(['error' => 'Data Gagal Di Update']);
        }
    }

    public function melahirkan(Request $request)
    {
        $id                      = $request->get('idbumil');
        $data                    = IbuHamil::where('id_bumil', $id)->first();
        $status                  = "Melahirkan";
        $data->status            = $status;
        $data->umur_melahirkan   = $request->get('umur_meninggal');
        $data->tgl_melahirkan    = $request->get('tgl_melahirkan');
        $data->bb_anak           = $request->get('bb_anak');
        $data->tb_anak           = $request->get('tb_anak');
        $data->anak_ke           = $request->get('anak_ke');
        $data->jenis_persalinan  = $request->get('jenis_persalinan');
        $data->tempat_persalinan = $request->get('tempat_persalinan');
        $data->dokter            = $request->get('dokter');
        $data->nama_anak         = $request->get('nama_anak');
        $data->save();

        if ($data->save() == true) {
            return redirect()->route('ibuhamil.index')->with(['success' => 'Data Berhasil Di Update']);
        } else {
            return redirect()->route('ibuhamil.index')->with(['error' => 'Data Gagal Di Update']);
        }
    }
}
