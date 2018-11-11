<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agenda;
use App\BukuTamu;
use App\Kegiatan;
use App\Galeri;
use App\Ukm;
use App\Pkk;
use Illuminate\Support\Facades\DB;

class KegiatanController extends Controller
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
        $data = DB::table('kegiatans as K')
                ->leftjoin('agendas as A', 'K.id_agenda', '=', 'A.id_agenda')
                ->leftjoin('buku_tamus as B', 'K.id_tamu', '=', 'B.id_tamu')
                ->get();
        return view('admin.kegiatan.view', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data  = Agenda::all();
        $data2 = BukuTamu::all();
        $data3 = Galeri::all();
        $data4 = Pkk::all();
        $data5 = Ukm::all();
        return view('admin.kegiatan.create', compact('data', 'data2', 'data3', 'data4', 'data5'));
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
        $data                   = new Kegiatan;
        $data->id_agenda        = $request->get('id_agenda');
        $data->id_tamu          = $request->get('id_tamu');
        $data->id_ukm           = $request->get('id_ukm');
        $data->id_pkk           = $request->get('id_pkk');
        
        $destination            = base_path() . '/public/uploads';
        
        $file                   = $request->file('gambar_kegiatan1')->getClientOriginalName();
        $request->file('gambar_kegiatan1')->move($destination, $file);
        $data->gambar_kegiatan1 = 'uploads/'.$file;
        
        $file1                  = $request->file('gambar_kegiatan2')->getClientOriginalName();
        $request->file('gambar_kegiatan2')->move($destination, $file1);
        $data->gambar_kegiatan2 = 'uploads/'.$file1;
        
        $file2                  = $request->file('pmt1')->getClientOriginalName();
        $request->file('pmt1')->move($destination, $file2);
        $data->pmt1             = 'uploads/'.$file2;
        
        $file3                  = $request->file('pmt2')->getClientOriginalName();
        $request->file('pmt2')->move($destination, $file3);
        $data->pmt2             = 'uploads/'.$file3;

        $data->save();

        return redirect()->route('kegiatan.index')->with(['success' => 'Data Berhasil Di Tambah']);
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
        $data = Agenda::all();
        $data2 = BukuTamu::all();
        $data3 = DB::table('kegiatans as K')
                ->leftjoin('agendas as A', 'K.id_agenda', '=', 'A.id_agenda')
                ->leftjoin('buku_tamus as B', 'K.id_tamu', '=', 'B.id_tamu')
                ->where('id_kegiatan', $id)
                ->get();
        $data4 = Galeri::all();
        return view('admin.kegiatan.edit', compact('data', 'data2', 'data3', 'data4'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Kegiatan::where('id_kegiatan', $id)->first();
        $data->delete();

        return redirect()->route('kegiatan.index')->with(['success' => 'Data Berhasil Di Hapus']);
    }

    public function viewUKM() {
        $data = Ukm::all();
        return view('admin.kegiatan.viewUKM', compact('data'));
    }
    public function storeUKM(Request $request)
    {
        // menerima data request
        $data               = new Ukm;
        $data->nama_ukm     = $request->get('nama_ukm');
        $data->nama_pemilik = $request->get('nama_pemilik');
        $data->notelp       = $request->get('notelp');
        $data->alamat_ukm   = $request->get('alamat_ukm');
        $data->save();

        return redirect()->route('viewUKM')->with(['success' => 'Data Berhasil Di Tambah']);
    }
    public function editUKM($id){
        $data = Ukm::where('id_ukm', $id)->get();
        return view('admin.kegiatan.editUKM', compact('data'));
    }
    public function updateUKM(Request $request, $id){
        $data               = Ukm::where('id_ukm', $id)->first();
        $data->nama_ukm     = $request->get('nama_ukm');
        $data->nama_pemilik = $request->get('nama_pemilik');
        $data->notelp       = $request->get('notelp');
        $data->alamat_ukm   = $request->get('alamat_ukm');
        $data->save();

        return redirect()->route('viewUKM')->with(['success' => 'Data Berhasil Di Update']);
    }
    public function deleteUKM($id){
        $data = Ukm::where('id_ukm', $id)->first();
        $data->delete();

        return redirect()->route('viewUKM')->with(['success' => 'Data Berhasil Di Hapus']);
    }

    public function viewPKK() {
        $data = Pkk::all();
        return view('admin.kegiatan.viewPKK', compact('data'));
    }
    public function storePKK(Request $request)
    {
        // menerima data request
        $data               = new Pkk;
        $data->nama_ketua   = $request->get('nama_ketua');
        $data->notelp_ketua = $request->get('notelp_ketua');
        $data->alamat_ketua = $request->get('alamat_ketua');
        $data->save();

        return redirect()->route('viewPKK')->with(['success' => 'Data Berhasil Di Tambah']);
    }
    public function editPKK($id){
        $data = Pkk::where('id_pkk', $id)->get();
        return view('admin.kegiatan.editPKK', compact('data'));
    }
    public function updatePKK(Request $request, $id){
        $data               = Pkk::where('id_pkk', $id)->first();
        $data->nama_ketua   = $request->get('nama_ketua');
        $data->notelp_ketua = $request->get('notelp_ketua');
        $data->alamat_ketua = $request->get('alamat_ketua');
        $data->save();

        return redirect()->route('viewPKK')->with(['success' => 'Data Berhasil Di Update']);
    }
    public function deletePKK($id){
        $data = Pkk::where('id_pkk', $id)->first();
        $data->delete();

        return redirect()->route('viewPKK')->with(['success' => 'Data Berhasil Di Hapus']);
    }
}
