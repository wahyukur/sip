<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Calendar;
use App\Agenda;
use App\Galeri;
use App\Album;
use Illuminate\Support\Facades\File;
use DB;

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

    // Album COntroller /////////////////
    public function albumList(){
        $data = Album::all();
        return view('admin.galeri.viewAlbum', compact('data'));
    }

    public function albumStore(Request $request){
        $data             = new Album;
        $data->nama_album = $request->get('nama_album');
        $data->ket_album  = $request->get('ket_album');
        $data->save();

        return redirect()->route('albumList')->with(['success' => 'Data Berhasil Di Tambah']);
    }

    public function albumDetail($id){
        $data = DB::table('albums as A')
                ->leftjoin('galeris as G', 'A.id_album', '=', 'G.album_id')
                ->where('id_album', $id)
                ->get();
        $data1 = Album::where('id_album', $id)->first();
        return view('admin.galeri.view', compact('data', 'data1'));
    }

    public function albumDelete($id){
        $data = Album::where('id_album', $id)->first();
        $data->delete();

        return redirect()->route('albumList')->with(['success' => 'Data Berhasil Di Hapus']);
    }
    // Album Controller //////////////////

    // Image COntroller /////////////////
    // public function viewImage(){
    //     $data = Galeri::all();
    //     return view('admin.galeri.view', compact('data'));
    // }

    public function addImage($id){
        $data = Album::where('id_album', $id)->first();
        return view('admin.galeri.create', compact('data'));
    }

    public function storeImage(Request $request) {
        $album_id = $request->get('album_id');
        $data = new Galeri;
        $data->album_id = $album_id;
        $data->title = $request->get('title');
        $data->description = $request->get('description');

        // if ($request->hasFile('image')) {
        //     $dir = 'uploads/';
        //     $extension = strtolower($request->file('image')->getClientOriginalExtension()); // get image extension
        //     $fileName = str_random() . '.' . $extension; // rename image
        //     $request->file('image')->move($dir, $fileName);
        //     $data->image = $fileName;
        // }

        $file       = $request->file('image')->getClientOriginalName();
        $filename   = str_random(10).$file;
        $destination = base_path() . '/public/uploads';
        $request->file('image')->move($destination, $filename);
        $data->image = 'uploads/'.$filename;

        // $fileName = $request->file('image')->getClientOriginalName(); // get image extension
        // $request->file('image')->move("dist/img/upload/", $fileName);
        // $data->image = $fileName;

        $data->save();
        return redirect()->route('albumDetail', $album_id)->with(['success' => 'Data Berhasil Di Tambah']);
    }

    public function deleteImage($id){
        $data = Galeri::where('id', $id)->first();
        $data->delete();

        return redirect()->route('albumDetail', $id)->with(['success' => 'Data Berhasil Di Hapus']);
    }
    // Image COntroller /////////////////
}
