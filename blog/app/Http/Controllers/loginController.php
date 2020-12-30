<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\user;

class loginController extends Controller
{
    public function register(){
        return view('register');
    }

    public function registered(Request $req){
        
        $user = new user;

        if($req->password == $req->repassword){

            $user->name = $req->name;
            $user->userName = $req->userName;
            $user->userType = 'farmer';
            $user->email = $req->email;
            $user->DOB = $req->DOB;
            $user->contact = $req->contact;
            $user->image = 'null';
            $user->password = $req->password;
            $user->validity = 'valid';
            if($user->save()){
                return redirect()->route('login');
            }
        }else{
            return redirect()->route('register');
        }
    }

    public function login(){
        return view('login');
    }

    public function verify(Request $req){
        
        $user = user::where('userName', $req->userName)
                    ->where('password', $req->password)
                    ->get();

        
        if(count($user) > 0){
           
            $req->session()->put('userName', $req->userName);
            $req->session()->put('userType', $user[0]['userType']);
            $req->session()->put('userId', $user[0]['userId']);
            
    		return redirect()->route('home');
    	}else{
            $req->session()->flash('error', 'invalid username/password');
    		return redirect()->route('login');
    	}
    }

}
