@extends('Store.app') 

@section('app')
       <!-- ////////// START COMMENTS SECTION ///////// -->
                
       <section  class="max-w-[1440px] w-11/12 relative z-10 mx-auto mt-10 p-12 background-white rounded-xl shadow-lg shadow-gray-3 overflow-hidden">
        <!-- product detail start -->
        <div>
            <h1 class="flex capitalize border-b-4 border-gray-3 mb-4 opacity-80">
                Total Products in Cart: <span class=" red pl-4"> {{$products->count()}}</span>  
            </h1>
            <!-- all products in caert start -->
            <div>
                
                @foreach ($products as $product )
                    <!-- start product in cart -->
                <div class=" flex flex-col lg:flex-row space-x-4 items-center border-b border-gray-3 pb-4 mb-4">
                    <span class=" rounded-xl border-2 border-gray-3 p-4 background-gray-1">
                        <img class=" min-w-[200px]" width="200" height="200" class=" " src="{{asset($product->image_1)}}" alt="">
                    </span>
                    <div class=" space-y-4">
     
                         <h2>{{$product->title}}</h2>
                         
                         <div class="flex flex-col lg:flex-row lg:items-center">
                             <!-- all rating stars -->
                             <div class="flex items-center">
                                <!-- start start -->
                                <!-- adding each star with javascript -->
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= round($product->stars))
                                        <!-- start start -->
                                        <span>
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M3.58639 15.443C3.20313 15.641 2.76823 15.294 2.84568 14.851L3.66979 10.121L0.171779 6.765C-0.154888 6.451 0.0148994 5.877 0.452772 5.815L5.31603 5.119L7.48454 0.791996C7.68015 0.401996 8.20937 0.401996 8.40497 0.791996L10.5735 5.119L15.4367 5.815C15.8746 5.877 16.0444 6.451 15.7167 6.765L12.2197 10.121L13.0438 14.851C13.1213 15.294 12.6864 15.641 12.3031 15.443L7.94327 13.187L3.5854 15.443H3.58639Z" class="fill-yellow"/>
                                            </svg>
                                        </span>
                                        <!-- end start -->
                                    @else
                                    <!-- start start -->
                                    <span>
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.58639 15.443C3.20313 15.641 2.76823 15.294 2.84568 14.851L3.66979 10.121L0.171779 6.765C-0.154888 6.451 0.0148994 5.877 0.452772 5.815L5.31603 5.119L7.48454 0.791996C7.68015 0.401996 8.20937 0.401996 8.40497 0.791996L10.5735 5.119L15.4367 5.815C15.8746 5.877 16.0444 6.451 15.7167 6.765L12.2197 10.121L13.0438 14.851C13.1213 15.294 12.6864 15.641 12.3031 15.443L7.94327 13.187L3.5854 15.443H3.58639Z" class="fill-gray-5"/>
                                        </svg>
                                    </span>
                                    <!-- end start -->
                                    @endif
                                @endfor
                                <!-- end start -->
                                 <!-- count rating -->
                                 <span class=" secondary-2  px-2">{{$product->ratings}} Ratings</span>
                             </div>
                             <!-- all rating stars end -->
                             <!-- product brand -->
                             <span class=" border-l border-black black px-2">Brand:<span class=" secondary-2 "> {{$product->brand}}</span></span>
                             <!-- product category -->
                             <span class=" border-l border-black black px-2">Product Type:<span class=" secondary-2 "> {{$product->type}}</span></span>
                         </div>
                         <div class=" flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
 
                              <!-- start button component with eye -->
                              <a href="{{route('productPage',['product_id'=>$product->id])}}" class="btn max-w-max flex items-center px-4 py-1 space-x-2 rounded-full background-ternary shadow-md shadow-gray-3">
                                 <span class=" text-lg font-bold black uppercase">VIEW DETAIL</span>
                                 <span>
                                     <svg width="30" height="26" viewBox="0 0 30 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                         <path d="M15 16.25C17.0711 16.25 18.75 14.7949 18.75 13C18.75 11.2051 17.0711 9.75 15 9.75C12.9289 9.75 11.25 11.2051 11.25 13C11.25 14.7949 12.9289 16.25 15 16.25Z" class=" fill-black"/>
                                         <path d="M29.0066 12.7237C27.904 10.2518 25.9897 8.11413 23.5004 6.57482C21.0111 5.03551 18.0559 4.16209 15 4.0625C11.9441 4.16209 8.98894 5.03551 6.49964 6.57482C4.01033 8.11413 2.09603 10.2518 0.993353 12.7237C0.918882 12.9023 0.918882 13.0977 0.993353 13.2763C2.09603 15.7482 4.01033 17.8859 6.49964 19.4252C8.98894 20.9645 11.9441 21.8379 15 21.9375C18.0559 21.8379 21.0111 20.9645 23.5004 19.4252C25.9897 17.8859 27.904 15.7482 29.0066 13.2763C29.0811 13.0977 29.0811 12.9023 29.0066 12.7237V12.7237ZM15 18.2812C13.7947 18.2812 12.6165 17.9715 11.6144 17.3912C10.6123 16.8109 9.83118 15.9861 9.36995 15.021C8.90872 14.056 8.78804 12.9941 9.02317 11.9697C9.25831 10.9452 9.8387 10.0042 10.6909 9.26559C11.5432 8.527 12.629 8.02401 13.8111 7.82023C14.9932 7.61645 16.2185 7.72104 17.332 8.12076C18.4456 8.52049 19.3973 9.1974 20.0669 10.0659C20.7365 10.9344 21.0939 11.9555 21.0939 13C21.0914 14.4 20.4486 15.7421 19.3063 16.732C18.164 17.722 16.6154 18.2791 15 18.2812V18.2812Z" class=" fill-black"/>
                                     </svg>
                                 </span>
                             </a>
                             <!-- end button component with eye -->
                             <!-- start button component with arrow -->
                             <a href="{{route('buyer.order',['product_id'=>$product->id])}}" class="btn max-w-max flex items-center px-4 py-1 space-x-2 rounded-full background-primary shadow-md shadow-gray-3">
                                 <span class=" text-lg font-bold white uppercase">BUY NOW</span>
                                 <span>
                                     <svg width="18" height="18" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                         <path d="M1.16663 6.99999H12.8333M12.8333 6.99999L6.99996 1.16666M12.8333 6.99999L6.99996 12.8333" class=" stroke-white" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                     </svg>
                                 </span>
                             </a>
                             <!-- end button component with arrow -->
                         </div>
                    </div>
                </div>
                <!-- end product in cart -->
                @endforeach
            </div>
            <!-- all products in cart end -->
           
            @if ($products->count() <= 0)
            <!-- START CART ICON when cart is empty -->
             <div class="flex justify-center items-center space-x-2 cursor-pointer hover:opacity-80">
                <div>
                    <img src="{{asset('assets/images/empty-basket.png')}}" alt="" width="400" height="400">
                </div>
            </div>
            <!-- end CART ICON when cart is empty-->
            @endif
        </div>
       <!-- product detail end -->

    
    </section>
    <!-- ////////// END COMMENT SECTION ///////// -->
@endsection