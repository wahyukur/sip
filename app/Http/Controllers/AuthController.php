<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function getLogin() {
    	return view('auth.login');
    }

    public function postLogin(Request $req) {
    	$this->validate($req, [
    			'email' => 'email|required',
    			'password' => 'required|min:6'
    		]);

    	if (Auth::attempt([
    	    	'email' => $req->email,
    	    	'password' =>$req->password
    	    ])) {
			$user = Auth::user();
			if($user->level == 1){
				return redirect()->route('admin');
			}
			return redirect()->route('user');
    	}
    	return redirect()->back();
    }
}
