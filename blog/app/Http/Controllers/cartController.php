<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use App\product;
use App\productRequest;

class cartController extends Controller
{
    
    public function addCart(Request $req, $productId){

        $user = user::find($req->session()->get('userId'));
        $product = product::find($productId);

        return view('user.addCart')->with('product', $product)->with('user', $user);

    }

    public function addedCart(Request $req, $productId){

        $user = user::find($req->session()->get('userId'));
        $product = product::find($productId);
        $productRequest = new productRequest;

        $productRequest->user = $user->userName;
        $productRequest->category = $req->catName;
        $productRequest->productName = $product->productName;
        $productRequest->quantity = $req->quantity;
        $productRequest->approval = 'pending';
        $productRequest->price = $product->price;

        $productRequest->save();

        return view('user.addCart')->with('product', $product)->with('user', $user);

    }
}
