<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Calendar;
use Chart;
use App\Ibu;
use App\Anak;
use App\User;
use App\Agenda;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data1 = DB::table('users')
                ->where('jabatan', '=', 0)
                ->count();
        $data2 = Anak::count();
        $data3 = DB::table('users')
                ->whereBetween('jabatan', [1, 4])
                ->count();
        $data4 = DB::table('users')
                ->where('user', '=', 1)
                ->count();
        
        //Grafik
        date_default_timezone_set('Asia/Jakarta');
        $nmm = Carbon::now()->format('m'); // Tanggal sekarang bulan
        $nY = Carbon::now()->format('Y'); // Tanggal sekarang tahun
        $nm = [1,2,3,4,5,6,7,8,9,10,11,12];
        $t_lebih=[];
        $t_normal=[];
        $t_kurang=[];
        $t_s_kurang=[];
        foreach ($nm as $nowM) {
            $g_lebih = DB::table('timbangs')
                ->whereMonth('tgl_timbang', $nowM)
                ->whereYear('tgl_timbang', $nY)
                ->where('status_gizi', '=', 'BB Lebih')
                ->count();

            $g_normal = DB::table('timbangs')
                ->whereMonth('tgl_timbang', $nowM)
                ->whereYear('tgl_timbang', $nY)
                ->where('status_gizi', '=', 'BB Normal')
                ->count();

            $g_kurang = DB::table('timbangs')
                ->whereMonth('tgl_timbang', $nowM)
                ->whereYear('tgl_timbang', $nY)
                ->where('status_gizi', '=', 'BB Kurang')
                ->count();

            $g_s_kurang = DB::table('timbangs')
                ->whereMonth('tgl_timbang', $nowM)
                ->whereYear('tgl_timbang', $nY)
                ->where('status_gizi', '=', 'BB Sangat Kurang')
                ->count();

            array_push($t_lebih, $g_lebih);
            array_push($t_normal, $g_normal);
            array_push($t_kurang, $g_kurang);
            array_push($t_s_kurang, $g_s_kurang);
        }
        ////

        $agendas = [];
        $data = Agenda::all();
        if($data->count()) {
            foreach ($data as $key => $value) {
                $agendas[] = Calendar::event(
                    $value->kegiatan,
                    true,
                    new \DateTime($value->start),
                    new \DateTime($value->end.' +1 day'),
                    null,
                    // Add color and link on event
                    [
                        'color' => $value->color,
                    ]
                );
            }
        }
        $calendar = Calendar::addEvents($agendas)
        ->setOptions([ //set fullcalendar options
            'height' => 'auto',
            'themeSystem' => 'bootstrap3',
            'columnHeader' => true,
            'allDayDefault'=> true, 
            'header' => [
                'left' => 'today prev,next',
                'center' =>'title',
                'right' =>'month'],
        ]);

        // GRAFIK /////////////////
        $chart1 = Chart::title([
            'text' => 'Grafik Status Gizi Anak',
        ])
        ->chart([
            'type'     => 'column', // pie , columnt ect
            'renderTo' => 'chart1', // render the chart into your div with id
        ])
        ->colors([
            '#0c2959'
        ])
        ->xaxis([
            'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            'labels'     => [
                'style' => [
                    'fontsize' => 12
                ],
            ],
            'gridlinewidth' => 1,
            'tickinterval' => 1
        ])
        ->yaxis([
            'title' => 'Jumlah',
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
        ->plotoptions([
            'series' => [
                'label' => [
                    'connectorallowed' => 'false',
                ],
                'pointstart' => 0,
                'marker' => [
                    'enabled' => 'false',
                ],
                'enablemousetracking' => 'true'
            ],
            'candlestick' => [
                'linecolor' => '#404048',
            ],
            'scatter' => [
                'datalabels' => [
                    'enabled' => 'true'
                ],
            ],
        ])
        ->series(
            [
                [
                    'name'  => 'BB Lebih',
                    'data'  => $t_lebih,
                    'color' => '#f2f200'
                ],
                [
                    'name'  => 'BB Normal',
                    'data'  => $t_normal,
                    'color' => '#39b500'
                ],
                [
                    'name'  => 'BB Kurang',
                    'data'  => $t_kurang,
                    'color' => '#39b500'
                ],
                [
                    'name'  => 'BB Sangat Kurang',
                    'data'  => $t_s_kurang,
                    'color' => '#ff0000'
                ],
            ]
        )
        ->display();

        $cek_umur = DB::table('anaks')->where('state', 0)->get();
        foreach ($cek_umur as $anak) {
            date_default_timezone_set('Asia/Jakarta');
            $now = Carbon::now()->format('Y-m-d'); // Tanggal sekarang
            $b_day = Carbon::parse($anak->tgl_lhr); // Tanggal Lahir
            $age = $b_day->diffInMonths($now);  // Menghitung umur
            if ($age >= 6) {
                $edit = Anak::where('id_anak', $anak->id_anak);
                $edit->state = 1;
            }
        }
        
        if (Auth::user()->level == 1){
            return view('admin.dashboard', compact('calendar', 'data', 'data1', 'data2', 'data3', 'data4', 'chart1'));
        } else {
            return view('user.dashboard');
        }
    }

    public function getProfile() {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    public function postProfile(Request $request) {
        $email           = $request->get('email');
        $oldPassword     = $request->get('oldPassword');
        $newPassword     = $request->get('newPassword');
        $confirmPassword = $request->get('confirmPassword');

        if (empty($oldPassword) or empty($newPassword) or empty($confirmPassword)) {
            $data = Auth::user();
            $data->email = $email;
            $data->save();

            Auth::logout();
            return redirect()->route('login');
        }else{
            $data = Auth::user();
            if (Hash::check($oldPassword, $data->password)) {
                if (empty($newPassword) or empty($confirmPassword)) {
                    return redirect()->back()->with(['pwdBaru' => 'Password Baru Kosong']);
                } else {
                    if ($newPassword != $confirmPassword) {
                        return redirect()->back()->with(['pwdConf' => 'Password Tidak Sama']);
                    } else {
                        $pwd           = Auth::user();
                        $pwd->email    = $email;
                        $pwd->password = bcrypt($newPassword);
                        $pwd->save();

                        Auth::logout();
                        return redirect()->route('login');
                    }
                }
            } else {
                return redirect()->back()->with(['pwdLama' => 'Password Salah']);
            }
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->back();
    }
}
