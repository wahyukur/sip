<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anak;
use App\User;
use App\Imunisasi;
use App\VitA;
use App\Timbang;
use App\Exports\anakExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Chart;

class AnakController extends Controller
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
        $data = DB::table('anaks as A')
                ->leftjoin('users as I', 'I.id', '=', 'A.id_ibu')
                ->get();
        // dd($data);
        return view('admin.anak.view', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = User::select('id', 'nama_ibu', 'nama_suami')
        ->orderBy('nama_ibu', 'asc')->get();
        return view('admin.anak.create', compact('data'));
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
        $data                    = new Anak;
        $data->nama_anak         = $request->get('nama_anak');
        $data->id_ibu            = $request->get('id_ibu');
        $data->tempat_lhr        = $request->get('tempat_lhr');
        $data->tgl_lhr           = $request->get('tgl_lhr');
        $data->bb_lahir          = $request->get('bb_lahir');
        $data->tb_lahir          = $request->get('tb_lahir');
        $data->jenis_kelamin     = $request->get('jenis_kelamin');
        $data->anak_ke           = $request->get('anak_ke');
        $data->jenis_persalinan  = $request->get('jenis_persalinan');
        $data->tempat_persalinan = $request->get('tempat_persalinan');
        $data->dokter            = $request->get('dokter');
        $data->NIK_anak          = $request->get('NIK_anak');
        $data->BPJS_anak         = $request->get('BPJS_anak');
        $data->save();

        return redirect()->route('anak.index')->with(['success' => 'Data Berhasil Di Tambah']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DB::table('anaks as A')
                ->leftjoin('users as I', 'A.id_ibu', '=', 'I.id')
                ->where('A.id_anak', $id)->first();
        $data1 = DB::table('anaks as A')
                ->leftjoin('imunisasis as M', 'A.id_anak', '=', 'M.id_anak')
                ->leftjoin('jenis_imunisasis as J', 'M.id_j_imun', '=', 'J.id_j_imun')
                ->where('A.id_anak', $id)->get();
        $data2 = VitA::where('id_anak', $id)->get();
        // Grafik umur 1 - 24 bulan
        $t = DB::table('anaks as A')
                ->leftjoin('timbangs as T', 'A.id_anak', '=', 'T.id_anak')
                ->select('A.id_anak', 'A.nama_anak', 'T.umur', 'T.berat_badan', 'T.tinggi_badan', 'T.tgl_timbang')
                ->where('A.id_anak', $id)
                ->get();
        $grafik = array(61);
        for ($i=0; $i < 61; $i++) { 
            $grafik[$i] = null;
        }
        $grafik[0] = $data->bb_lahir;
        foreach ($t as $some) {
            $grafik[$some->umur] = $some->berat_badan;
        }
        // dd($grafik);

        if ($data->jenis_kelamin == 0) {
            $chart1 = Chart::title([
                'text' => 'KMS Laki-Laki',
            ])
            ->subtitle([
                'text' => 'Kartu Menuju Sehat',
            ])
            ->chart([
                'backgroundcolor' => null,
            ])
            ->colors([
                '#0c2959'
            ])
            ->xaxis([
                'title' => [
                    'text' => 'Umur',
                ],
                'labels'     => [
                    'style' => [
                        'fontsize' => 12
                    ],
                ],
                'gridlinewidth' => 1,
                'tickinterval' => 1
            ])
            ->yaxis([
                'title' => [
                    'text' => 'Berat Badan'
                ],
                'labels'     => [
                    'style' => [
                        'fontsize' => 12
                    ],
                ],
                'gridlinewidth' => 1,
                'tickinterval' => 1
            ])
            ->legend([
                'enabled' => false
            ])
            ->plotOptions([
                'series' => [
                    'label' => [
                        'connectorallowed' => false,
                    ],
                    'pointstart' => 0,
                    'marker' => [
                        'enabled' => false,
                    ],
                    'enablemousetracking' => false
                ],
                'candlestick' => [
                    'linecolor' => '#404048',
                ],
                'scatter' => [
                    'datalabels' => [
                        'enabled' => true
                    ],
                ],
            ])
            ->series(
                [
                    [
                        'name'  => 'BB Lebih',
                        'data'  => [5.0,6.5,7.9,8.9,9.6,10.3,10.9,11.3,11.8,12.2,12.5,12.9,13.2,13.5,13.8,14.2,14.5,14.8,15.1,15.4,15.7,16.0,16.3,16.6,16.9,17.2,17.5,17.9,18.2,18.4,18.8,19.0,19.3,19.6,19.9,20.2,20.4,20.7,21.0,21.2,21.5,21.8,22.1,22.4,22.6,22.9,23.2,23.5,23.8,24.1,24.3,24.6,24.9,25.2,25.5,25.8,26.1,26.4,26.7,27.0,27.3,],
                        'color' => '#f2f200'
                    ],
                    [
                        'name'  => 'BB Normal',
                        'data'  => [4.4,5.8,7.1,8.0,8.7,9.3,9.8,10.3,10.7,11.0,11.4,11.7,12.0,12.3,12.6,12.8,13.1,13.4,13.6,13.9,14.2,14.4,14.7,15.0,15.2,15.6,15.8,16.1,16.3,16.6,16.9,17.1,17.3,17.6,17.8,18.1,18.3,18.5,18.8,19.0,19.2,19.5,19.7,20.0,20.2,20.4,20.7,21.0,21.2,21.4,21.7,21.9,22.2,22.4,22.7,22.9,23.2,23.4,23.7,23.9,24.1],
                        'color' => '#39b500'
                    ],
                    [
                        'name'  => 'BB Kurang',
                        'data'  => [2.5,3.4,4.3,5.0,5.5,6.0,6.3,6.7,6.9,7.1,7.3,7.6,7.7,7.9,8.1,8.3,8.4,8.6,8.8,8.9,9.1,9.2,9.4,9.5,9.7,9.8,10.0,10.1,10.2,10.4,10.5,10.6,10.8,10.9,11.0,11.2,11.3,11.4,11.5,11.7,11.8,11.9,12.0,12.1,12.2,12.4,12.5,12.6,12.7,12.8,12.9,13.0,13.2,13.3,13.4,13.5,13.6,13.7,13.9,14.0,14.1],
                        'color' => '#39b500'
                    ],
                    [
                        'name'  => 'BB Sangat Kurang',
                        'data'  => [2.1,2.9,3.8,4.4,4.9,5.3,5.7,5.9,6.2,6.4,6.6,6.8,6.9,7.1,7.3,7.4,7.6,7.7,7.8,8.0,8.1,8.2,8.4,8.5,8.6,8.8,8.9,9.0,9.1,9.2,9.4,9.5,9.6,9.7,9.8,9.9,10.0,10.1,10.2,10.3,10.4,10.5,10.6,10.7,10.8,10.9,11.0,11.1,11.2,11.3,11.4,11.5,11.6,11.7,11.8,11.9,12.0,12.1,12.2,12.3,12.4,],
                        'color' => '#ff0000'
                    ],
                    [
                        'type' => 'scatter',
                        'marker' => [
                            'enabled' => true,
                            'symbol' => 'cross',
                            'fillcolor' => '#000',
                            'linecolor' => '#fff'
                        ],
                        'name' => 'Berat Badan',
                        'data' => $grafik
                    ]
                ]
            )
            ->display();
        } else {
            $chart1 = Chart::title([
                'text' => 'KMS Perempuan',
            ])
            ->subtitle([
                'text' => 'Kartu Menuju Sehat',
            ])
            ->chart([
                'backgroundcolor' => null,
            ])
            ->colors([
                '#0c2959'
            ])
            ->xaxis([
                'title' => [
                    'text' => 'Umur',
                ],
                'labels'     => [
                    'style' => [
                        'fontsize' => 12
                    ],
                ],
                'gridlinewidth' => 1,
                'tickinterval' => 1
            ])
            ->yaxis([
                'title' => [
                    'text' => 'Berat Badan'
                ],
                'labels'     => [
                    'style' => [
                        'fontsize' => 12
                    ],
                ],
                'gridlinewidth' => 1,
                'tickinterval' => 1
            ])
            ->legend([
                'enabled' => false
            ])
            ->plotOptions([
                'series' => [
                    'label' => [
                        'connectorallowed' => false,
                    ],
                    'pointstart' => 0,
                    'marker' => [
                        'enabled' => false,
                    ],
                    'enablemousetracking' => false
                ],
                'candlestick' => [
                    'linecolor' => '#404048',
                ],
                'scatter' => [
                    'datalabels' => [
                        'enabled' => true
                    ],
                ],
            ])
            ->series(
                [
                    [
                        'name'  => 'BB Lebih',
                        'data'  => [4.8,6.2,7.4,8.4,9.2,9.8,10.4,10.9,11.4,11.8,12.2,12.5,12.9,13.2,13.6,13.9,14.2,14.5,14.8,15.1,15.4,15.7,16.0,16.3,16.6,17.0,17.3,17.6,17.9,18.3,18.6,18.9,19.2,19.5,19.8,20.1,20.4,20.8,21.1,21.4,21.8,22.1,22.4,22.8,23.1,23.4,23.8,24.1,24.5,24.8,25.2,25.5,25.9,26.2,26.5,26.9,27.3,27.6,27.9,28.3,28.6],
                        'color' => '#f2f200'
                    ],
                    [
                        'name'  => 'BB Normal',
                        'data'  => [4.2,5.5,6.6,7.5,8.2,8.8,9.3,9.8,10.2,10.5,10.9,11.2,11.5,11.8,12.1,12.4,12.6,12.9,13.2,13.5,13.7,14.0,14.3,14.6,14.9,15.1,15.4,15.7,16.0,16.2,16.5,16.8,17.0,17.3,17.6,17.9,18.1,18.4,18.7,19.0,19.2,19.5,19.8,20.1,20.4,20.7,20.9,21.2,21.5,21.8,22.1,22.4,22.7,22.9,23.2,23.5,23.8,24.1,24.4,24.6,24.9],
                        'color' => '#39b500'
                    ],
                    [
                        'name'  => 'BB Kurang',
                        'data'  => [2.4,3.1,3.9,4.5,5.0,5.4,5.7,6.0,6.2,6.5,6.7,6.9,7.0,7.2,7.4,7.6,7.7,7.9,8.1,8.2,8.4,8.6,8.7,8.9,9.0,9.2,9.3,9.5,9.7,9.8,10.0,10.1,10.3,10.4,10.5,10.7,10.8,10.9,11.1,11.2,11.3,11.4,11.6,11.7,11.8,12.0,12.1,12.2,12.3,12.4,12.6,12.7,12.8,12.9,13.0,13.2,13.3,13.4,13.5,13.6,13.7],
                        'color' => '#39b500'
                    ],
                    [
                        'name'  => 'BB Sangat Kurang',
                        'data'  => [2.0,2.8,3.4,4.0,4.4,4.8,5.1,5.3,5.6,5.8,6.0,6.1,6.3,6.4,6.6,6.8,6.9,7.0,7.2,7.3,7.5,7.6,7.8,7.9,8.1,8.2,8.3,8.5,8.6,8.8,8.9,9.0,9.1,9.2,9.4,9.5,9.6,9.7,9.8,10.0,10.1,10.2,10.3,10.4,10.5,10.6,10.7,10.8,10.9,11.0,11.1,11.2,11.3,11.4,11.5,11.6,11.7,11.8,11.9,12.0,12.1],
                        'color' => '#ff0000'
                    ],
                    [
                        'type' => 'scatter',
                        'marker' => [
                            'enabled' => true,
                            'symbol' => 'cross',
                            'fillcolor' => '#000',
                            'linecolor' => '#fff'
                        ],
                        'name' => 'Berat Badan',
                        'data' => $grafik
                    ]
                ]
            )
            ->display();
        }
        
        return view('admin.anak.detail', compact('data', 'data1', 'data2', 'chart1'))
            ->with('grafik',json_encode($grafik,JSON_NUMERIC_CHECK));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table('anaks as A')
                ->leftjoin('users as I', 'I.id', '=', 'A.id_ibu')
                ->where('A.id_anak', $id)->first();
        $data2 = User::select('id', 'nama_ibu', 'nama_suami')->get();
        return view('admin.anak.edit', compact('data', 'data2'));
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
        $data = Anak::where('id_anak', $id)->first();
        $data->nama_anak         = $request->get('nama_anak');
        $data->id_ibu            = $request->get('id_ibu');
        $data->tempat_lhr        = $request->get('tempat_lhr');
        $data->tgl_lhr           = $request->get('tgl_lhr');
        $data->bb_lahir          = $request->get('bb_lahir');
        $data->tb_lahir          = $request->get('tb_lahir');
        $data->jenis_kelamin     = $request->get('jenis_kelamin');
        $data->anak_ke           = $request->get('anak_ke');
        $data->jenis_persalinan  = $request->get('jenis_persalinan');
        $data->tempat_persalinan = $request->get('tempat_persalinan');
        $data->dokter            = $request->get('dokter');
        $data->NIK_anak          = $request->get('NIK_anak');
        $data->BPJS_anak         = $request->get('BPJS_anak');
        $data->KMS               = $request->get('KMS');
        $data->save();

        return redirect()->route('anak.index')->with(['success' => 'Data Berhasil Di Update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Anak::where('id_anak', $id)->first();
        $data->delete();
        return redirect()->route('anak.index')->with(['success' => 'Data Berhasil Di Hapus']);
    }

    public function exportAnak()
    {
        // return (new anakExport(2018))->download('invoices.xlsx');
        return Excel::download(new anakExport(2017), 'anaks.xlsx');
    }
}