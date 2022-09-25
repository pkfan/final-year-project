<?php

namespace App\Http\Controllers\FrontStore;

use App\Models\Comment;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home(){
        
        /*****************************
         * get those products which has
         * high ratings 
         * choose only 7 products for hero slider
         * 
         ******************************/

         /****************
          * USING 17 RAM AND 300 MILI SECOND MEMORY WITH QUERY BUILDER USING JOIN
          * 
          * BUT WHEN I HAVE AGAIN INSERT 100,000 COMMENTS RECORD INTO TABLE
          * THEN THIS APPLICATION FAIL OR DOWN DUE TO HIGH MEMORY USAGE OF RAM AND CPU
          * I THINK THIS IS MAIN REASON
          */

        // $products = DB::table('products')
        //     ->join('comments', function($join){
        //             $join->on('products.id','=', 'comments.product_id');                    
        //     })
        //     ->join('product_images', function($join){
        //         $join->on('products.id','=', 'product_images.product_id');                    
        //     })
        //     ->join('categories', function($join){
        //         $join->on('products.category_id','=', 'categories.id');                    
        //     })
        //     ->selectRaw('products.id,
        //                 products.title,
        //                 products.description,
        //                 products.price,
        //                 products.type,
        //                 products.brand,
        //                 product_images.image_1, 
        //                 categories.name as category, 
        //                 AVG(comments.product_rating) as stars, 
        //                 COUNT(comments.product_id) as ratings'
        //     )
        //     ->where('products.status','=','approved')
        //     ->groupBy('products.id',
        //             'products.title',
        //             'products.description',
        //             'products.price',
        //             'products.type',
        //             'products.brand',
        //             'product_images.image_1',
        //             'categories.name'
        //     )
        //     ->where('products.status','=','approved')
        //     ->orderByRaw('stars DESC')
        //     ->orderByRaw('ratings DESC');
        
        // $products = $products->limit(7);
        // $products = $products->get();
        
        /*****************************
         * I have just change this query because of performance
         */

         /******** 
          * this query also failed and taking 9 seconds due to 
          * join() operations of database with 5000 products
          
          */
        // $products = DB::table('products')
        //     ->join('product_images', function($join){
        //         $join->on('products.id','=', 'product_images.product_id');                    
        //     })
        //     ->join('categories', function($join){
        //         $join->on('products.category_id','=', 'categories.id');                    
        //     })
        //     ->selectRaw('products.id,
        //                 products.title,
        //                 products.description,
        //                 products.price,
        //                 products.type,
        //                 products.brand,
        //                 product_images.image_1, 
        //                 categories.name as category, 
        //                 stars, 
        //                 ratings'
        //     )
        //     ->where('products.status','=','approved')
        //     ->orderByDesc('stars')
        //     ->orderByDesc('ratings');

    
        // $products = $products->limit(7);
        // $products = $products->get();


        /*************************
         * i am using subjoin to increase performance
         * this query takes only 1 second 
         * because of subjoin() operations
         * as compare to join() which takes 9 seconds
         */


        $products = DB::table('products')
            ->selectRaw('products.id,
                        products.title,
                        products.description,
                        products.price,
                        products.type,
                        products.brand,
                        stars, 
                        ratings,
                        category_id'
            )
            ->where('products.status','=','approved')
            ->orderByDesc('stars')
            ->orderByDesc('ratings');

        $products = $products->limit(7);

        $products = DB::table('product_images')
            ->joinSub($products, 'products',function($join){
                $join->on('products.id','=', 'product_images.product_id');
            })
            ->select('products.*', 'product_images.image_1');

        $products = DB::table('categories')
            ->joinSub($products, 'products',function($join){
                $join->on('products.category_id','=', 'categories.id');
            })
            ->select('products.*', 'categories.name as category');


        $products = $products->get();

        $sliderProducts = [];

        foreach($products as $product){
            $product = (array) $product;
            $productImageArray = ['effect_image'=>'FakeImages/effect/' . strval(mt_rand(1,13)) . '.webp'];
            $productWithEffect = array_merge($product, $productImageArray);
            array_push($sliderProducts,$productWithEffect);
        }

        // dump($products);


        $categoryList = $this->getCategoryList();

        return view('Store.pages.homePage',[
            'heroSliderProducts'=>$sliderProducts, 
            'featuredProducts'=>$this->featuredProducts(),
            'newArrivalProducts' => $this->newArrivalProducts(),
            'categoryList' =>  $categoryList,
            'title'=>'Home Page',
            'search_query' => '',
        ]);
    

    }

    public function tabCategoryProducts($category_id){
        /*****************************
         * SEARCH PRODUCTS WITH CATEGORY ID
         * AND SELECT ONLY THOSE WHICH HAS HIGH RATINGS AND STARS
         * CHOOSE ONLY 9 PRODUCS FOR EACH INCOMMING CATEGORY ID
         * 
         ******************************/

         /****************
          * USING 18 RAM AND 350 MILI SECOND MEMORY WITH QUERY BUILDER USING JOIN
          * BUT WHEN I HAVE AGAIN INSERT 100,000 COMMENTS RECORD INTO TABLE
          * THEN THIS APPLICATION FAIL OR DOWN DUE TO HIGH MEMORY USAGE OF RAM AND CPU
          * I THINK THIS IS MAIN REASON
          */

        // $products = DB::table('products')
        //     ->join('comments', function($join){
        //         $join->on('products.id','=', 'comments.product_id');                    
        //     })
        //     ->join('product_images', function($join){
        //         $join->on('products.id','=', 'product_images.product_id');                    
        //     })
        //     ->selectRaw(
        //         'products.id,
        //         products.title,
        //         products.description,
        //         products.price,
        //         products.type,
        //         products.brand, 
        //         product_images.image_1, 
        //         AVG(comments.product_rating) as stars, 
        //         COUNT(comments.product_id) as ratings'
        //     )
        //     ->where('products.status','=','approved')
        //     ->where('products.category_id','=',$category_id)
        //     ->groupBy(
        //         'products.id',
        //         'products.title',
        //         'products.description',
        //         'products.price',
        //         'products.type',
        //         'products.brand',
        //         'product_images.image_1',
        //         )
        //     ->where('products.status','=','approved')
        //     ->orderByRaw('ratings, stars DESC');

        // $products = $products->limit(9);
        // $products = $products->get();

        // dump($products);

        /*****************************
         * I have just change this query because of performance
         */

        $products = DB::table('products')
            ->selectRaw(
                'products.id,
                products.title,
                products.description,
                products.price,
                products.type,
                products.brand, 
                stars, 
                ratings'
            )
            ->where('products.status','=','approved')
            ->where('products.category_id','=',$category_id)
            ->orderByDesc('stars')
            ->orderByDesc('ratings');

        $products = $products->limit(9);

        $products = DB::table('product_images')
            ->joinSub($products, 'products',function($join){
                $join->on('products.id','=', 'product_images.product_id');
            })
            ->select('products.*', 'product_images.image_1');

        $products = $products->get();

        // dump($products);

        return $products;
    }


    public function featuredProducts(){
        /*****************************
         * SELECT PRODUCTS WITH
         * HIGH ORDERS
         * HIGH RATINGS
         * CHOOSE ONLY 9 PRODUCS
         * 
         ******************************/

         /****************
          * USING 18 RAM AND 450 MILI SECOND MEMORY WITH QUERY BUILDER USING sub JOIN
          * 
          * BUT WHEN I HAVE AGAIN INSERT 100,000 COMMENTS RECORD INTO TABLE
          * THEN THIS APPLICATION FAIL OR DOWN DUE TO HIGH MEMORY USAGE OF RAM AND CPU
          * I THINK THIS IS MAIN REASON
          */

        //select total orders with producs IDs
        // $orders = DB::table('orders')
        //     ->join('products', function($join){
        //         $join->on('orders.product_id','=', 'products.id');                    
        //     })
        //     ->selectRaw(
        //         'products.id as product_id, 
        //         COUNT(orders.product_id) as total_orders'
                
        //     )
        //     ->groupBy(
        //         'products.id',
        //     );

        // //getting ratings of (orders wit product)
        // $ratings = DB::table('comments')
        //     ->joinSub($orders, 'product_orders', function ($join) {
        //         $join->on('comments.product_id', '=', 'product_orders.product_id');
        //     })
        //     ->select(
        //         'comments.product_id',
        //         'comments.product_rating',
        //         'product_orders.total_orders'
        //     );

        // //products with high stars and orders 
        // $products = DB::table('products')
        //     ->joinSub($ratings, 'product_orders_ratings', function ($join) {
        //         $join->on('products.id', '=', 'product_orders_ratings.product_id');
        //     })
        //     ->selectRaw(
        //         'products.id,
        //          products.title,
        //          products.description,
        //          products.price,
        //          product_orders_ratings.total_orders,
        //          AVG(product_orders_ratings.product_rating) as stars,
        //          COUNT(product_orders_ratings.product_id) as ratings'
        //     )
        //     ->groupBy(
        //         'products.id',
        //         'products.title',
        //          'products.description',
        //          'products.price',
        //          'product_orders_ratings.total_orders'
        //     )
        //     ->orderByDesc('stars','product_orders_ratings.total_orders');

        // // attach 1 image and choose only 9 products with high star and orders
        // $productWithImage = DB::table('product_images')
        //     ->joinSub($products, 'product_with_image', function ($join) {
        //         $join->on('product_images.product_id', '=', 'product_with_image.id');
        //     })
        //     ->select('product_with_image.*','product_images.image_1');

        //     $productWithImage = $productWithImage->limit(9)->get();
        
        // // dump($productWithImage);

        // return $productWithImage;

        /*****************************
         * I have just change this query because of performance
         */

        $products = DB::table('products')
            ->selectRaw(
                'products.id,
                products.title,
                products.description,
                products.price,
                stars,
                ratings'
            )
            ->where('products.status','=','approved')
            ->orderByDesc('stars')
            ->orderByDesc('orders');

        $products = $products->limit(9);

        $products = DB::table('product_images')
            ->joinSub($products, 'products',function($join){
                $join->on('products.id','=', 'product_images.product_id');
            })
            ->select('products.*', 'product_images.image_1');

        $products = $products->get();

        // dump($products);
        return $products;
    }

    public function newArrivalProducts(){
        /*****************************
         * SELECT LATEST PRODUCTS WHICH RECENTLY UPLOADED AND APPROVED
         * CHOOSE ONLY 9 PRODUCS
         * 
         ******************************/

        $products = DB::table('products')
            ->selectRaw(
                'products.*' 
            )
            ->where('products.status','=','approved')
            ->latest();

        $products = $products->limit(9);

        $products = DB::table('product_images')
            ->joinSub($products, 'products',function($join){
                $join->on('products.id','=', 'product_images.product_id');
            })
            ->select('products.*', 'product_images.image_1');

        $products = $products->get();
        // dump($products);

        return $products;


    }

    public function recommendedProducts(){
        /*****************************
         * SELECT ONLY THOSE WHICH HAS HIGH RATINGS AND STARS
         * CHOOSE ONLY 9 PRODUCS
         * 
         ******************************/

        // $products = DB::table('products')
        //     ->join('comments', function($join){
        //         $join->on('products.id','=', 'comments.product_id');                    
        //     })
        //     ->join('product_images', function($join){
        //         $join->on('products.id','=', 'product_images.product_id');                    
        //     })
        //     ->selectRaw(
        //         'products.*, 
        //         product_images.image_1, 
        //         AVG(comments.product_rating) as stars, 
        //         COUNT(comments.product_id) as ratings'
        //     )
        //     ->where('products.status','=','approved')
        //     ->groupBy(
        //         'products.id',
        //         'products.title',
        //         'products.description',
        //         'products.price',
        //         'products.type',
        //         'products.brand',
        //         'products.status',
        //         'products.admin_id',
        //         'products.category_id',
        //         'products.shop_id',
        //         'products.created_at',
        //         'products.updated_at',
        //         'product_images.image_1',
        //         )
        //     ->orderByRaw('stars DESC')
        //     ->orderByRaw('ratings DESC');


        // $products = $products->simplePaginate(10);
        // // dump($products);

        // return $products;

        /*****************************
         * I have just change this query because of performance
         */

        $products = DB::table('products')
            ->join('product_images', function($join){
                $join->on('products.id','=', 'product_images.product_id');                    
            })
            ->selectRaw(
                'products.*, 
                product_images.image_1, 
                stars, 
                ratings'
            )
            ->where('products.status','=','approved')
            ->orderByDesc('stars')
            ->orderByDesc('ratings');

        $products = $products->simplePaginate(10);
        // dump($products);

        return $products;
    }

    public function getCategoryList(){
        return Category::select('id','name')->get();
    }

}
