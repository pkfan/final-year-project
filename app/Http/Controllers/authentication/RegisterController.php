<?php

namespace App\Http\Controllers\authentication;

use App\Models\Shop;
use App\Models\User;
use App\Models\Buyer;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function registerPage(){
        if(auth()->guard('buyer')->check()){
            return "user already logged, so redirect to his profile";
            // return redirect()->route('user.profile')->with('NormalUserLoggedIn','You are already logged in as Normal User!');
        }
        else if(auth()->guard('supplier')->check()){
            // return redirect()->route('admin.profile')->with('AdminLoggedIn','You are already logged in as Admin!');
            return "supplier already logged in, so redirect to his profile";
        }
        else{
            return view('authentication.registerPage',['title'=>'Register Page']);
        }
    }
    // Normal users registration method
    public function register(Request $request){
        // $request->validate(
        //     [
        //         "firstName" => ["required","min:4","max:30"],
        //         "lastName" => ["required","min:4","max:30"],
        //         "email" => ["required","unique:users","min:6","max:50"],
        //         "password" => ["required","min:4","max:30"],
        //     ],
        //     [
        //         'email.unique'=> 'This Email Account Already Exist in Electronic PORTAL',
        //     ]
        // );

        if($request->input('role') == 'buyer'){
            $request->validate(
                [
                    "firstName" => ["required","min:4","max:30"],
                    "lastName" => ["required","min:4","max:30"],
                    "email" => ["required","unique:buyers","min:6","max:50"],
                    "password" => ["required","min:4","max:30"],
                    "address" => ["required","min:20","max:200"],
                    "phone" => ["required","min:11","max:11"],
                ],
                [
                    'email.unique'=> 'This Email Account Already Exist in Electronic PORTAL',
                ]
            );


            $buyer = Buyer::create([
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
                'email' => $request->email,
                'password' => $request->password,
                'address' => $request->address,
                'phone_number' => $request->phone,
                'status' => 'pending',
                'profile_image' => 'assets/images/profile_default.png',
            ]);


            if($buyer){
                auth()->guard("buyer")->login($buyer);
                return redirect()->route('homePage')->with('success','Buyer has been registered successfully.');
            }
            else{
                return "<h1>user registration error during creation in database<h1>";
            }

        }
        else if($request->input('role') == 'supplier'){
            $request->validate(
                [
                    "firstName" => ["required","min:4","max:30"],
                    "lastName" => ["required","min:4","max:30"],
                    "email" => ["required","unique:suppliers","min:6","max:50"],
                    "password" => ["required","min:4","max:30"],
                    "address" => ["required","min:20","max:200"],
                    "phone" => ["required","min:11","max:11"],
                    "shopName" => ["required","min:4","max:200"],
                    "shopAddress" => ["required","min:4","max:300"],
                    "shopState" => ["required","min:4","max:80"],
                    "shopCity" => ["required","min:4","max:80"],
                ],
                [
                    'email.unique'=> 'This Email Account Already Exist in Electronic PORTAL',
                ]
            );


            $supplier = Supplier::create([
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
                'email' => $request->email,
                'password' => $request->password,
                'address' => $request->address,
                'phone_number' => $request->phone,
                'status' => 'pending',
                'profile_image' => 'assets/images/profile_default.png',
            ]);

            $shop = $supplier->shop()->create([
                'name' => $request->shopName,
                'address' => $request->shopAddress,
                'state' => $request->shopState,
                'city' => $request->shopCity,
                'shop_image' => 'assets/images/shop_default.webp',
            ]);

            // dump($supplier);
            // dump($shop);
            if($supplier && $shop){
                auth()->guard("supplier")->login($supplier);
                return redirect()->route('supplier.dashboard')->with('success','Supplier has been registered successfully.');
            }
            else{
                return "<h1>user registration error during creation in database<h1>";
            }

        }


    }
}
