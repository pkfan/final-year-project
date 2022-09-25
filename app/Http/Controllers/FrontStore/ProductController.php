<?php

namespace App\Http\Controllers\FrontStore;

use Carbon\Carbon;
use App\Models\Buyer;
use App\Models\Rating;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index($product_id){

        /*****************************
         * SELECT PRODUCT WITH REQUESTED PRODUCT ID
         * WITH RATING AND STARS
         * AND SUPPLIER NAME THROUGH PRODUCT SHOP USING PRODCUT
         * I AM USING QUERY BUILDER FOR SQL QUERY FROM DATABASE
         ******************************/

        // $product = Product::with('productImages')
        //     ->with('shop.supplier')
        //     ->where('products.id','=', $product_id)
        //     ->get();
        // // dump($product);
        

        // $ratings_and_stars = Comment::selectRaw(
        //         'COUNT(comments.id) as ratings, 
        //         AVG(comments.product_rating) as stars'
        //     )
        //     ->where('product_id','=',$product_id)
        //     ->get();
        
        // // there are only one item in collection(array)
        // $product = $product[0];
        // $ratings_and_stars = $ratings_and_stars[0];


        /*****************************
         * I have just change this query because of performance
         */
        $product = Product::with('productImages')
            ->with('shop.supplier')
            ->where('products.id','=', $product_id)
            ->get()
            ->first();
        // dump($product);
        // return $product;
        

        // getting related products by its cateogry of current requested product
        $relatedProducts = $this->getRelatedProducts($product->category_id);
        
        $categoryList = $this->getCategoryList();

        return view('Store.pages.productPage', 
            [
                'product' => $product,
                'relatedProducts' => $relatedProducts,
                'categoryList' =>  $categoryList,
                'title'=>'Product Page',
                'search_query' => '',
            ]
        );
    }

    public function getRelatedProducts($category_id){
         /*****************************
         * SEARCH PRODUCTS WITH CATEGORY ID
         * AND SELECT ONLY THOSE WHICH HAS HIGH RATINGS AND STARS
         * CHOOSE ONLY 9 PRODUCS FOR EACH INCOMMING CATEGORY ID
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
        //     ->where('products.category_id','=',$category_id)
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
        //     ->orderByRaw('ratings, stars DESC');


        // $products = $products->limit(9);
        // $products = $products->get();
        // dump($products);

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
            ->where('products.category_id','=',$category_id)
            ->orderByDesc('stars')
            ->orderByDesc('orders');

        $products = $products->limit(9);

        $products = DB::table('product_images')
            ->joinSub($products, 'products',function($join){
                $join->on('products.id','=', 'product_images.product_id');
            })
            ->select('products.*', 'product_images.image_1');

        $products = $products->get();

        return $products;
    }


    public function getCommentsAndRatings($product_id){
        /*****************************
         * SELECT BUYER WITH COMMENTS AND RATINGS 
         * WITH THE HELP OF INCOMMING $product_id variable
         * 
         ******************************/
        // $comments_and_ratings_with_buyer = DB::table('buyers')
        //     ->join('comments',function($join){
        //         $join->on('buyers.id','=','comments.buyer_id');
        //     })
        //     ->where('comments.product_id','=',$product_id)
        //     ->select(
        //         'first_name',
        //         'last_name',
        //         'profile_image',
        //         'product_comment',
        //         'product_rating',
        //         'added_on'
        //     )
            // ->orderByDesc('comments.added_on')
            // ->simplePaginate(5);

            // dump($comments_and_ratings_with_buyer);

            // return $comments_and_ratings_with_buyer;

        /**************************************
         * *************************************
         * I think subjoin() is faster than join() for large data
         * because we first select few data or filter
         * and then subjoin on that data.
         */
        
        $productComments = DB::table('comments')
            ->where('comments.product_id', '=', $product_id);

        $productComments = DB::table('buyers')
            ->joinSub($productComments, 'product_comments', function ($join) {
                $join->on('buyers.id', '=', 'product_comments.buyer_id');
            })
            ->select(
                'buyers.first_name',
                'buyers.last_name',
                'buyers.profile_image',
                'product_comments.product_comment',
                'product_comments.product_rating',
                'product_comments.added_on'
            )
            ->orderByDesc('product_comments.added_on')
            ->simplePaginate(5);
            // ->get();

        // dump($productComments);

        return $productComments;
    }


    public function getCategoryList(){
        return Category::select('id','name')->get();
    }


    public function createComment(Request $request){
        
        $request->validate([
            'comment' => 'required|min:3|max:500'
        ]);

        $product_id = $request->input('product_id');
        $stars = $request->input('stars');
        $comment = $request->input('comment');

        $buyer_id = auth()->guard('buyer')->user()->id;


        $commentCreated = DB::table('comments')->insert([
            'product_comment' => $comment,
            'product_rating' => $stars,
            'added_on' => Carbon::now(),
            'buyer_id' => $buyer_id,
            'product_id' => $product_id,
        ]);

        /********************************
         * update stars and ratings column of this product of products table. 
         */

         $ratingsAndStarsFromComments = DB::table('comments')
            ->where('product_id','=', $product_id)
            ->selectRaw('
                COUNT(product_id) as ratings, 
                AVG(product_rating) as stars
            ')
            ->get()
            ->first();

         // i think this is slow but good idea to update product when someone comment
         $product = DB::table('products')
            ->where('id','=', $product_id)
            ->update([
                'stars' =>  $ratingsAndStarsFromComments->stars,
                'ratings' =>  $ratingsAndStarsFromComments->ratings
            ]);


        
        if($commentCreated && $product){
            return back()->with('success','Your Comment has been published.');
        }
        else{
            return "<h1>something went wrong while insetting comment into COMMENTS TABLE </h1>";
        }
    }

}
