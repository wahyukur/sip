<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ibuExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\User;

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
        // $data = DB::table('users as I')
        //         ->join('anaks as A', 'I.id', '=', 'A.id_ibu')
        //         ->get();
        $data = DB::table('users')
                ->where('jabatan', '=', 0)
                ->get();
        // $data = DB::table('users')
        //     ->where('name', '=', 'John')
        //     ->where(function ($query) {
        //         $query->where('votes', '>', 100)
        //               ->orWhere('title', '=', 'Admin');
        //     })
        //     ->get();
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
        $data->email        = strtolower(str_random(9));
        $data->password     = strtolower(str_random(9));
        $data->save();

        return redirect()->route('ibu.index')->with([
            'success' => 'Data Berhasil Di Tambah'
        ]);
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
        return view('admin.ibu.detail', compact('data'));
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
        $data = User::where('id', $id)->first();
        $data->delete();
        return redirect()->route('ibu.index')->with(['success' => 'Data Berhasil Di Hapus']);
    }

    public function exportIbu()
    {
        // return (new Ibu)->download('ibu.xlsx');
        return Excel::download(new ibuExport, 'ibus.xlsx');
        // $ibu_data = DB::table('ibus')->get()->toArray();
        // $ibu_array[] = array('Nama Ibu', 'Nama Suami', 'Tempat Lahir', 'Tanggal Lahir', 'Alamat', 'Rt', 'Rw', 'Kelurahan', 'Kecamatan', 'No.Telp', 'Agama', 'NIK', 'No.KK', 'No.BPJS', 'Status Gakin');
        // foreach ($ibu_data as $ibu) {
        //     $ibu_array[] = array(
        //         'Nama Ibu' => $ibu->nama_ibu,
        //         'Nama Suami' => $ibu->nama_suami,
        //         'Tempat Lahir' => $ibu->tempat_lahir,
        //         'Tanggal Lahir' => $ibu->tgl_lahir,
        //         'Alamat' => $ibu->alamat,
        //         'Rt' => $ibu->rt,
        //         'Rw' => $ibu->rw,
        //         'Kelurahan' => $ibu->kelurahan,
        //         'Kecamatan' => $ibu->kecamatan,
        //         'No.Telp' => $ibu->No_tlp,
        //         'Agama' => $ibu->agama,
        //         'NIK' => $ibu->NIK,
        //         'No.KK' => $ibu->No_KK,
        //         'No.BPJS' => $ibu->No_BPJS,
        //         'Status Gakin' => $ibu->gakin
        //     );
        // }
        // Excel::create('Ibu Data', function($excel) use ($ibu_array){
        //     $excel->setTitle('Ibu Data');
        //     $excel->sheet('Ibu Data', function($sheet) use ($ibu_array){
        //         $sheet->fromArray($ibu_array, null, 'A1', false, false);
        //     });
        // })->download('xlsx');

        // $customer_data = DB::table('tbl_customer')->get()->toArray();
        // $customer_array[] = array('Customer Name', 'Address', 'City', 'Postal Code', 'Country');
        // foreach($customer_data as $customer) {
        //     $customer_array[] = array(
        //         'Customer Name'  => $customer->CustomerName,
        //         'Address'   => $customer->Address,
        //         'City'    => $customer->City,
        //         'Postal Code'  => $customer->PostalCode,
        //         'Country'   => $customer->Country
        //     );
        // }
        // Excel::create('Customer Data', function($excel) use ($customer_array){
        //     $excel->setTitle('Customer Data');
        //     $excel->sheet('Customer Data', function($sheet) use ($customer_array){
        //         $sheet->fromArray($customer_array, null, 'A1', false, false);
        //     });
        // })->download('xlsx');
    }
}
