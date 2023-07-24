<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{
	public function logout(){
		Auth::logout();
		return redirect('/');
	}

	public function dashboard($controllerName){
		if(empty($controllerName)) return view('dashboard');
		return view('dashboard',array('page'=>$controllerName));
	}
}
