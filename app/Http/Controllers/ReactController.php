<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class ReactController extends Controller
{
    public function cobaGet(){
        return response()->json("Hello dari function get");
    }

    public function login(Request $request){
        
        // Assign input ke variabel baru
        // $email = $request->email;
        // $password = $request->password;

        // $user = Auth::user();
        // Cek kecocokan username dan password
        // Jika tidak ada kecocokan, maka kembalikan response error
        // if(!Auth::attempt(['email' => $email, 'password' => $password])){
            // response error
        //     return response()->json([
        //         'message' => 'Autentikasi gagal'
        //     ]);
        // }

        // Update api token
        // $user->api_token = strtolower(str_random(60));
        // $user->save();

        // Kirim response ke client
        // return response()->json([
        //     'id' => $user->id,
        //     'id_ibu' => $user->id_ibu,
        //     'api_token' => $user->api_token,
        // ]);

        if (Auth::attempt([
                'email' => $request->email,
                'password' =>$request->password
            ])) {
            $user = Auth::user();
            if($user->level == 1){
                return response()->json([
                    'success' => false,
                    'message' => 'Autentikasi gagal'
                ]);
            } else {
                $user->api_token = strtolower(str_random(60));
                $user->save();
                return response()->json([
                    'success' => true,
                    'id' => $user->id,
                    'id_ibu' => $user->id_ibu,
                    'api_token' => $user->api_token,
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Autentikasi gagal'
            ]);
        }
    }

    public function getBio($id){
        $data = DB::table('ibus as I')
                ->leftjoin('anaks as A', 'I.id_ibu', '=', 'A.id_ibu')
                ->where('I.id_ibu', $id)
                ->first();
        return response()->json($data);
    }
}
