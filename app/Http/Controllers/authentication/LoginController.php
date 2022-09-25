<?php

namespace App\Http\Controllers\authentication;

use App\Models\User;
use App\Models\Admin;
use App\Models\Buyer;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function loginPage(){
        if(auth()->guard('buyer')->check()){
            return "buyer already logged, so redirect to his profile";
            // return redirect()->route('user.profile')->with('NormalUserLoggedIn','You are already logged in as Normal User!');
        }
        else if(auth()->guard('supplier')->check()){
            // return redirect()->route('admin.profile')->with('AdminLoggedIn','You are already logged in as Admin!');
            return "supplier already logged in, so redirect to his profile";
        }
        else if(auth()->guard('admin')->check()){
            // return redirect()->route('admin.profile')->with('AdminLoggedIn','You are already logged in as Admin!');
            return "admin already logged in, so redirect to his profile";
        }
        else{
            return view('authentication.loginPage',['title'=>'Login Page']);
        }
    }

    public function login(Request $request){

        
        $request->validate(
            [
                "email" => ["required","min:6","max:50"],
                "password" => ["required","min:4","max:30"],
                "role" => ['required']
            ],
        );

        // checking that user is (normal user) or (admin user)
        if($request->input('role') == 'buyer'){
            $buyer = Buyer::where('email','=',$request->email)
                ->where('password','=', $request->password)
                ->first();  

            // if email or password are incorrect
            if(!$buyer){
                return back()->with('localError', 'EMAIL or PASSWORD are not valid.');
            }


            auth()->guard("buyer")->login($buyer);

            // if current product id which buyer currntly want after login
            $product_id = (integer) $request->redirectProductIdforBuyerAfterLogin;
            if($product_id != -1 && $product_id > 0){
                return redirect()
                        ->route('productPage',['product_id'=>$product_id])
                        ->with('success','Your are logged in successfully.');
            }
            else{
                if(auth()->guard('buyer')->check()){
                    return redirect()->route('homePage')->with('success','Buyer has logged in successfully.');
                }
                else{
                    return "<h1>user registration error during creation in database<h1>";
                }
            }

        }
        else if($request->input('role') == 'supplier'){
            $supplier = Supplier::where('email','=',$request->email)
                ->where('password','=', $request->password)
                ->first();  
            // if email or password are incorrect
            if(!$supplier){
                return back()->with('localError', 'EMAIL or PASSWORD are not valid.');
            }
            auth()->guard("supplier")->login($supplier);
            // return auth()->guard('buyer')->user;
            return redirect()->route('supplier.dashboard');
        }

        else if($request->input('role') == 'admin'){
            $admin = Admin::where('email','=',$request->email)
                ->where('password','=', $request->password)
                ->first();  
            // if email or password are incorrect
            if(!$admin){
                // return ('admin doesntExist now.....');
                return back()->with('localError', 'EMAIL or PASSWORD are not valid.');

            }

            auth()->guard("admin")->login($admin);

            // return auth()->guard('buyer')->user;
            return redirect()->route('admin.dashboard');

        }
    }

    public function logout(){
        auth()->logout();
    }
}
