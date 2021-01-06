<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\user;
use App\product;
use Laravel\Socialite\Facades\Socialite;

class loginController extends Controller
{
    
    public function register(){
        return view('register');
    }

    public function registered(Request $req){
        
        $req->validate([
            
            'name'=>'required',
            'userName'=>'required',
            'email'=>'required',
            'DOB'=>'required',
            'contact'=>'required|min:11',
            'password'=>'required',
            'repassword'=>'required',
            
           ]);


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

        $req->validate([
            
            'userName'=>'required',
            'password'=>'required',
            
           ]);
        
        $user = user::where('userName', $req->userName)
                    ->where('password', $req->password)
                    ->get();

        
        if(count($user) > 0){
           
            $req->session()->put('userName', $req->userName);
            $req->session()->put('userType', $user[0]['userType']);
            $req->session()->put('userId', $user[0]['userId']);
            $req->session()->put('validity', $user[0]['validity']);
            
    		return redirect()->route('home');
    	}else{
            $req->session()->flash('error', 'invalid username/password');
    		return redirect()->route('login');
    	}
    }

     /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function googleRedirect()
    {
        $socialUser = Socialite::driver('google')->stateless()->user();

        $finduser = user::where('email', $socialUser->email)->first();
                
        dd($socialUser);
        if($finduser ){
            return view('landingFarmer', $finduser);
        }
        else{
            $user = new user;

            $user->name = $socialUser->name;
            $user->userName = $socialUser->name;
            $user->userType = 'farmer';
            $user->email = $socialUser->email;
            $user->DOB = '';
            $user->contact = '';
            $user->image = 'null';
            $user->password = '1234';
            $user->validity = 'valid';

            if($user->save()){
                return redirect()->route('login');
            }
        }
       
    
    }
}
