<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Mail;
use App\User;

class AuthController extends Controller
{
    public function getLogin() {
        return view('auth.login');
    }

    public function postLogin(Request $req) {
        if ($req->email == null or $req->password == null) {
            return redirect()->back()->with(['error' => 'Masukkan Email atau Password !']);
        } else {
            if (Auth::attempt([ 'email' => $req->email, 'password' => $req->password ])) {
                $user = Auth::user();
                if($user->level == 1){
                    return redirect()->route('admin');
                } else {
                    return redirect()->route('user');
                }
            } else {
                return redirect()->back()->with(['error' => 'Login Gagal !']);
            }
        }
    }

    public function resetPassword() {
        return view('auth.passwords.emailPassword');
    }

    public function postReset(Request $request){
        $email = $request->email;

        $data = DB::table('users')
                ->where('email', $email)
                ->get();

        if (count($data) > 1) {
            return redirect()->route('resetPassword')->with('error', 'Email Ganda');
        } elseif (count($data) == 0) {
            return redirect()->route('resetPassword')->with('error', 'Email belum terdaftar');
        } else {
            foreach ($data as $datas) {
                if ($datas->email == $email) {
                    $pswd = rand(100000,999999);

                    $user = User::where('id', $datas->id)->first();
                    $user->password = bcrypt($pswd);
                    $user->save();

                    $to_name = $datas->nama_ibu;
                    $to_email = $email;

                    $data = [
                        'name' => $to_name,
                        'pswd' => $pswd
                    ];
                        
                    Mail::send('auth.passwords.mail', $data, function($message) use ($to_name, $to_email) {
                        $message->to($to_email, $to_name)
                                ->subject('Reset Password');
                        $message->from('posyandumandiri@gmail.com','SIPosyandu Mandiri');
                    });

                    return redirect()->route('resetPassword')->with('success', 'Cek Email untuk Password');
                } else {
                    return redirect()->route('resetPassword')->with('error', 'Email belum terdaftar');
                }
            }
        }
    }
}
