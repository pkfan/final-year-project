<?php

namespace App\Http\Controllers\Dashboard\Supplier;

use Exception;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ShopController extends Controller
{
    public function index(){

        $shop = Shop::where('supplier_id','=',auth()->guard('supplier')->user()->id)
                    ->first();
        
        return view('dashboard.roles.supplier.shop',['shop'=>$shop]);
    }

    public function updateInformation(Request $request){
        
        $validation = [
            "shopName" => ["required","min:4","max:200"],
            "shopAddress" => ["required","min:4","max:200"],
            "shopState" => ["required","min:4","max:50"],
            "shopCity" => ["required","min:4","max:50"],
            "shopDescription" => ["required","min:4","max:1000"],
            
        ];

        $profileImageFromFrontend =  $request->file('shop_image');

        // validate image type if image is attached with request
        if($profileImageFromFrontend){
            $validation['shop_image' ] = 'required|mimes:jpg,jpeg,png,svg,webp,gif';
        }

        $request->validate($validation);



        $imageNameForDatabase = null;

        if($profileImageFromFrontend){

            $nameGenerate = hexdec(uniqid());
            $imgageExtension = strtolower($profileImageFromFrontend->getClientOriginalExtension());
            $NewNameForImage = $nameGenerate.'.'.$imgageExtension;
            $upLocation = 'assets/images/shop/';
            $profileImageFromFrontend->move($upLocation,$NewNameForImage);
            $imageNameForDatabase = $upLocation.$NewNameForImage;

            // delete image from folder storage
            try{
                $old_image = Shop::where('supplier_id','=',auth()->guard('supplier')->user()->id)
                                    ->first();

                if(!(str_contains($old_image, 'shop_default.webp') || str_contains($old_image, 'FakeImages'))){
                    File::delete($old_image->shop_image);
                }
            }
            catch(Exception $e){
                // pass if exception occur without errors
                // this exception occurs because of fakeImage path in database
            }
            

        }

        $shopFields = [
            'name' => $request->shopName,
            'address' => $request->shopAddress,
            'state' => $request->shopState,
            'city' => $request->shopCity,
            'description' => $request->shopDescription,
            'supplier_id' => auth()->guard('supplier')->user()->id,
        ];

        if($imageNameForDatabase){
            $shopFields['shop_image'] = $imageNameForDatabase;
            
        }


        // updating buyer fields from database
        $isUpdated = Shop::where('id','=', auth()->guard('supplier')->user()->id)
            ->update($shopFields);

        if($isUpdated){
            return back()->with('success','Shop Detail has been updated.');
        }
    }
}
