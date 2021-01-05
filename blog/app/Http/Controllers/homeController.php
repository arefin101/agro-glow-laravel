<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use App\category;
use App\product;
use App\notification;

class homeController extends Controller
{

    public function home(Request $req){

        $user = user::find($req->session()->get('userId'));
        $products = product::all();

        if($req->session()->get('userType') == 'admin'){
            return redirect()->route('admin');
        }
        else if($req->session()->get('userType') == 'manager'){
            return view('user.home', $user);
        }
        else if($req->session()->get('userType') == 'farmer'){
            return view('landingFarmer', $user)->with('product', $products)->with('user', 'user');
        }else{
            return redirect()->route('login');
        }
    }

    public function seeSellers(Request $req){

        $user = user::find($req->session()->get('userId'));

        $sellers = user::where('userType', 'seller')
                    ->get();

        return view('user.seeSellers',$user)->with('seller', $sellers);
    }

    public function seeFarmers(Request $req){

        $user = user::find($req->session()->get('userId'));

        $farmers = user::where('userType', 'farmer')
                    ->get();

        return view('user.seeFarmers',$user)->with('farmer', $farmers);
    }

   

    public function addSeller(Request $req){

        $user = user::find($req->session()->get('userId'));

        return view('user.addSeller',$user);
    }

    public function addedSeller(Request $req){

        $user = user::find($req->session()->get('userId'));
        $seller = new user;

        if($req->password == $req->password){

            $seller->name = $req->name;
            $seller->userName = $req->userName;
            $seller->userType = 'Seller';
            $seller->email = $req->email;
            $seller->DOB = $req->DOB;
            $seller->contact = $req->contact;
            $seller->image = 'null';
            $seller->password = $req->password;
            $seller->validity = 'valid';

            if($seller->save()){
                return redirect()->route('seeSellers');
            }
        }else{           
            return redirect()->route('addSeller');
        }
    }

    public function addFarmer(Request $req){

        $user = user::find($req->session()->get('userId'));

        return view('user.addFarmer',$user);
    }

    public function addedFarmer(Request $req){

        $user = user::find($req->session()->get('userId'));
        $farmer = new user;

        if($req->password == $req->password){

            $farmer->name = $req->name;
            $farmer->userName = $req->userName;
            $farmer->userType = 'farmer';
            $farmer->email = $req->email;
            $farmer->DOB = $req->DOB;
            $farmer->contact = $req->contact;
            $farmer->image = 'null';
            $farmer->password = $req->password;
            $farmer->validity = 'valid';

            if($farmer->save()){
                return redirect()->route('seeFarmers');
            }
        }else{           
            return redirect()->route('addFarmer');
        }
    }

   

    public function customizeSeller(Request $req){

        $user = user::find($req->session()->get('userId'));

        $sellers = user::where('userType', 'seller')
                        ->get();

        return view('user.customizeSeller',$user)->with('seller', $sellers);
    }

    public function editSeller(Request $req, $id){

        $user = user::find($req->session()->get('userId'));
        $seller = user::where('userId', $id)->get();

        return view('user.editSeller',$user)->with('seller', $seller);
    }

    public function editedSeller(Request $req, $id){

        $user = user::find($id);

            $user->name = $req->name;
            $user->email = $req->email;
            $user->DOB = $req->DOB;
            $user->contact = $req->contact;

            if($user->save()){
                return redirect()->route('customizeSeller');
            }else{           
            return back();
        }
    }

    public function validitySeller(Request $req){

        if($req->ajax()){

            $userId = $req->get('userId');

            $user = user::find($userId);

            if($user->validity == 'valid'){
                $user->validity = 'invalid';
                if($user->save()){
                    $data = array(
                        'validity'  => 'Unblock',
                       );
                    echo json_encode($data);
                }
            }else{
                $user->validity = 'valid';
                if($user->save()){
                    $data = array(
                        'validity'  => 'Block',
                       );
                    echo json_encode($data);
                }
            }
        }

    }

    public function deleteSeller(Request $req){

        if($req->ajax()){
            
            $userId = $req->get('userId');

            user::find($userId)->delete($userId);

        }
   
    }

    public function customizeFarmer(Request $req){

        $user = user::find($req->session()->get('userId'));

        $farmers = user::where('userType', 'farmer')
                        ->get();

        return view('user.customizeFarmer',$user)->with('farmer', $farmers);
    }

    public function editFarmer(Request $req, $id){

        $user = user::find($req->session()->get('userId'));
        $farmer = user::where('userId', $id)->get();

        return view('user.editFarmer',$user)->with('farmer', $farmer);
    }

