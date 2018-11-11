<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $data = User::all();
        return view('admin.user.view', compact('data'));
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
        return view('admin.user.edit', compact('data'));
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
}
