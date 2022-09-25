<?php

namespace App\Http\Controllers\Dashboard\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index(Request $request){
        
        $status = 'all';
        if($request->status){
            $status = $request->status;
        }

        // if($request->limit){
        //     dump($request->limit);
        // }

        $suppliers = DB::table('suppliers')
            // filter results according to orders status
            ->when($request->status && $request->status != 'all', function($query) use($request){
 
                $query->where('suppliers.status','=',$request->status);
               
            })
            // filter resutls according to ascending and decending
            ->when(
                $request->sort, 
                function($query) use($request){
                    $query->orderByRaw('suppliers.created_at '.$request->sort);
                    $query->orderByRaw('suppliers.updated_at '.$request->sort);
                },
                function($query){
                    $query->orderByDesc('suppliers.created_at');
                    $query->orderByDesc('suppliers.updated_at');
                }
            )
            ->select(
                'suppliers.id',
                'suppliers.first_name',
                'suppliers.last_name',
                'suppliers.email',
                'suppliers.address',
                'suppliers.phone_number',
                'suppliers.status',
                'suppliers.created_at',
                'suppliers.updated_at',
            );

            // filter pagination records limit
            $paginate_items = 25;
            if($request->limit){
                $paginate_items = $request->limit;
            }

            $suppliers = $suppliers->paginate($paginate_items);

        // dump($orders->firstItem());

        return view('dashboard.roles.admin.supplier', 
            [
                'suppliers' => $suppliers ,
                'query'=> $request->query(), 
                'status' => $status
            ]
        );
    }

    public function approve($supplier_id){
        $is_upadated = DB::table('suppliers')
            ->where('id','=', $supplier_id)
            ->update([
                'status' => 'approved',
            ]);

        if($is_upadated){
            return back()->with('success','Supplier Account has been APPROVED successfully.');
        }
    }

    public function delete($supplier_id){
        $is_upadated = DB::table('suppliers')
            ->where('id','=', $supplier_id)
            ->delete();

        if($is_upadated){
            return back()->with('success','Supplier Account has been DELETED successfully.');
        }
    }

    public function getSupplierDetail($supplier_id){
        return Supplier::find($supplier_id);
    }
}
