<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use App\category;
use App\product;
use App\notification;
use App\productRequest;
use App\productPurchased;
use GuzzleHttp\Client;

class adminController extends Controller
{

    public function home(Request $req){
        $user = user::find($req->session()->get('userId'));
        $products = product::all();
        $notification = productRequest::all();
        $total = 0;
        $totalRequest = 0;
        $purchaseTotal = 0;
        $acceptedRequest = 0;
        $tasks = 0;
        $pendingRequests = 0;


        for($i = 0; $i < count($notification); $i++){
            $totalRequest = $totalRequest + 1;
            if($notification[$i]['approval'] == 'accepted'){
                $total = $total + $notification[$i]['price'];
                $acceptedRequest = $acceptedRequest + 1;
            }
        }

        for($i = 0; $i < count($products); $i++){
            $purchaseTotal = $purchaseTotal + ((float)$products[$i]['price']*(int)$products[$i]['quantity']);
        }

        $tasks = ($acceptedRequest/$totalRequest)*100;
        $pendingRequests = $totalRequest - $acceptedRequest;
      
            return view('user.admin.adminDashboard', $user)->with('total', $total)->with('purchaseTotal', $purchaseTotal)->with('tasks', $tasks)->with('pendingRequests', $pendingRequests);
    }


    public function profile(Request $req){

        $user = user::find($req->session()->get('userId'));

        $userInfo = user::where('userId', $user['userId'])
                    ->get();

        return view('user.admin.profile',$user)->with('userInfo', $userInfo);
    }

    public function profile_edited(Request $req){

        $req->validate([
            'name'=>'required',
            'email'=>'required',
            'DOB'=>'required',
            'contact'=>'required|min:11|max:11',
            
           ]);

        $user = user::find($req->session()->get('userId'));
        $userInfo = user::where('userId', $user['userId'])
                    ->get();

        $user->name = $req->name;
        $user->email = $req->email;
        $user->DOB = $req->DOB;
        $user->contact = $req->contact;

            if($user->save()){
                return back();
            }
    }

    public function seeManagers(Request $req){

        $user = user::find($req->session()->get('userId'));
        $client = new Client();

        $response = $client->request('GET', 'http://localhost:4000/getManagers');
        if ($response->getStatusCode() == 200) {
            $managers = json_decode($response->getBody(), true);
            $manager = json_decode($managers, true);
            return view('user.admin.seeManagers',$user)->with('manager', $manager);
        } else {
            echo "Not get";
        }
    }

    public function seeSellers(Request $req){

        $user = user::find($req->session()->get('userId'));
        $client = new Client();

        $response = $client->request('GET', 'http://localhost:4000/getSellers');
        if ($response->getStatusCode() == 200) {
            $sellers = json_decode($response->getBody(), true);
            $seller = json_decode($sellers, true);
            return view('user.admin.seeSellers',$user)->with('seller', $seller);
        } else {
            echo "Not get";
        }
    }

    public function seeFarmers(Request $req){

        $user = user::find($req->session()->get('userId'));
        $client = new Client();

        $response = $client->request('GET', 'http://localhost:4000/getFarmers');
        if ($response->getStatusCode() == 200) {
            $farmers = json_decode($response->getBody(), true);
            $farmer = json_decode($farmers, true);
            return view('user.admin.seeFarmers',$user)->with('farmer', $farmer);
        } else {
            echo "Not get";
        }
    }

    public function addManager(Request $req){

        $user = user::find($req->session()->get('userId'));

        return view('user.admin.addManager',$user);
    }

    public function addedManager(Request $req){

        $req->validate([
            
            'name'=>'required',
            'userName'=>'required',
            'email'=>'required',
            'DOB'=>'required',
            'contact'=>'required|min:11',
            'password'=>'required',
            'repassword'=>'required',
            
           ]);

        $user = user::find($req->session()->get('userId'));
        $manager = new user;

        if($req->password == $req->password){

            $manager->name = $req->name;
            $manager->userName = $req->userName;
            $manager->userType = 'manager';
            $manager->email = $req->email;
            $manager->DOB = $req->DOB;
            $manager->contact = $req->contact;
            $manager->image = 'null';
            $manager->password = $req->password;
            $manager->validity = 'valid';

            if($manager->save()){
                return redirect()->route('admin_seeManagers');
            }
        }else{           
            return redirect()->route('admin_addManager');
        }
    }

