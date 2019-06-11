<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class PenggunaController extends Controller
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
                ->where('user', '=', 1)
                ->orderBy('level', 'desc')
                ->get();
        return view('admin.user.view', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $data = User::select('id', 'nama_ibu', 'nama_suami')->get();
        $data = DB::table('users')
                ->where('user', '=', 0)
                ->get();
        return view('admin.user.create', compact('data'));
    }

    public function store(Request $request)
    {
        // menerima data request
        $pswd = rand(100000,999999);
        $id = $request->get('id');
        $data = User::where('id', $id)->first();
        $data->email    = $request->get('email');
        $data->password = bcrypt($pswd);
        $data->level    = $request->get('level');
        $data->user     = 1;
        $data->save();

        return redirect()->route('pengguna.index')->with([
            'pswd' => $pswd
        ]);
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
        $data2 = User::select('id', 'nama_ibu', 'nama_suami')->get();
        return view('admin.user.edit', compact('data', 'data2'));
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
        $data->name     = $request->get('name');
        $data->email   = $request->get('email');
        $data->level = $request->get('level');
        $data->save();

        return redirect()->route('pengguna.index')->with('success', 'Data Berhasil Diupdate');
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
        return redirect()->route('pengguna.index')->with('success', 'Data Berhasil Dihapus');
    }

    public function profile($id)
    {
        $data = User::where('id', $id)->first();
        return view('admin.user.detail', compact('data'));
    }

    public function generatePwd($id)
    {
        $pswd = rand(1000,9999);
        $data = User::where('id', $id)->first();
        $data->password = bcrypt($pswd);
        $data->save();

        return redirect()->route('pengguna.index')->with([
            'pswd' => $pswd
        ]);
    }
}
