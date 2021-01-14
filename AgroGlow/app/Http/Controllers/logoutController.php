<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;

class logoutController extends Controller
{
    
    public function destroy(Request $req){
        
        $products = product::all();

        if($req->session()->get('userType') == 'farmer'){
            $req->session()->flush();
            return view('landing')->with('product', $products);
        }else{
            $req->session()->flush();
            return redirect()->route('login');
        }
    }
}
