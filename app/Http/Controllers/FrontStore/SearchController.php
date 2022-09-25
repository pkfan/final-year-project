<?php

namespace App\Http\Controllers\FrontStore;

use App\Models\Shop;
use App\Models\Category;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function index(Request $request, $category_id=null){
       /*****************************
         * SEARCH PRODUCTS WITH CATEGORY ID
         * AND SELECT ONLY THOSE WHICH HAS HIGH RATINGS AND STARS
         * CHOOSE ONLY 9 PRODUCS FOR EACH INCOMMING CATEGORY ID
         * 
         ******************************/
        $searchQuery = null;
        $cat_id = null;

        if($category_id){
            $cat_id = $category_id;
        }
        else{
            $searchQuery = $request->input('search_query');
        }

         
        $products = DB::table('products')
            ->join('product_images', function($join){
                $join->on('products.id','=', 'product_images.product_id');                    
            })
            ->selectRaw(
                'products.*, 
                product_images.image_1, 
                stars'
            );

        $products = $products->when($searchQuery,function($query) use($searchQuery){
            $query->where('products.title', 'LIKE', "%{$searchQuery}%");
            // ->orWhere('products.description', 'LIKE', "%{$searchQuery}%");
        });

        $products = $products->when($cat_id,function($query) use($cat_id){
            $query->where('products.category_id', '=', $cat_id);
            // ->orWhere('products.description', 'LIKE', "%{$searchQuery}%");
        });

        $products = $products->where('products.status','=','approved')
            ->orderByRaw('stars DESC');
        // ->orderByRaw('avg(ratings.product_rating) DESC');
        $productsSearchResults = $products->paginate(20);

    // $products = $products->limit(9);
    // $productsSearchResults = $products->get();

        // getting filter by location (stats and its cities) with count
        $filterByLocation = $this->searchFilterByLocation($searchQuery, $category_id);
        $categoryList = $this->getCategoryList();

        return view('Store.pages.searchPage', 
            [
                'productsSearchResults'=>$productsSearchResults, 
                'filterByLocation' =>$filterByLocation,
                'categoryList' =>  $categoryList,
                'title' => 'Search Page',
                'search_query' => $searchQuery,
                'category_id' => $category_id,
            ]
        );
    }

    public function searchFilterByLocation($searchQuery=null, $category_id = null){

        /*******************
         * 
         * this query takes 13 secods with like operator
         */

        $stateAndCityofProducts = DB::table('shops')
            ->join('products', function($join){
                $join->on('shops.id','=', 'products.shop_id');
            })
            ->select('state','city')
            ->where('products.status','=','approved');

        $stateAndCityofProducts = $stateAndCityofProducts->when($searchQuery, function($query) use($searchQuery){
            $query->where('products.title', 'LIKE', "%{$searchQuery}%");
            //   ->orWhere('products.description', 'LIKE', "%{$searchQuery}%");
        });
        $stateAndCityofProducts = $stateAndCityofProducts->when($category_id,function($query) use($category_id){
            $query->where('products.category_id', '=', $category_id);
            // ->orWhere('products.description', 'LIKE', "%{$searchQuery}%");
        });

        $stateAndCityofProducts = $stateAndCityofProducts->get();

            // dump($stateAndCityofProducts);


            $stateAndCityWithCounts = [];
            $cities = [];

            foreach($stateAndCityofProducts as $stateAndCityofProduct){
                // dump($stateAndCityofProduct->city);

                $state = $stateAndCityofProduct->state;
                $city = $stateAndCityofProduct->city;

                $stateCities = $state . ' Cities';

                // settings arrays keys and values if not already in array for state(provices)
                if(!($stateAndCityWithCounts[$state] ?? null)){
                    // setting initail value 1 for first count
                    $stateAndCityWithCounts[$state ] = 1;
                    
                     // setting first city count of current state
                     if(!($cities[$state] ?? null)){
                        $cities[$state] = [];

                        if(!($cities[$state][$city] ?? null)){
                            $cities[$state][$city] = 1;
                        }
                    }

                }
                else{
                    // increment values of stats
                    $stateAndCityWithCounts[$state ] += 1;


                    // setting first city count of current state
                    if(!($cities[$state][$city] ?? null)){
                        $cities[$state][$city] = 1;
                    }
                    else{
                    // increment values of cities of current stateCities
                        $cities[$state][$city] += 1;
                    }
                }


                
            }


        return ['states'=>$stateAndCityWithCounts, 'cities'=>$cities];



    }

    public function searchByStateCityQueryCategory($state_city_query_category){

        $stateCityQuery = explode(":", base64_decode($state_city_query_category));

        $state = $stateCityQuery[0];
        $city = $stateCityQuery[1];
        $searchQuery = $stateCityQuery[2];
        $category_id = $stateCityQuery[3];


        if($searchQuery == '' || $searchQuery == null){
            $searchQuery = null;
        }


        if($category_id == '' || $category_id == null){
            $category_id = null;
        }
        else{
            $category_id = (integer) $category_id;
        }

        $stateAndCityofProducts = DB::table('shops')
            ->join('products', function($join){
                $join->on('shops.id','=', 'products.shop_id');
            });
            
        $stateAndCityofProducts = $stateAndCityofProducts
            ->join('product_images', function($join){
                $join->on('products.id','=', 'product_images.product_id');                    
            });

        $stateAndCityofProducts = $stateAndCityofProducts
            ->selectRaw(
                'products.id,
                products.title,
                products.description,
                products.price, 
                product_images.image_1, 
                stars'
            )
            ->where('products.status','=','approved')
            ->where('shops.state','=',$state)
            ->when(($city != "" || $city != null), function($query) use($city){
                $query->where('shops.city','=', $city);
            })
            ->when($searchQuery, function($query) use($searchQuery){
                $query->where('products.title', 'LIKE', "%{$searchQuery}%");
                //   ->orWhere('products.description', 'LIKE', "%{$searchQuery}%");
            })
            ->when($category_id, function($query) use($category_id){
                $query->where('products.category_id', '=', $category_id);
            })
            ->orderByRaw('stars DESC')
            ->paginate(20);

        // getting filter by location (stats and its cities) with count
        $filterByLocation = $this->searchFilterByLocation($searchQuery,$category_id);
        $categoryList = $this->getCategoryList();


        return view('Store.pages.searchPage', 
            [
                'productsSearchResults'=>$stateAndCityofProducts, 
                'filterByLocation' =>$filterByLocation,
                'categoryList' =>  $categoryList,
                'title' => 'Search Page',
                'category_id' => $category_id,
                'search_query' => $searchQuery,
                'searchedState' => $state,
                'searchedCity' => $city,
            ]
        );
    }

    public function searchByCategory(Request $request, $category_id){
        return $this->index($request, $category_id);
    }

    public function getCategoryList(){
        return Category::select('id','name')->get();
    }

}