    public function addSeller(Request $req){

        $user = user::find($req->session()->get('userId'));

        return view('user.admin.addSeller',$user);
    }

    public function addedSeller(Request $req){


        $req->validate([
            
            'name'=>'required',
            'userName'=>'required',
            'email'=>'required',
            'DOB'=>'required',
            'contact'=>'required|min:11',
            'password'=>'required',
            'repassword'=>'required',
            
           ]);

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
                return redirect()->route('admin_seeSellers');
            }
        }else{           
            return redirect()->route('admin_addSeller');
        }
    }

    public function addFarmer(Request $req){

        $user = user::find($req->session()->get('userId'));

        return view('user.admin.addFarmer',$user);
    }

    public function addedFarmer(Request $req){

        $req->validate([
            
            'name'=>'required',
            'userName'=>'required',
            'email'=>'required',
            'DOB'=>'required',
            'contact'=>'required|min:11',
            'password'=>'required',
            'repassword'=>'required',
            
           ]);

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
                return redirect()->route('admin_seeFarmers');
            }
        }else{           
            return redirect()->route('admin_addFarmer');
        }
    }

    public function customizeManager(Request $req){

        $user = user::find($req->session()->get('userId'));

        $manager = user::where('userType', 'manager')
                        ->get();

        return view('user.admin.customizeManager',$user)->with('manager', $manager);
    }

    public function customizeSeller(Request $req){

        $user = user::find($req->session()->get('userId'));

        $sellers = user::where('userType', 'seller')
                        ->get();

        return view('user.admin.customizeSeller',$user)->with('seller', $sellers);
    }

    public function editManager(Request $req, $id){

        $user = user::find($req->session()->get('userId'));
        $manager = user::where('userId', $id)->get();

        return view('user.admin.editManager',$user)->with('manager', $manager);
    }

    public function editedManager(Request $req, $id){

        $req->validate([
            
            'name'=>'required',
            'email'=>'required',
            'DOB'=>'required',
            'contact'=>'required|min:11',
           ]);

        $user = user::find($id);

            $user->name = $req->name;
            $user->email = $req->email;
            $user->DOB = $req->DOB;
            $user->contact = $req->contact;

            if($user->save()){
                return redirect()->route('admin_customizeManager');
            }else{           
            return back();
        }
    }

    public function validityManager(Request $req){

        if($req->ajax()){

            $userId = $req->get('userId');

            $user = user::find($userId);

            if($user->validity == 'valid'){
                $user->validity = 'invalid';
                if($user->save()){
                    $data = array(
                        'validity'  => 'Unblock',);
                    echo json_encode($data);
                }
            }else{
                $user->validity = 'valid';
                if($user->save()){
                    $data = array(
                        'validity'  => 'Block',);
                    echo json_encode($data);
                }
            }
        }

    }

    public function deleteManager(Request $req){

        if($req->ajax()){
            
            $userId = $req->get('userId');

            user::find($userId)->delete($userId);

        }
    }

    public function editSeller(Request $req, $id){

        $user = user::find($req->session()->get('userId'));
        $seller = user::where('userId', $id)->get();

        return view('user.admin.editSeller',$user)->with('seller', $seller);
    }

    public function editedSeller(Request $req, $id){

        $req->validate([
            
            'name'=>'required',
            'email'=>'required',
            'DOB'=>'required',
            'contact'=>'required|min:11',
            
           ]);

        $user = user::find($id);

            $user->name = $req->name;
            $user->email = $req->email;
            $user->DOB = $req->DOB;
            $user->contact = $req->contact;

            if($user->save()){
                return redirect()->route('admin_customizeSeller');
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
                        'validity'  => 'Unblock',);
                    echo json_encode($data);
                }
            }else{
                $user->validity = 'valid';
                if($user->save()){
                    $data = array(
                        'validity'  => 'Block',);
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

        return view('user.admin.customizeFarmer',$user)->with('farmer', $farmers);
    }

    public function editFarmer(Request $req, $id){

        $user = user::find($req->session()->get('userId'));
        $farmer = user::where('userId', $id)->get();

        return view('user.admin.editFarmer',$user)->with('farmer', $farmer);
    }

    public function editedFarmer(Request $req, $id){

        $req->validate([
            
            'name'=>'required',
            'email'=>'required',
            'DOB'=>'required',
            'contact'=>'required|min:11',
            
           ]);

        $user = user::find($id);

            $user->name = $req->name;
            $user->email = $req->email;
            $user->DOB = $req->DOB;
            $user->contact = $req->contact;

            if($user->save()){
                return redirect()->route('admin_customizeFarmer');
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
                        'validity'  => 'Unblock',);
                    echo json_encode($data);
                }
            }else{
                $user->validity = 'valid';
                if($user->save()){
                    $data = array(
                        'validity'  => 'Block',);
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

        return view('user.admin.addCategory',$user);
    }

    public function addedCategory(Request $req){

        $req->validate([
            
            'category'=>'required',
            
           ]);

        $category = new category;
        
        $category->catName = $req->category;

        if($category->save()){
            return redirect()->route('admin_seeCategories');
        }
    }

    public function seeCategories(Request $req){

        $user = user::find($req->session()->get('userId'));

        $categories = category::all();

        return view('user.admin.seeCategories',$user)->with('category', $categories);
    }

    public function editCategory(Request $req, $id){

        $user = user::find($req->session()->get('userId'));
        $category = category::where('id', $id)->get();

        return view('user.admin.editCategory',$user)->with('category', $category);
    }

    public function editedCategory(Request $req, $id){

        $category = category::find($id);

        $category->catName = $req->catName;

        if($category->save()){
            return redirect()->route('admin_seeCategories');
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

        return view('user.admin.addProduct',$user)->with('category', $category);
    }

    public function addedProduct(Request $req){

        $req->validate([
            
            'productName'=>'required',
            'category'=>'required',
            'price'=>'integer',
            'quantity'=>'integer',
            'expDate'=>'required',
            'description'=>'required',
            'productImage'=>'required',
            
           ]);

        $product = new product;
        $productPurchased = new productPurchased;
        
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

                $productPurchased->name = $req->productName;
                $productPurchased->category = $req->category;
                $productPurchased->price = $req->price;
                $productPurchased->quantity = $req->quantity;

                if($product->save() && $productPurchased->save()){
                    return redirect()->route('admin_seeProduct');
                }else{
                    echo 'error';
                }
            }
        }else{
            echo 'error';
        }
    }


    public function seeProduct(Request $req){

        $user = user::find($req->session()->get('userId'));

        $products = product::all();

        return view('user.admin.seeProducts',$user)->with('product', $products);
    }

    public function customizeProducts(Request $req){

        $user = user::find($req->session()->get('userId'));

        $products = product::all();

        return view('user.admin.customizeProducts',$user)->with('product', $products);
    }

    public function editProduct(Request $req, $id){

        $user = user::find($req->session()->get('userId'));
        $product = product::where('id', $id)->get();
        $categories = category::all();

        return view('user.admin.editProduct',$user)->with('product', $product)->with('category', $categories);
    }

    public function editedProduct(Request $req, $id){

        $req->validate([
            
            'productName'=>'required',
            'category'=>'required',
            'price'=>'integer',
            'quantity'=>'integer',
            'expDate'=>'required',
            'description'=>'required',
            
           ]);
           
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
                    return redirect()->route('admin_customizeProducts');
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

        return view('user.admin.deleteProduct', $user)->with('product', $product);
   
    }

    public function deletedProduct(Request $req, $id){

            product::find($id)->delete($id);
            return redirect()->route('admin_customizeProducts');
   
    }

    public function checkNotifications(Request $req){

        $user = user::find($req->session()->get('userId'));
        $notifications = productRequest::all();

        return view('user.admin.checkNotifications',$user)->with('notification', $notifications);
    }

    public function salesReport(Request $req){

        $user = user::find($req->session()->get('userId'));

        $productRequest = productRequest::all();

        return view('user.admin.salesReport',$user)->with('productRequest', $productRequest);
    }

    public function purchaseReport(Request $req){

        $user = user::find($req->session()->get('userId'));

        $product = product::all();

        return view('user.admin.purchaseReport',$user)->with('product', $product);
    }

    public function accepted(Request $req){

        if($req->ajax()){
            
            $requestId = $req->get('requestId');

            $notification = productRequest::find($requestId);

            $notification->approval = 'accepted';

            $notification->save();
        
        }
    }

    public function rejected(Request $req){

        if($req->ajax()){
            
            $requestId = $req->get('requestId');

            $notification = productRequest::find($requestId);

            $notification->approval = 'rejected';

            $notification->save();
        
        }
    }

}