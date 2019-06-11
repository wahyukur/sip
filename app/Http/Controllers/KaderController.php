<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

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
        $data = DB::table('users')
                ->where('jabatan', '>', 0)
                ->orderBy('jabatan', 'asc')
                ->get();
        return view('admin.kader.view', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = DB::table('users')
                ->where('jabatan', '=', 0)
                ->get();
        return view('admin.kader.create', compact('data'));
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
        $data               = new User;
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
        $data->gakin        = $request->get('gakin');
        $data->jabatan      = $request->get('jabatan');
        $data->email        = strtolower(str_random(9));
        $data->password     = strtolower(str_random(9));
        $data->save();

        return redirect()->route('kader.index')->with(['success' => 'Data Berhasil Di Tambah']);
    }
    public function store1(Request $request)
    {
        $id = $request->get('id');
        $data = User::where('id', $id)->first();
        $data->jabatan = $request->get('jabatan');
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
        $data = User::where('id', $id)->get();
        return view('admin.kader.detail', compact('data'));
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
        $data = User::where('id', $id)->get();
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
        $data = User::where('id', $id)->first();
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
        $data->gakin        = $request->get('gakin');
        $data->jabatan      = $request->get('jabatan');
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
