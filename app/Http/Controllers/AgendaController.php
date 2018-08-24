<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Calendar;
use App\Agenda;

class AgendaController extends Controller
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
                        'url' => route('agenda.show', $value->id_agenda),
                    ]
                );
            }
        }
        $calendar = Calendar::addEvents($agendas);
        return view('admin.agenda.view', compact('calendar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $data             = new Agenda;
        $data->kegiatan   = $request->get('kegiatan');
        $data->tempat     = $request->get('tempat');
        $data->start      = $request->get('start');
        $data->end        = $request->get('end');
        $data->color      = $request->get('color');
        $data->keterangan = $request->get('keterangan');
        $data->save();

        return redirect()->route('agenda.index')->with(['success' => 'Data Berhasil Di Tambah']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Agenda::where('id_agenda', $id)->first();
        return view('admin.agenda.detail', compact('data'));
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
        $data = Agenda::where('id_agenda', $id)->first();
        $data->kegiatan   = $request->get('kegiatan');
        $data->tempat     = $request->get('tempat');
        $data->start      = $request->get('start');
        $data->end        = $request->get('end');
        $data->color      = $request->get('color');
        $data->keterangan = $request->get('keterangan');
        $data->save();

        return redirect()->route('agenda.index')->with(['success' => 'Data Berhasil Di Update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Agenda::where('id_agenda', $id)->first();
        $data->delete();

        return redirect()->route('agenda.index')->with(['success' => 'Data Berhasil Di Hapus']);
    }
}
