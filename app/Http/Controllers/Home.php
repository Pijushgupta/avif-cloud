<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Home extends Controller
{
	/**
	 * loading the home page with login form
	 *
	 * @return view
	 */
	public function index(){
		if(Auth::check()){
			return redirect('/dashboard');
		}
		return view('Login');
	}

    /**
     * @param $request
     * @return redirect()
     */
	public function handleLogin($request){
		$request->validate([
			'email' => 'required|email',
			'password'=>'required'
		]);

		$email = strip_tags(trim($request->email));
		$password = strip_tags(trim($request->email));

		if(Auth::attempt(array('email'=>$email,'password'=>$password))){

			return redirect('/dashboard');
		}
		return redirect('/');

	}

    /**
     * @return view()
     */
	public function register(){
		return view('Register');
	}

	/**
	 * registration form handling
	 *
	 * @param [type] $request
	 * @return void
	 */
	public function handleRegistration($request){


		//validation
		$request->validate([
			'fname' => 'required',
			'email' => 'required|email',
			'password' => 'required|min:12|confirmed'
		]);


        /**
         * Adding new user to database
         */
		User::create([
			'name' =>  strip_tags(trim($request->lname ? $request->fname . ' ' . $request->lname : $request->fname)),
			'email' => strip_tags(trim($request->email)),
			'password' => Hash::make(strip_tags(trim($request->email))),
		]);

        return redirect('/login');
	}

}
