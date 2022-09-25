<?php

namespace App\Http\Controllers\FrontStore;

use Carbon\Carbon;
use App\Models\Buyer;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    function index($product_id){
        $product = DB::table('products')
            ->join('product_images', function($join){
                $join->on('products.id','=', 'product_images.product_id');                    
            })
            ->selectRaw('products.id, 
                        products.title,
                        products.type,
                        products.brand,
                        product_images.image_1,
                        stars, 
                        ratings'
            )
            ->where('products.id','=',$product_id)
            ->first();
            
           $buyer_id = auth()->guard('buyer')->user()->id;
           $buyer = DB::table('buyers')
                ->select(
                    'id',
                    'first_name',
                    'last_name',
                    'email',
                    'address',
                    'phone_number',
                    'status',
                    'profile_image'
                )
                ->where('buyers.id','=', $buyer_id)
                ->first();

                // dump($buyer);

        $categoryList = $this->getCategoryList();
        return view('Store.pages.orderPage',[
            'product' => $product,
            'buyer' => $buyer,
            'categoryList' =>  $categoryList,
            'title'=>'Order Page',
            'search_query' => '',
        ]);

    }

    public function placeOrder(Request $request){
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required',
            'order_shipping_address' => 'required|min:10|max:300',
        ]);


        // if buyer acount status is in pending state then he/she  cannot place orders
        if(auth()->guard('buyer')->user()->status == 'pending'){
            return back()->with(
                'error',
                'You cannot place order because your acount status is pending. please wait for 3 or 4 working days to approve it.'
            );
        }


        // insert orders into orders table
        $order = DB::table('orders')->insert([
            'shipping_address' =>  $request->order_shipping_address,
            'description' => $request->order_description,
            'order_date' => Carbon::now(),
            'quantity' => $request->quantity,
            'status' => 'pending',
            'buyer_id' => auth()->guard('buyer')->user()->id,
            'product_id' => $request->product_id,
            
        ]);


        /********************************
         * update orders of this product of products table. 
         */

        $totalOrders = DB::table('orders')
        ->where('product_id','=', $request->product_id)
        ->selectRaw('COUNT(product_id) as total_orders')
        ->get()
        ->first();

        // i think this is slow but good idea to update product when someone place orders
        DB::table('products')
            ->where('id','=', $request->product_id)
            ->update([
                'orders' =>  $totalOrders->total_orders,
        ]);


        
       if($order){
        //    return back()->with('success',"Your order has been placed. We'll review it soon and deliver to your home.");
           return redirect()
                    ->route('productPage',['product_id'=>$request->product_id])
                    ->with('success',"Your order has been placed. We'll review it soon and deliver to your home.");
       }
       else{
           return "<h1>Something wrong while inserting data into orders table [OrderController: placeOrder()]</h1>";
       }

    }

    public function getCategoryList(){
        return Category::select('id','name')->get();
    }
}
