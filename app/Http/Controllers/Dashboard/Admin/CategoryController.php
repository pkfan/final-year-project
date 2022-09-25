<?php

namespace App\Http\Controllers\Dashboard\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(){
        $categories = DB::table('categories')
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('dashboard.roles.admin.category',['categories' => $categories]);
    }

    public function delete($category_id){
        $is_deleted = DB::table('categories')
            ->where('id','=',$category_id)
            ->delete();

        if($is_deleted){
            return back()->with('success','Category has been deleted Successfully.');
        }
    }

    public function create(Request $request){
        $request->validate([
            'category_name' => 'required|min:3|max:25',
        ]);

        $is_created = DB::table('categories')
            ->insert([
                'name' =>$request->category_name,
                'admin_id' => auth()->guard('admin')->user()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        if($is_created){
            return back()->with('success','Category has been CREATED successfully.');
        }
    }
}
