<?php

namespace App\Http\Controllers\Dashboard\Supplier;

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
            ->join('suppliers',function($join){
                $join->on('products.supplier_id','=','suppliers.id');
            })
            ->where('suppliers.id','=',auth()->guard('supplier')->user()->id)

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

        return view('dashboard.roles.supplier.product', 
            [
                'products' => $products ,
                'query'=> $request->query(), 
                'status' => $status
            ]
        );
    }



    public function createPage(){

        $categories = DB::table('categories')
            ->select('id','name')
            ->get();

        return view('dashboard.roles.supplier.product_create',['categories'=>$categories]);

    }

    public function create(Request $request){

        ////////////////// validation start ///////////////
        $validation = [
            "title" => ["required","min:4","max:100"],
            "description" => ["required","min:30","max:10000"],
            "price" => ["required","min:1","max:8"],
            "type" => ["required","min:2","max:30"],
            "brand" => ["required","min:2","max:30"],
            "category_id" => ["required","min:1","max:30"],
            "image_1" => 'required|mimes:jpg,jpeg,png,svg,webp,gif',
            "image_2" => 'required|mimes:jpg,jpeg,png,svg,webp,gif',
            "image_3" => 'required|mimes:jpg,jpeg,png,svg,webp,gif',
            "image_4" => 'required|mimes:jpg,jpeg,png,svg,webp,gif',

        ];


        $request->validate($validation);
        ////////////////// validation end ///////////////


        ////////////////// update products details ///////////////
        // updating product from products table
        $product = Product::create([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'type' => $request->type,
                'brand' => $request->brand,
                'category_id' => $request->category_id,
                'supplier_id' => auth()->guard('supplier')->user()->id,
                'shop_id' => (  
                                Shop::select('id')
                                    ->where('supplier_id','=', auth()->guard('supplier')->user()->id)
                                    ->first()
                            )->id,
                'status' => 'pending',
                'stars' => 0,
                'ratings' => 0,
                'orders' => 0,
            ]);

        // dump($product);


        ////////////////// create products images ///////////////
            $product_images_fields = [];

            for($i = 1; $i <= 4; $i++){
                // dump('image_'.$i);
                $productImageFromFrontend = $request->file('image_'.$i);
                if($productImageFromFrontend){

                    $nameGenerate = hexdec(uniqid());
                    $imgageExtension = strtolower($productImageFromFrontend->getClientOriginalExtension());
                    $NewNameForImage = $nameGenerate.'.'.$imgageExtension;
                    $upLocation = 'assets/images/products/';
                    $productImageFromFrontend->move($upLocation,$NewNameForImage);
                    $imageNameForDatabase = $upLocation.$NewNameForImage;

                    // image feilds for product_images database
                    $product_images_fields = array_merge(['image_'.$i => $imageNameForDatabase], $product_images_fields);
                }
            }

            $product_images = $product->productImages()->create($product_images_fields);

            if($product && $product_images){
                return redirect()->route('supplier.dashboard.product')
                        ->with('success','New Product has been posted. Please wait for 1 and 2 working days for approving it.');
            }
           
            
    }

    public function editPage($product_id){

        $product = DB::table('products')
            ->join('product_images',function($join){
                $join->on('products.id','=','product_images.product_id');
            })
            ->where('products.id','=',$product_id)
            ->first();
        // dump($product);

        $categories = DB::table('categories')
            ->select('id','name')
            ->get();

        return view('dashboard.roles.supplier.product_edit',['product' => $product, 'categories'=>$categories]);

    }

    public function edit(Request $request){

        ////////////////// validation start ///////////////
        $validation = [
            "title" => ["required","min:4","max:100"],
            "description" => ["required","min:4","max:10000"],
            "price" => ["required","min:1","max:8"],
            "type" => ["required","min:2","max:30"],
            "brand" => ["required","min:2","max:30"],
            "category_id" => ["required","min:1","max:30"],

        ];

         // updating 4 images of products
         for($i = 1; $i <= 4; $i++){
            // dump('image_'.$i);
            if($request->file('image_'.$i)){
                $validation['image_'.$i] = 'required|mimes:jpg,jpeg,png,svg,webp,gif';

            }
        }

        $request->validate($validation);
        ////////////////// validation end ///////////////


        ////////////////// update products details ///////////////
        // updating product from products table
        $is_product_updated = DB::table('products')
            ->where('products.id','=',$request->product_id)
            ->update([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'type' => $request->type,
                'brand' => $request->brand,
                'category_id' => $request->category_id,
                'updated_at' => now(),
            ]);


        ////////////////// update products images ///////////////
        $product_images = DB::table('product_images')
                ->where('product_id','=',$request->product_id)
                ->first();
            // dump((array) $product_images);
        $product_images = (array) $product_images;

            // updating 4 images of products
            $product_images_fields = [];

            for($i = 1; $i <= 4; $i++){
                // dump('image_'.$i);
                $productImageFromFrontend = $request->file('image_'.$i);
                if($productImageFromFrontend){

                    $nameGenerate = hexdec(uniqid());
                    $imgageExtension = strtolower($productImageFromFrontend->getClientOriginalExtension());
                    $NewNameForImage = $nameGenerate.'.'.$imgageExtension;
                    $upLocation = 'assets/images/products/';
                    $productImageFromFrontend->move($upLocation,$NewNameForImage);
                    $imageNameForDatabase = $upLocation.$NewNameForImage;

                    // image feilds for product_images database
                    $product_images_fields = array_merge(['image_'.$i => $imageNameForDatabase], $product_images_fields);
        
                    // delete image from folder storage
                    try{
                        if(!(str_contains($product_images['image_'.$i], 'FakeImages'))){
                            // unlink($product_images->('image_'.$i));
                            // unlink($imageNameForDatabase);
                            File::delete($product_images['image_'.$i]);
                        }
                    }
                    catch(Exception $e){
                        // pass if exception occur without errors
                        // this exception occurs because of fakeImage path in database
                    }
                }
            }

            $is_images_updated = null;
            // if there are not in image then do nothing to update
            if($product_images_fields){
                // updating images in database
                $is_images_updated = DB::table('product_images')
                    ->where('product_id','=',$request->product_id)
                    ->update($product_images_fields);
            }
            
            if($is_product_updated){
                return back()->with('success','Product Details has been updated successfully.');
            }
    }

    public function delete($product_id){

        $is_deleted = DB::table('products')
            ->where('products.id','=',$product_id)
            ->delete();

        if($is_deleted){
            return back()->with('success','Product has been deleted successfully.');
        }
    }
}
