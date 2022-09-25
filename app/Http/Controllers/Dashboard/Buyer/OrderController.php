<?php

namespace App\Http\Controllers\Dashboard\Buyer;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class OrderController extends Controller
{
    public function index(Request $request){
        
        $status = 'all';
        if($request->status){
            $status = $request->status;
        }

        // if($request->limit){
        //     dump($request->limit);
        // }

        $orders = DB::table('orders')
            ->join('products',function($join){
                $join->on('orders.product_id','=','products.id');
            })
            ->where('buyer_id','=',auth()->guard()->user()->id)

            // filter results according to orders status
            ->when($request->status && $request->status != 'all', function($query) use($request){
               if($request->status == 'cancel'){
                    $query->wherein('orders.status', ['cancelByBuyer', 'cancelBySupplier']);
 
               }else{

                   $query->where('orders.status','=',$request->status);
               }
               
            })
            // filter resutls according to ascending and decending
            ->when(
                $request->sort, 
                function($query) use($request){
                    $query->orderByRaw('orders.order_date '.$request->sort);
                },
                function($query){
                    $query->orderByDesc('orders.order_date');
                }
            )
            ->select(
                'products.id as product_id',
                'products.title',
                'products.price',

                'orders.id as order_id',
                'orders.quantity',
                'orders.order_date',
                'orders.status',
            );

            // filter pagination records limit
            $paginate_items = 25;
            if($request->limit){
                $paginate_items = $request->limit;
            }

            $orders = $orders->paginate($paginate_items);

        // dump($orders->firstItem());

        return view('dashboard.roles.buyer.order', 
            [
                'orders' => $orders ,
                'query'=> $request->query(), 
                'status' => $status
            ]
        );
    }

    public function cancel($order_id){
       $is_updated = Order::where('id','=', $order_id)
            ->update([
                'status' => 'cancelByBuyer',
            ]);

        if($is_updated){
            return back()->with('success','Your order has been canceled successfully.');
        }
    }

    public function markAsCompleted($order_id){
        $is_updated = Order::where('id','=', $order_id)
             ->update([
                 'status' => 'completed',
             ]);
 
         if($is_updated){
             return back()->with('success','Now your order considered as COMPLETED from buyer and you recieved it successfully.');
         }
     }
}
