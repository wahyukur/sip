<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
                'email' => 'email|required',
                'password' => 'required|min:6'
            ]);
        if (Auth::attempt([
            'email' => $request->email,
            'password' =>$request->password
        ])) {
            $user = Auth::user();
            if($user->level == 1){
                return redirect()->route('user.admin');
            }
            return redirect()->route('user.ibu');
        }
        return redirect()->back();
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->back();
    }

    public function getIbu()
    {
        return view('user.dashboard');
    }
}
