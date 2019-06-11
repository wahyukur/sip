<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Agenda;
use App\Timbang;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ReactController extends Controller
{
    public function cobaGet(){
        return response()->json("Hello dari function get");
    }

    public function getID($id){
        $data = DB::table('anaks')
                ->where('id_ibu', $id)
                ->orderBy('id_anak', 'asc')
                ->get();
        $items=[];
        foreach ($data as $datas) {
            date_default_timezone_set('Asia/Jakarta');
            $now = Carbon::now()->format('Y-m-d'); // Tanggal sekarang
            $b_day = Carbon::parse($datas->tgl_lhr); // Tanggal Lahir
            $age = $b_day->diffInMonths($now);  // Menghitung umur
            array_push($items, [
                'id_anak' => $datas->id_anak,
                'nama_anak' => $datas->nama_anak,
                'tgl_lhr' => date('d-m-Y', strtotime($datas->tgl_lhr)),
                'umur' => $age,
                'jenis_kel' => $datas->jenis_kelamin
            ]);
        }

        return response()->json($items);
    }

    public function login(Request $request){
        
        // // Assign input ke variabel baru
        // $email = $request->email;
        // $password = $request->password;

        // $user = Auth::user();
        // // Cek kecocokan username dan password
        // // Jika tidak ada kecocokan, maka kembalikan response error
        // if(!Auth::attempt(['email' => $email, 'password' => $password])){
        //     // response error
        //     return response()->json([
        //         'message' => 'Autentikasi gagal'
        //     ]);
        // }

        // // Update api token
        // $user->api_token = strtolower(str_random(60));
        // $user->save();

        // // Kirim response ke client
        // return response()->json([
        //     'id' => $user->id,
        //     'id_ibu' => $user->id_ibu,
        //     'api_token' => $user->api_token,
        // ]);

        if (Auth::attempt(['email' => $request->email, 'password' =>$request->password])) {
            $expo_token = $request->token;

            $user = Auth::user();
            $user->api_token = strtolower(str_random(60));
            $user->expo_token = $expo_token;
            $user->save();
            return response()->json([
                'success' => true,
                'id' => $user->id,
                'nama' => $user->nama_ibu,
                'email' => $user->email,
                'api_token' => $user->api_token,
                'expo_token' => $user->expo_token
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Login gagal'
            ]);
        }
    }

    public function getBio($id){
        $data1 = DB::table('users')
                ->where('id', $id)
                ->first();
        $data2 = DB::table('users as I')
                ->select('A.id_anak', 'A.nama_anak','A.tempat_lhr','A.tgl_lhr','A.bb_lahir','A.tb_lahir','A.jenis_kelamin','A.anak_ke','A.jenis_persalinan','A.tempat_persalinan','A.dokter','A.NIK_anak')
                ->leftjoin('anaks as A', 'I.id', '=', 'A.id_ibu')
                ->where('I.id', $id)
                ->get();
        return response()->json([
            'dataIbu' => $data1,
            'dataAnak' => $data2
        ]);

        // $user = DB::table('users')
        //         ->where('id', $id)
        //         ->first();
        // $anak = DB::table('anaks')
        //         ->where('id_ibu', $id)
        //         ->get();
        // $arrBio=[];
        // array_push($arrBio, [
        //     'id'           => $user->id,
        //     'nama_ibu'     => $user->nama_ibu,
        //     'nama_suami'   => $user->nama_suami,
        //     'tempat_lahir' => $user->tempat_lahir,
        //     'tgl_lahir'    => $user->tgl_lahir,
        //     'alamat'       => $user->alamat,
        //     'rt'           => $user->rt,
        //     'rw'           => $user->rw,
        //     'kelurahan'    => $user->kelurahan,
        //     'kecamatan'    => $user->kecamatan,
        //     'No_tlp'       => $user->No_tlp,
        //     'agama'        => $user->agama,
        //     'NIK'          => $user->NIK,
        //     'No_KK'        => $user->No_KK,
        //     'No_BPJS'      => $user->No_BPJS,
        //     'gakin'        => $user->gakin,
        //     'anak'         => $anak
        // ]);

        // return response()->json($arrBio);
    }

    public function getTimbang($id){
        // $items=[];
        // $tb = DB::table('timbangs as T')
        //     ->select('T.id_anak','A.nama_anak','A.tgl_lhr','T.id_timbang','T.berat_badan','T.tinggi_badan','T.tgl_timbang','T.status_gizi','T.ket_timbang')
        //     ->leftjoin('anaks as A', 'A.id_anak', '=', 'T.id_anak')
        //     ->where('T.id_anak', $id)
        //     ->orderBy('T.tgl_timbang', 'desc')
        //     ->first();
        // date_default_timezone_set('Asia/Jakarta');
        // $now = Carbon::now()->format('Y-m-d'); // Tanggal sekarang
        // $b_day = Carbon::parse($tb->tgl_lhr); // Tanggal Lahir
        // $age = $b_day->diffInMonths($now);  // Menghitung umur
        // $tgltbg = strtoupper($this->bln_indo(date('Y-m-d', strtotime($tb->tgl_timbang))));
        // array_push($items, [
        //     'id_anak' => $tb->id_anak,
        //     'nama_anak' => $tb->nama_anak,
        //     'tgl_lhr' => date('d-m-Y', strtotime($tb->tgl_lhr)),
        //     'id_timbang' => $tb->id_timbang,
        //     'umur' => $age,
        //     'tgl_timbang' => $tgltbg,
        //     'berat_badan' => $tb->berat_badan,
        //     'tinggi_badan' => $tb->tinggi_badan,
        //     'status_gizi' => $tb->status_gizi,
        //     'ket_timbang' => $tb->ket_timbang
        // ]);

        // return response()->json($items);

        $arrAnak = [];
        $anak = DB::table('anaks')
                ->where('id_anak', $id)
                ->first();

        date_default_timezone_set('Asia/Jakarta');
        $now = Carbon::now()->format('Y-m-d'); // Tanggal sekarang
        $b_day = Carbon::parse($anak->tgl_lhr); // Tanggal Lahir
        $age = $b_day->diffInMonths($now);  // Menghitung umur
        array_push($arrAnak, [
            'id_anak'   => $anak->id_anak,
            'nama_anak' => $anak->nama_anak,
            'tgl_lhr'   => $anak->tgl_lhr,
            'umur'      => $age,
        ]);

        $arrTbg = [];
        $data = DB::table('timbangs')
                ->where('id_anak', $id)
                ->orderBy('id_timbang', 'desc')
                ->get();
        foreach ($data as $datas) {
            array_push($arrTbg, [
                'tgl_timbang' => date('d/m/Y', strtotime($datas->tgl_timbang)),
                'berat_badan' => $datas->berat_badan,
                'tinggi_badan' => $datas->tinggi_badan,
                'status_gizi' => $datas->status_gizi
            ]);
        }

        // Grafik umur 1 - 24 bulan
        $t = DB::table('anaks as A')
                ->leftjoin('timbangs as T', 'A.id_anak', '=', 'T.id_anak')
                ->select('A.id_anak', 'A.nama_anak', 'T.umur', 'T.berat_badan', 'T.tinggi_badan', 'T.tgl_timbang')
                ->where('A.id_anak', $id)
                ->get();
        $grafik = array(61);
        for ($i=0; $i < 61; $i++) { 
            $grafik[$i] = 0;
        }
        $grafik[0] = $anak->bb_lahir;
        foreach ($t as $some) {
            $grafik[$some->umur] = $some->berat_badan;
        }

        return response()->json([
            'dataAnak' => $arrAnak,
            'dataTbg' => $arrTbg,
            'grafik' => $grafik
        ]);
    }

    private function bln_indo($tanggal){
        $bulan = array (
            1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
        );
        $pecahkan = explode('-', $tanggal);
        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }

    public function getDetailTimbang($id){
        $data = DB::table('timbangs')
                ->where('id_anak', $id)
                ->get();

        return response()->json($data);
    }

    public function getImunisasi($id){
        // //Get Imunisasi
        // $getImun = DB::table('imunisasis as I')
        //         ->leftjoin('jenis_imunisasis as J', 'I.id_j_imun', '=', 'J.id_j_imun')
        //         ->where('I.id_anak', $id)
        //         ->get();

        // //Get Jenis Imunisasi
        // $items = [];
        // $data = DB::table('jenis_imunisasis')
        //         ->select('umur')
        //         ->groupBy('umur')
        //         ->get();
        // foreach ($data as $datas) {
        //     $umur = $datas->umur;

        //     $data1 = DB::table('jenis_imunisasis as J')
        //         ->select('J.id_j_imun','I.id_anak','J.nama_imun','J.umur','I.tgl_imun')
        //         ->leftjoin('imunisasis as I', 'J.id_j_imun', '=', 'I.id_j_imun')
        //         ->where('J.umur', $umur)
        //         ->get();

        //     $imun=[];
        //     foreach ($data1 as $datas1) {
        //         array_push($imun, [
        //             'id_anak' => $datas1->id_anak,
        //             'nama_imun' => $datas1->nama_imun
        //         ]);
        //     }
        //     array_push($items, [
        //         'umur' => $umur,
        //         'imun' => $imun
        //     ]);
        // }
        
        // return response()->json($items);

        // $j_imun = DB::table('jenis_imunisasis as J')
        //         ->select('J.id_j_imun','I.id_anak','J.nama_imun','J.umur as umur_imun','I.tgl_imun')
        //         ->leftjoin('imunisasis as I', 'J.id_j_imun', '=', 'I.id_j_imun')
        //         ->where('umur','=',3)
        //         ->get();

        // return response()->json($j_imun);

        //Get Jenis Imunisasi
        $items = [];
        $data = DB::table('jenis_imunisasis')
                ->select('umur')
                ->groupBy('umur')
                ->get();
        foreach ($data as $datas) {
            $umur = $datas->umur;

            $data1 = DB::table('jenis_imunisasis')
                ->where('umur', $umur)
                ->get();

            $imun=[];
            foreach ($data1 as $datas1) {
                $id_jenis=$datas1->id_j_imun;
                $result=0;
                $cek = DB::table('imunisasis')
                        ->orderBy('id_j_imun', 'asc')
                        ->where('id_anak', $id)
                        ->get();
                foreach ($cek as $ceks) {
                    if ($id_jenis == $ceks->id_j_imun) {
                        $result = 1;
                    }
                }

                array_push($imun, [
                    'id-j-imun' => $datas1->id_j_imun,
                    'nama_imun' => $datas1->nama_imun,
                    'indikasi' => $result
                ]);
            }
            array_push($items, [
                'umur' => $umur,
                'imun' => $imun
            ]);
        }

        return response()->json($items);
    }

    public function getVitA($id){
        $vitA=[];
        $data = DB::table('vit_as as V')
                ->leftjoin('anaks as A', 'V.id_anak', '=', 'A.id_anak')
                ->where('V.id_anak', $id)
                ->get();
        foreach ($data as $datas) {
            date_default_timezone_set('Asia/Jakarta');
            $tgl = Carbon::parse($datas->tgl_vitA); // Tanggal sekarang
            $b_day = Carbon::parse($datas->tgl_lhr); // Tanggal Lahir
            $age = $b_day->diffInMonths($tgl);  // Menghitung umur

            if ($datas->keterangan == 'Vitamin A Biru') {
                $ket = '0';
            } elseif ($datas->keterangan == 'Vitamin A Merah') {
                $ket = '1';
            } else {
                $ket = null;
            }

            array_push($vitA, [
                'umur' => $age,
                'tgl_vitA' => date('d-m-Y', strtotime($datas->tgl_vitA)),
                'ket' => $ket
            ]);
        }
        return response()->json($vitA);
    }

    public function getAgenda(){
        $items = [];
        date_default_timezone_set('Asia/Jakarta');
        $date = Carbon::now()->format('Y-m-d');
        $agenda = Agenda::where('start', '>', $date)->get();
        foreach ($agenda as $jadwal) {
            $tanggal = date('Y-m-d', strtotime($jadwal->start));

            if (!isset($items[$tanggal])) {
                $items[$tanggal] = [];
                array_push($items[$tanggal], [
                    'name' => $jadwal->kegiatan,
                    'height' => 50,
                    'place' => $jadwal->tempat
                ]);
            } else {
                array_push($items[$tanggal], [
                    'name' => $jadwal->kegiatan,
                    'height' => 50,
                    'place' => $jadwal->tempat
                ]);
            }
        }
        return response()->json($items);
    }

    public function postProfile(Request $request, $id){
        $oldPassword = $request->oldPassword;
        $newPassword = $request->newPassword;
        $confirmPassword = $request->confirmPassword;

        $data = User::find($id);
        if (Hash::check($oldPassword, $data->password)) {
            if ($newPassword != $confirmPassword) {
                return response()->json([
                    'success' => false,
                    'message' => 'Password Baru Tidak Sama'
                ]);
            } else {
                $user = User::find($id);
                $user->password = bcrypt($newPassword);
                $user->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Update Berhasil'
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Password Lama Salah'
            ]);
        }
    }
}