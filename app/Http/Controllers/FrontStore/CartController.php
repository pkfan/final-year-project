<?php

namespace App\Http\Controllers\FrontStore;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    function index(){

        // $products = DB::table('products')
        //     ->join('comments', function($join){
        //             $join->on('products.id','=', 'comments.product_id');                    
        //     })
        //     ->join('product_images', function($join){
        //         $join->on('products.id','=', 'product_images.product_id');                    
        //     })
        //     ->join('carts', function($join){
        //         $join->on('products.id','=', 'carts.product_id');                    
        //     })
        //     ->selectRaw('products.id, 
        //                 products.title,
        //                 products.type,
        //                 products.brand,
        //                 product_images.image_1,
        //                 AVG(comments.product_rating) as stars, 
        //                 COUNT(comments.product_id) as ratings'
        //     )
        //     ->where('carts.buyer_id','=', auth()->guard('buyer')->user()->id)
        //     ->groupBy(
        //         'products.id',
        //         'products.title',
        //         'products.type',
        //         'products.brand',
        //         'product_images.image_1',
        //     )
        //     ->orderByRaw('carts.added_on DESC')
        //     ->get();


         /*****************************
         * I have just change this query because of performance
         */
         
        $products = DB::table('products')
            ->join('product_images', function($join){
                $join->on('products.id','=', 'product_images.product_id');                    
            })
            ->join('carts', function($join){
                $join->on('products.id','=', 'carts.product_id');                    
            })
            ->selectRaw('products.id, 
                        products.title,
                        products.type,
                        products.brand,
                        product_images.image_1,
                        stars, 
                        ratings'
            )
            ->where('carts.buyer_id','=', auth()->guard('buyer')->user()->id)
            ->orderByRaw('carts.added_on DESC')
            ->get();


        $categoryList = $this->getCategoryList();
        return view('Store.pages.cartPage',[
            'products' => $products,
            'categoryList' =>  $categoryList,
            'title'=>'Cart Page',
            'search_query' => '',
        ]);

    }


    function addOrDeleteItemToBuyerCart(Request $request){
        $request->validate([
            'buyer_id' => 'required',
            'product_id' => 'required',
        ]);
       
        $checkIfAlreadyInBuyerCart = DB::table('carts')
            ->where('buyer_id','=', $request->buyer_id)
            ->where('product_id','=', $request->product_id)
            ->first();

        if($checkIfAlreadyInBuyerCart){
            DB::table('carts')
            ->where('buyer_id','=', $request->buyer_id)
            ->where('product_id','=', $request->product_id)
            ->delete();

            return 'deletedFromCart';
        }
        else{
            DB::table('carts')->insert([
                'buyer_id' => $request->buyer_id,
                'product_id' => $request->product_id,
                'added_on' => Carbon::now(),
            ]);
    
            return 'addedTocart';
        }
    }

    public function getCategoryList(){
        return Category::select('id','name')->get();
    }
}
