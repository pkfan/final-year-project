<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Buyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BuyerController extends Controller
{
    public function index(Request $request){
        
        $status = 'all';
        if($request->status){
            $status = $request->status;
        }

        // if($request->limit){
        //     dump($request->limit);
        // }

        $buyers = DB::table('buyers')
            // filter results according to orders status
            ->when($request->status && $request->status != 'all', function($query) use($request){
 
                $query->where('buyers.status','=',$request->status);
               
            })
            // filter resutls according to ascending and decending
            ->when(
                $request->sort, 
                function($query) use($request){
                    $query->orderByRaw('buyers.created_at '.$request->sort);
                    $query->orderByRaw('buyers.updated_at '.$request->sort);
                },
                function($query){
                    $query->orderByDesc('buyers.created_at');
                    $query->orderByDesc('buyers.updated_at');
                }
            )
            ->select(
                'buyers.id',
                'buyers.first_name',
                'buyers.last_name',
                'buyers.email',
                'buyers.address',
                'buyers.phone_number',
                'buyers.status',
                'buyers.created_at',
                'buyers.updated_at',
            );

            // filter pagination records limit
            $paginate_items = 25;
            if($request->limit){
                $paginate_items = $request->limit;
            }

            $buyers = $buyers->paginate($paginate_items);

        // dump($orders->firstItem());

        return view('dashboard.roles.admin.buyer', 
            [
                'buyers' => $buyers ,
                'query'=> $request->query(), 
                'status' => $status
            ]
        );
    }

    public function approve($buyer_id){
        $is_upadated = DB::table('buyers')
            ->where('id','=', $buyer_id)
            ->update([
                'status' => 'approved',
            ]);

        if($is_upadated){
            return back()->with('success','Buyer Account has been APPROVED successfully.');
        }
    }

    public function delete($buyer_id){
        $is_upadated = DB::table('buyers')
            ->where('id','=', $buyer_id)
            ->delete();

        if($is_upadated){
            return back()->with('success','Buyer Account has been DELETED successfully.');
        }
    }

    public function getBuyerDetail($buyer_id){
        return Buyer::find($buyer_id);
    }
}
