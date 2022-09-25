<?php

namespace App\Http\Controllers\Dashboard\Admin;

use Exception;
use App\Models\Shop;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index(Request $request){
        
        $status = 'all';
        if($request->status){
            $status = $request->status;
        }

        // if($request->limit){
        //     dump($request->limit);
        // }

        $products = DB::table('products')
            // filter results according to orders status
            ->when($request->status && $request->status != 'all', function($query) use($request){
 
                $query->where('products.status','=',$request->status);
               
            })
            // filter resutls according to ascending and decending
            ->when(
                $request->sort, 
                function($query) use($request){
                    $query->orderByRaw('products.created_at '.$request->sort);
                    $query->orderByRaw('products.updated_at '.$request->sort);
                },
                function($query){
                    $query->orderByDesc('products.created_at');
                    $query->orderByDesc('products.updated_at');
                }
            )
            ->select(
                'products.id',
                'products.title',
                'products.price',
                'products.type',
                'products.brand',
                'products.stars',
                'products.ratings',
                'products.orders',
                'products.status',
                'products.created_at',
                'products.updated_at',
            );

            // filter pagination records limit
            $paginate_items = 25;
            if($request->limit){
                $paginate_items = $request->limit;
            }

            $products = $products->paginate($paginate_items);

        // dump($orders->firstItem());

        return view('dashboard.roles.admin.product', 
            [
                'products' => $products ,
                'query'=> $request->query(), 
                'status' => $status
            ]
        );
    }

    public function approve($product_id){
        $is_upadated = DB::table('products')
            ->where('id','=', $product_id)
            ->update([
                'status' => 'approved',
            ]);

        if($is_upadated){
            return back()->with('success','Product has been APPROVED successfully.');
        }
    }

    public function cancel($product_id){
        $is_upadated = DB::table('products')
            ->where('id','=', $product_id)
            ->update([
                'status' => 'cancel',
            ]);
        
        if($is_upadated){
            return back()->with('success','Product has been CANCEL successfully.');
        }
    }

}
