<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;

class homeController extends Controller
{

    public function home(Request $req){

        $user = user::find($req->session()->get('userId'));

        if($req->session()->get('userType') == 'manager'){
            return view('manager.home', $user);
        }
        else if($req->session()->get('userType') == 'farmer'){
            return view('landing');
        }else{
            return redirect()->route('login');
        }
    }
}