    public function editedFarmer(Request $req, $id){

        $user = user::find($id);

            $user->name = $req->name;
            $user->email = $req->email;
            $user->DOB = $req->DOB;
            $user->contact = $req->contact;

            if($user->save()){
                return redirect()->route('customizeFarmer');
            }else{           
            return back();
            }
    }

    public function validityFarmer(Request $req){

        if($req->ajax()){

            $userId = $req->get('userId');

            $user = user::find($userId);

            if($user->validity == 'valid'){
                $user->validity = 'invalid';
                if($user->save()){
                    $data = array(
                        'validity'  => 'Unblock',
                       );
                    echo json_encode($data);
                }
            }else{
                $user->validity = 'valid';
                if($user->save()){
                    $data = array(
                        'validity'  => 'Block',
                       );
                    echo json_encode($data);
                }
            }
        }

    }

    public function deleteFarmer(Request $req){

        if($req->ajax()){
            
            $userId = $req->get('userId');

            user::find($userId)->delete($userId);

        }
   
    }

    public function addCategory(Request $req){

        $user = user::find($req->session()->get('userId'));

        return view('user.addCategory',$user);
    }

    public function addedCategory(Request $req){

        $category = new category;
        
        $category->catName = $req->category;

        if($category->save()){
            return redirect()->route('seeCategories');
        }
    }

    public function seeCategories(Request $req){

        $user = user::find($req->session()->get('userId'));

        $categories = category::all();

        return view('user.seeCategories',$user)->with('category', $categories);
    }

    public function editCategory(Request $req, $id){

        $user = user::find($req->session()->get('userId'));
        $category = category::where('id', $id)->get();

        return view('user.editCategory',$user)->with('category', $category);
    }

    public function editedCategory(Request $req, $id){

        $category = category::find($id);

            $category->catName = $req->catName;

            if($category->save()){
                return redirect()->route('seeCategories');
            }else{           
            return back();
            }
    }

    public function deletedCategory(Request $req){

        if($req->ajax()){
            
            $id = $req->get('id');

            category::find($id)->delete($id);

        }
   
    }

    public function addProduct(Request $req){

        $user = user::find($req->session()->get('userId'));
        $category = category::all();

        return view('user.addProduct',$user)->with('category', $category);
    }

    public function addedProduct(Request $req){

        $product = new product;
        
        if($req->hasFile('productImage')){
            
            $file = $req->file('productImage');

            if($file->move('upload', $file->getClientOriginalName())){
               
                $product->productName = $req->productName;
                $product->category = $req->category;
                $product->price = $req->price;
                $product->quantity = $req->quantity;
                $product->expDate = $req->expDate;
                $product->description = $req->description;
                $product->imageURL = $file->getClientOriginalName();

                if($product->save()){
                    return back();
                }else{
                    echo 'error';
                }
            }
        }else{
            echo 'error';
        }
    }

    public function customizeProducts(Request $req){

        $user = user::find($req->session()->get('userId'));

        $products = product::all();

        return view('user.customizeProducts',$user)->with('product', $products);
    }

    public function editProduct(Request $req, $id){

        $user = user::find($req->session()->get('userId'));
        $product = product::where('id', $id)->get();
        $categories = category::all();

        return view('user.editProduct',$user)->with('product', $product)->with('category', $categories);
    }

    public function editedProduct(Request $req, $id){

        $product = product::find($id);
        
        if($req->hasFile('productImage')){
            
            $file = $req->file('productImage');

            if($file->move('upload', $file->getClientOriginalName())){
               
                $product->productName = $req->productName;
                $product->description = $req->description;
                $product->category = $req->category;
                $product->expDate = $req->expDate;
                $product->quantity = $req->quantity;
                $product->price = $req->price;
                $product->imageURL = $file->getClientOriginalName();

                if($product->save()){
                    return redirect()->route('customizeProducts');
                }else{
                    return back();
                }
            }
        }else{
            return back();
        }
    }

    public function deleteProduct(Request $req, $id){

        $user = user::find($req->session()->get('userId'));
        $product = product::find($id);

        return view('user.deleteProduct', $user)->with('product', $product);
   
    }

    public function deletedProduct(Request $req, $id){

            product::find($id)->delete($id);
            return redirect()->route('customizeProducts');
   
    }

    public function checkNotifications(Request $req){

        $user = user::find($req->session()->get('userId'));
        $notifications = notification::all();

        return view('user.checkNotifications',$user)->with('notification', $notifications);
    }

    public function accepted(Request $req){

        if($req->ajax()){
            
            $requestId = $req->get('requestId');

            $notification = notification::find($requestId);

            $notification->approval = 'accepted';

            $notification->save();
        
        }
    }

    public function rejected(Request $req){

        if($req->ajax()){
            
            $requestId = $req->get('requestId');

            $notification = notification::find($requestId);

            $notification->approval = 'rejected';

            $notification->save();
        
        }
    }

}