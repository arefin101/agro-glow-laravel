<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\user;
use App\category;
use App\product;
use App\notification;
use App\productRequest;
use GuzzleHttp\Client;
use PDF;

class sellerController extends Controller
{

    public function downloadPDF() {
        
        $show = productRequest::all();

        $pdf = PDF::loadView('user.pdf', compact('show'));
        
        return $pdf->download('productRequest.pdf');
    }

    public function home(Request $req){

        $user = user::find($req->session()->get('userId'));
        $products = product::all();
        $notification = productRequest::all();
        $total = 0;
        $totalRequest = 0;
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

        //$tasks = ($acceptedRequest/$totalRequest)*100;
        $pendingRequests = $totalRequest - $acceptedRequest;

        if($req->session()->get('userType') == 'manager'){
            return view('user.home', $user)->with('total', $total)->with('tasks', $tasks)->with('pendingRequests', $pendingRequests);
        }
        else if($req->session()->get('userType') == 'seller'){
            return view('user.seller.homeSeller', $user);
        }else if($req->session()->get('userType') == 'farmer'){
            return view('landingFarmer', $user)->with('product', $products)->with('user', 'user');
        }else{
            return redirect()->route('login');
        }
    }

    public function profile(Request $req){

        $user = user::find($req->session()->get('userId'));

        $userInfo = user::where('userId', $user['userId'])
                    ->get();

        return view('seller.profile',$user)->with('userInfo', $userInfo);
    }

    public function profile_edited(Request $req){

        $req->validate([
            'name'=>'required',
            'email'=>'required',
            'DOB'=>'required',
            'contact'=>'required|min:11',
            
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

        $response = $client->request('GET', 'http://localhost:5000/getSellers');
        if ($response->getStatusCode() == 200) {
            $sellers = json_decode($response->getBody(), true);
            $seller = json_decode($sellers, true);
            return view('user.seller.seeSellers',$user)->with('seller', $seller);
        } else {
            echo "Not get";
        }

        // $user = user::find($req->session()->get('userId'));

        // $sellers = user::where('userType', 'seller')
        //             ->get();

        // return view('user.seeSellers',$user)->with('seller', $sellers);
    }

    public function seeSellers(Request $req){

        $user = user::find($req->session()->get('userId'));
        $client = new Client();

        $response = $client->request('GET', 'http://localhost:5000/getSellers');
        if ($response->getStatusCode() == 200) {
            $sellers = json_decode($response->getBody(), true);
            $seller = json_decode($sellers, true);
            return view('user.seller.seeSellers',$user)->with('seller', $seller);
        } else {
            echo "Not get";
        }

        // $user = user::find($req->session()->get('userId'));

        // $sellers = user::where('userType', 'seller')
        //             ->get();

        // return view('user.seeSellers',$user)->with('seller', $sellers);
    }

    public function seeFarmers(Request $req){

        $user = user::find($req->session()->get('userId'));
        $client = new Client();

        $response = $client->request('GET', 'http://localhost:5000/getFarmers');
        if ($response->getStatusCode() == 200) {
            $farmers = json_decode($response->getBody(), true);
            $farmer = json_decode($farmers, true);
            return view('user.seller.seeFarmers',$user)->with('farmer', $farmer);
        } else {
            echo "Not get";
        }

        // $user = user::find($req->session()->get('userId'));

        // $farmers = user::where('userType', 'farmer')
        //             ->get();

        // return view('user.seeFarmers',$user)->with('farmer', $farmers);
    }

    public function addSeller(Request $req){

        $user = user::find($req->session()->get('userId'));

        return view('user.addSeller',$user);
        //return back();
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
                return redirect()->route('customizeSeller');
            }
        }else{           
            return redirect()->route('addSeller');
        }
    }

    public function addFarmer(Request $req){

        $user = user::find($req->session()->get('userId'));

        return view('user.seller.addFarmer',$user);
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
                return redirect()->route('customizeFarmers');
            }
        }else{           
            return redirect()->route('addFarmer');
        }
    }

    public function customizeSeller(Request $req){

        $user = user::find($req->session()->get('userId'));

        $sellers = user::where('userType', 'seller')
                        ->get();

        return view('user.seller.customizeSeller',$user)->with('seller', $sellers);
    }

    public function editSeller(Request $req, $id){

        $user = user::find($req->session()->get('userId'));
        $seller = user::where('userId', $id)->get();

        return view('user.seller.editSeller',$user)->with('seller', $seller);
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

        return view('user.seller.customizeFarmer',$user)->with('farmer', $farmers);
    }

    public function editFarmer(Request $req, $id){

        $user = user::find($req->session()->get('userId'));
        $farmer = user::where('userId', $id)->get();

        return view('user.seller.editFarmer',$user)->with('farmer', $farmer);
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

        return view('user.seller.addCategory',$user);
    }

    public function addedCategory(Request $req){

        $req->validate([
            
            'name'=>'required',
            
           ]);

        $category = new category;
        
        $category->catName = $req->category;

        if($category->save()){
            return redirect()->route('seeCategories');
        }
    }

    public function seeCategories(Request $req){

        $user = user::find($req->session()->get('userId'));

        $categories = category::all();

        return view('user.seller.seeCategories',$user)->with('category', $categories);
    }

    public function editCategory(Request $req, $id){

        $user = user::find($req->session()->get('userId'));
        $category = category::where('id', $id)->get();

        return view('user.seller.editCategory',$user)->with('category', $category);
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

        return view('user.seller.addProduct',$user)->with('category', $category);
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

        return view('user.seller.customizeProducts',$user)->with('product', $products);
    }

    public function editProduct(Request $req, $id){
        
        $user = user::find($req->session()->get('userId'));
        $product = product::where('id', $id)->get();
        $categories = category::all();

        return view('user.seller.editProduct',$user)->with('product', $product)->with('category', $categories);
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
        
        
        $product->productName = $req->productName;
        $product->description = $req->description;
        $product->category = $req->category;
        $product->expDate = $req->expDate;
        $product->quantity = $req->quantity;
        $product->price = $req->price;

        if($product->save()){
            return redirect()->route('customizeProducts');
        }else{
            return back();
        }


    }

    public function deleteProduct(Request $req, $id){

        $user = user::find($req->session()->get('userId'));
        $product = product::find($id);

        return view('user.seller.deleteProduct', $user)->with('product', $product);
   
    }

    public function deletedProduct(Request $req, $id){

            product::find($id)->delete($id);
            return redirect()->route('customizeProducts');
   
    }

    public function checkNotifications(Request $req){

        $user = user::find($req->session()->get('userId'));
        $notifications = productRequest::all();

        return view('user.seller.checkNotifications',$user)->with('notification', $notifications);
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