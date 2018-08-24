<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Calendar;
use App\Ibu;
use App\Anak;
use App\User;
use App\Agenda;
use Illuminate\Support\Facades\DB;

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
    public function index()
    {
        $data1 = Ibu::count();
        $data2 = Anak::count();
        $data3 = DB::table('users')
                ->where('level', 0)->count();
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
        if (Auth::user()->level == 1){
            return view('admin.dashboard', compact('calendar', 'data', 'data1', 'data2', 'data3'));
        } else {
            return view('user.dashboard');
        }
    }
}
