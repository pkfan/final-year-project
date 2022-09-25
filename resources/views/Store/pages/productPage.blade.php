@extends('Store.app') 

@section('app')

    <!-- ////////// START PRODUCT HERO SECTION ///////// -->
    <section  class="max-w-[1440px] w-11/12 relative z-10 mx-auto mt-10 p-12 grid grid-cols-1 lg:grid-cols-2 gap-0 background-white rounded-xl shadow-lg shadow-gray-3 overflow-hidden">
        <!-- left side -->
        <div class=" w-full h-full pr-8">
                <div id="product-slider" class="splide">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <li class="splide__slide flex justify-center items-center">
                                <span>
                                    <img width="350" class=" rounded-xl max-h-[500px]" src="{{asset($product->productImages[0]->image_1)}}" />
                                </span>
                            </li>
                            <li class="splide__slide flex justify-center items-center">
                                <span>
                                    <img width="350" class=" rounded-xl max-h-[500px]" src="{{asset($product->productImages[0]->image_2)}}" />
                                </span>
                            </li>
                            <li class="splide__slide flex justify-center items-center">
                                <span>
                                    <img width="350" class=" rounded-xl max-h-[500px]" src="{{asset($product->productImages[0]->image_3)}}" />
                                </span>
                            </li>
                            <li class="splide__slide flex justify-center items-center">
                                <span>
                                    <img width="350" class=" rounded-xl max-h-[500px]" src="{{asset($product->productImages[0]->image_4)}}" />
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
                    <ul id="thumbnails" class="thumbnails">
                    <li class="thumbnail">
                        <span>

                            <img width="350" src="{{asset($product->productImages[0]->image_1)}}" />
                        </span>
                    </li>
                    <li class="thumbnail">
                        <span>

                            <img width="350" src="{{asset($product->productImages[0]->image_2)}}" />
                        </span>
                    </li>
                    <li class="thumbnail">
                        <span>

                            <img width="350" src="{{asset($product->productImages[0]->image_3)}}" />
                        </span>
                    </li>
                    <li class="thumbnail">
                        <span>

                            <img width="350" src="{{asset($product->productImages[0]->image_4)}}" />
                        </span>
                    </li>
                    </ul>
        </div>
        <!-- right side -->

        <div class=" w-full h-full pt-4 lg:pt-0 flex flex-col justify-between space-y-4">
            <h1>
                {{$product->title}}
            </h1>
            <p>
                {{substr($product->description,0,140)}}
            </p>
            <div class="flex flex-col ">
                <!-- all rating stars -->
                <div class="flex items-center">
                    <div id="hero-slider-stars-${number}" class="flex items-center">
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
                    </div>
                    <span class=" secondary-2  px-2">({{$product->ratings}} Ratings)</span>
                </div>
                <!-- product type -->
                <span class="black ">Product Type:<span class=" secondary-2 "> {{$product->type}}</span></span>
                <!-- product brand -->
                <span class="black ">Brand:<span class=" secondary-2 "> {{$product->brand}}</span></span>
                <!-- supplier detail -->
                <span class="black ">Supplier: {{$product->shop->supplier->first_name}} {{$product->shop->supplier->last_name}}<span class=" secondary-2 "> View Detail</span></span>
                
            </div>
            <div class="flex py-4">
                <span class=" self-end mr-2">from</span>
                <h1 class=" primary">Rs. <span id="product-hero-price" class=" primary">{{number_format($product->price,0,".",",")}}</span></h1>
                <span id="product-hero-price-hidden" class=" hidden">{{$product->price}}</span>
            </div>
            <div class="w-full flex space-x-4">
                <!-- start button component with quantity -->
                <div class="flex flex-col space-y-2">
                    <span>Quantity</span>
                    <button class="max-w-max flex items-center px-4 py-1 space-x-2 rounded-full background-gray-1 shadow-md shadow-gray-3">
                        
                        <span id="productPage-quantity-minus" class=" text-lg font-bold uppercase">
                            <?xml version="1.0"?>
                            <svg class=" fill-black" width="30" height="30" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" xml:space="preserve"><rect height="64" width="384" x="64" y="224"/></svg>
                        </span>
                        <span id="productPage-quantity-body" class=" text-2xl font-bold uppercase">1</span>
                        <span id="productPage-quantity-plus" class=" text-lg font-bold uppercase">
                            <?xml version="1.0"?>
                            <svg width="30px"  height="30px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 50 50"  id="Layer_1" version="1.1" viewBox="0 0 50 50" xml:space="preserve"><rect fill="none"/><line fill="none" class=" stroke-black" stroke-miterlimit="10" stroke-width="4" x1="9" x2="41" y1="25" y2="25"/><line fill="none" class=" stroke-black" stroke-miterlimit="10" stroke-width="4" x1="25" x2="25" y1="9" y2="41"/></svg>
                        </span>
                    </button>
                </div>
                <!-- end button component with quantity -->
                <div class=" w-full self-end">
                    @php
                        $checkIfAlreadyInBuyerCart = DB::table('carts')
                            ->where('buyer_id','=', auth()->guard('buyer')->user()->id ?? null)
                            ->where('product_id','=', $product->id)
                            ->first();
                    @endphp
                    <!-- start button component with cart icon -->
                    <button id="productPage-addToCart-Button" class="btn w-full flex justify-center items-center px-4 py-2 space-x-2 rounded-full background-ternary shadow-md shadow-gray-3">
                        <div id="productPage-addToCart-text" class=" text-lg font-bold black capatilize">@if($checkIfAlreadyInBuyerCart)Remove From Cart @else Add To Cart @endif</div>
                        <span>
                            <svg width="40" height="28" viewBox="0 0 40 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M35.0498 21.875H14.6925L15.147 24.0625H33.7872C34.8567 24.0625 35.6494 25.0401 35.4124 26.0667L35.0292 27.7262C36.3272 28.3464 37.2222 29.6562 37.2222 31.1719C37.2222 33.3048 35.4501 35.0303 33.2761 34.9996C31.2051 34.9703 29.5018 33.3158 29.4459 31.2776C29.4154 30.1642 29.8685 29.1551 30.6128 28.4374H16.0539C16.7745 29.1324 17.2222 30.1004 17.2222 31.1719C17.2222 33.3466 15.38 35.0978 13.1479 34.9958C11.166 34.9052 9.5541 33.3288 9.44993 31.3784C9.36952 29.8721 10.1747 28.5445 11.3979 27.852L6.51965 4.375H1.66667C0.746181 4.375 0 3.64048 0 2.73437V1.64062C0 0.734521 0.746181 0 1.66667 0H8.78674C9.57847 0 10.2609 0.54831 10.4196 1.31182L11.0561 4.375H38.3326C39.4022 4.375 40.1949 5.35261 39.9579 6.37923L36.675 20.598C36.5026 21.3449 35.828 21.875 35.0498 21.875ZM28.3333 11.4844H25V8.75C25 8.14591 24.5026 7.65625 23.8889 7.65625H22.7778C22.1641 7.65625 21.6667 8.14591 21.6667 8.75V11.4844H18.3333C17.7197 11.4844 17.2222 11.974 17.2222 12.5781V13.6719C17.2222 14.276 17.7197 14.7656 18.3333 14.7656H21.6667V17.5C21.6667 18.1041 22.1641 18.5937 22.7778 18.5937H23.8889C24.5026 18.5937 25 18.1041 25 17.5V14.7656H28.3333C28.947 14.7656 29.4445 14.276 29.4445 13.6719V12.5781C29.4445 11.974 28.947 11.4844 28.3333 11.4844Z" class=" fill-black"/>
                            </svg>
                        </span>
                    </button>
                    <!-- end button component with cart icond -->
                </div>
                
            </div>
            <div class="flex space-x-4">
                
                <!-- start button component with arrow -->
                <a id="productPage-BuyNow-button" href="@if(auth()->guard('buyer')->check()){{route('buyer.order',['product_id'=>$product->id])}} @else # @endif" class="btn w-full flex justify-center items-center px-4 py-2 space-x-2 rounded-full background-primary shadow-md shadow-gray-3">
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
        
    </section>
    <!-- ////////// END PRODUCT HERO SECTION ///////// -->

    <!-- ////////// START product page tab SECTION ///////// -->
    <section id="productPage-tab-section"  class="max-w-[1440px] w-11/12 relative mx-auto mt-10 background-white rounded-xl shadow-md shadow-gray-3 overflow-hidden">
        <!-- tab links start -->
        <ul class=" px-8 flex items-center uppercase">
            <li><button class="active" type='Product Description' onclick="onClickProductPageTab(this);">Product Description</button></li>
            <li><button  type='Shop Detail' onclick="onClickProductPageTab(this);">Shop Detail</button></li>
            <li><button type='About Supplier' onclick="onClickProductPageTab(this);">About Supplier</button></li>
        </ul>
        <!-- tab links end -->
        <!-- start products cards and loaders -->
        <div>
            <!--start all products cards -->
            <div id="productPage-tab-section-body" class="px-12 py-4 ">
                <p>
                    {{$product->description}}
                </p>
            </div>
            <!--end all products cards -->
        </div>
        <!-- end products cards and loaders -->

    </section>
    <!-- ////////// END product page tab SECTION ///////// -->


    <!-- ////////// START ADS SECTION ///////// -->
    <section  class="max-w-[1440px] w-10/12 mx-auto mt-10 ">
        <img src="{{asset('assets/images/ads3.webp')}}" alt="" width="100%">
    </section>
    <!-- ////////// END ADS SECTION ///////// -->

    <!-- ////////// START RELATED PRODUCTS SECTION ///////// -->
    <section id="related-section"  class="max-w-[1440px] w-11/12 relative mx-auto mt-10 background-white rounded-xl shadow-md shadow-gray-3 overflow-hidden">
        <!-- HEADER start -->
        <div class="w-full flex justify-between border-b-4 border-gray-3 -translate-y-1">
            <div class=" background-primary max-w-max flex items-center relative z-10 overflow-hidden translate-y-1">
                <h2 class="white capitalize pl-8 pr-24 py-3">related products</h2>
                <!-- right yello circle -->
                <div class=" w-52 h-24 background-ternary rounded-[50%] absolute -right-32 -top-1 -z-10"></div>
            </div>
            <div class="flex items-center translate-y-1 pr-8">
                <!-- start button component with arrow -->
                <a href="#" class="btn max-w-max hidden md:flex items-center px-4 py-1 space-x-2 rounded-full border-2 border-secondary-2 shadow-md shadow-gray-3">
                    <span class=" text-sm font-bold secondary-2 uppercase">View All</span>
                    <span>
                        <svg width="18" height="18" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.16663 6.99999H12.8333M12.8333 6.99999L6.99996 1.16666M12.8333 6.99999L6.99996 12.8333" class=" stroke-secondary-2" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </a>
                <!-- end button component with arrow -->
            </div>
        </div>
        <!-- HEADER end -->


        <!-- start products cards and loaders -->
        <div class="">
            <!-- ////////// related SLIDER ///////// -->
            <div id="productPage-related-slider" class="splide w-[95%] mx-auto">
                <div class="splide__track py-4 !overflow-visible">
                    <ul class="splide__list cursor-move -translate-x-4">
                    @foreach ($relatedProducts as $relatedProduct)
                        <li class="w-full splide__slide mx-4 max-w-max flex">
                            <!-- start product card -->
                            <div class="my-4 min-w-[270px] w-[270px] flex flex-col border border-gray-2 rounded-xl hover:shadow-lg hover:shadow-gray-3 hover:-translate-y-4 transition-all duration-500 overflow-hidden">
                                <header class="w-10/12 h-1/2 min-h-[220px] mx-auto p-4 flex justify-center items-center">
                                    <img class=" rounded-md max-h-[220px]" src="{{asset($relatedProduct->image_1)}}" alt="" width="300">
                                </header>
                                <footer class="h-full background-gray-1 p-4 flex flex-col justify-between space-y-2">
                                    <!-- all rating stars -->
                                    <div class="flex items-center">
                                        <div id="featured-stars-${number}" class="flex items-center">
                                            <!-- start start -->
                                                <!-- adding each star with javascript -->
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= round($relatedProduct->stars))
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
                                        </div>
                                        <span class=" secondary-2  px-2">{{$relatedProduct->ratings}} Ratings</span>
                                    </div>
                                    <!-- all rating stars end -->
                                    <h4>
                                        {{substr($relatedProduct->title,0,70)}}
                                    </h4>
                                    <p class=" text-xs">
                                        {{substr($relatedProduct->description,0,120)}}
                                    </p>
                                    <h3 class="self-end primary px-4 bg-gradient-to-tl from-[var(--green)]">
                                        Rs. {{number_format($relatedProduct->price,0,".",",")}}
                                    
                                    </h3>
                                    <!-- start button component with eye -->
                                    <a href="{{route('productPage',['product_id'=>$relatedProduct->id])}}" class="btn max-w-max self-center flex items-center px-4 py-1 !mt-6 !mb-3 space-x-2 rounded-full background-ternary shadow-md shadow-gray-3">
                                        <span class=" text-md font-bold black uppercase">VIEW DETAIL</span>
                                        <span>
                                            <svg width="30" height="26" viewBox="0 0 30 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15 16.25C17.0711 16.25 18.75 14.7949 18.75 13C18.75 11.2051 17.0711 9.75 15 9.75C12.9289 9.75 11.25 11.2051 11.25 13C11.25 14.7949 12.9289 16.25 15 16.25Z" class=" fill-black"/>
                                                <path d="M29.0066 12.7237C27.904 10.2518 25.9897 8.11413 23.5004 6.57482C21.0111 5.03551 18.0559 4.16209 15 4.0625C11.9441 4.16209 8.98894 5.03551 6.49964 6.57482C4.01033 8.11413 2.09603 10.2518 0.993353 12.7237C0.918882 12.9023 0.918882 13.0977 0.993353 13.2763C2.09603 15.7482 4.01033 17.8859 6.49964 19.4252C8.98894 20.9645 11.9441 21.8379 15 21.9375C18.0559 21.8379 21.0111 20.9645 23.5004 19.4252C25.9897 17.8859 27.904 15.7482 29.0066 13.2763C29.0811 13.0977 29.0811 12.9023 29.0066 12.7237V12.7237ZM15 18.2812C13.7947 18.2812 12.6165 17.9715 11.6144 17.3912C10.6123 16.8109 9.83118 15.9861 9.36995 15.021C8.90872 14.056 8.78804 12.9941 9.02317 11.9697C9.25831 10.9452 9.8387 10.0042 10.6909 9.26559C11.5432 8.527 12.629 8.02401 13.8111 7.82023C14.9932 7.61645 16.2185 7.72104 17.332 8.12076C18.4456 8.52049 19.3973 9.1974 20.0669 10.0659C20.7365 10.9344 21.0939 11.9555 21.0939 13C21.0914 14.4 20.4486 15.7421 19.3063 16.732C18.164 17.722 16.6154 18.2791 15 18.2812V18.2812Z" class=" fill-black"/>
                                            </svg>
                                        </span>
                                    </a>
                                    <!-- end button component with eye -->
    
                                </footer>
                            </div>
                            <!-- end product card -->
                        </li>
                    @endforeach
                    </ul>
                </div>
            </div>
            <!-- ////////// END related SLIDER ///////// -->


        </div>
        <!-- end products cards and loaders -->

    </section>
    <!-- ////////// END RELATED PRODUCTS SECTION ///////// -->

    <!-- ////////// START COMMENTS SECTION ///////// -->
    <section  class="max-w-[1440px] w-11/12 relative z-10 mx-auto mt-10 p-12 background-white rounded-xl shadow-lg shadow-gray-3 overflow-hidden">
        <!-- rating and comment start -->
        <div class="w-full flex justify-center space-x-4 mb-12">
            <!-- start button component with arrow -->
            <button id="productPage-postComment" class="btn opacity-70 max-w-max flex items-center px-4 py-4 space-x-2 rounded-lg background-primary shadow-md shadow-gray-3">
                <span class=" text-lg font-bold white uppercase">Post a comment for this product</span>
                <span>
                    <svg width="18" height="18" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.16663 6.99999H12.8333M12.8333 6.99999L6.99996 1.16666M12.8333 6.99999L6.99996 12.8333" class=" stroke-white" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
            </button>
            <!-- end button component with arrow -->
        </div>

        @error('comment')
            <h3 class="red">{{ $message }}</h3>
        @enderror

        <!-- rating and comment and -->
        <h3 class="flex capitalize border-b-4 border-gray-3 mb-4 opacity-80">
            Total User Rate this product :  
            <!-- count rating -->
            <span class=" secondary-2  px-2">{{$product->ratings}} Ratings</span>
        </h3>
        <!-- start all comments  -->
        <div id="product-page-all-comments">
            <!-- comment start -->
            {{-- cometns are inserted via javascript --}}
            <!-- comment end -->
        </div>
        <!-- end all comments  -->
        <!-- end products cards and loaders -->
        <div class="flex justify-center items-center">
            <!-- start button component with arrow -->
            <button id="product-page-all-comments-load-more-button" onclick="onClickLoadMoreProductPageComment(this);" class="background-white flex items-center px-4 py-1 space-x-2 rounded-full border-2 border-secondary-2 shadow-md shadow-gray-3">
                <span class=" text-lg font-bold secondary-2 uppercase">Load More Comments</span>
            </button>
            <!-- end button component with arrow -->
        </div>
    
    </section>
    <!-- ////////// END COMMENT SECTION ///////// -->

    <!-- ////////// START RATINGS AND COMMENTS MODEL SECTION ///////// -->

    <div class="relative">
        <div id="productPage-comment-overlay" class=" scale-0 z-40 w-screen h-screen fixed top-0 left-0 background-black opacity-40"></div>
        <div id="productPage-comment-body" class=" scale-0 transition-all duration-1000 h-[550px] overflow-y-scroll z-50 p-8 fixed top-8 left-1/2 -translate-x-1/2 background-white shadow-2xl shadow-gray-3">
             <!-- start close button -->
             <button id="productPage-comment-closeButton" class="sticky top-0 max-w-max flex items-center px-4 py-1 space-x-2 rounded-full border-2 border-secondary-2 shadow-md shadow-gray-3">
                <span class=" text-sm font-bold secondary-2 uppercase">Close</span>
             </button>
            <!-- end close button -->
            <!-- emoji svg vector start -->
            <div id="product-page-comment-emoji" class=" flex justify-center">
                <?xml version="1.0" encoding="UTF-8" standalone="no"?>
                <svg
                   xmlns:dc="http://purl.org/dc/elements/1.1/"
                   xmlns:cc="http://creativecommons.org/ns#"
                   xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                   xmlns:svg="http://www.w3.org/2000/svg"
                   xmlns="http://www.w3.org/2000/svg"
                   width="200"
                   height="200"
                   viewBox="0 0 54.000003 53.999999"
                   id="svg4625"
                   version="1.1">
                  <defs
                     id="defs4627" />
                  <metadata
                     id="metadata4630">
                    <rdf:RDF>
                      <cc:Work
                         rdf:about="">
                        <dc:format>image/svg+xml</dc:format>
                        <dc:type
                           rdf:resource="http://purl.org/dc/dcmitype/StillImage" />
                        <dc:title></dc:title>
                      </cc:Work>
                    </rdf:RDF>
                  </metadata>
                  <path
                     transform="matrix(0.64172577,0.2855999,-0.28559845,0.64172904,-472.04655,-389.15727)"
                     d="m 867.25767,248.63878 -8.79214,-2.00489 -4.39318,7.87537 -0.81016,-8.98137 -8.84749,-1.74454 8.29145,-3.5459 -1.07488,-8.95355 5.93455,6.78988 8.18318,-3.78907 -4.62369,7.74229 z"
                     id="path4641-2"
                     style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:#ffc601;fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" />
                  <path
                     id="path4608-3-3"
                     d="m 8.4137878,10.21874 -5.39e-5,5.461953"
                     style="fill:none;fill-rule:evenodd;stroke:#ffffff;stroke-width:1.83395159;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" />
                  <path
                     id="path4608-0"
                     d="m 8.4137339,15.680693 0,23.329002"
                     style="fill:none;fill-rule:evenodd;stroke:#515151;stroke-width:1.83395159;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" />
                  <path
                     id="path4138-2-5-2-4-7-8-3"
                     d="m 4.0809918,25.79912 a 11.708985,11.709045 0 0 1 11.7079172,11.709595 11.708985,11.709045 0 0 1 -0.0151,0.401378 11.708985,11.709045 0 0 1 -0.776946,0.03884 11.708985,11.709045 0 0 1 -11.7095357,-11.709584 11.708985,11.709045 0 0 1 0.015103,-0.399759 11.708985,11.709045 0 0 1 0.7785644,-0.04046 z"
                     style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:#479f00;fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1.25;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" />
                  <ellipse
                     ry="19.140499"
                     rx="19.1404"
                     cy="34.859509"
                     cx="34.775581"
                     id="path4138-0-0-4-5-3"
                     style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:#f8ad32;fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1.25;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" />
                  <ellipse
                     ry="1.6666709"
                     rx="1.6666625"
                     cy="29.921871"
                     cx="29.64679"
                     id="path4213-6-3-5-8-98-1"
                     style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:#992500;fill-opacity:1;fill-rule:evenodd;stroke:#9a2400;stroke-width:1.07879508;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" />
                  <ellipse
                     ry="1.6666709"
                     rx="1.6666625"
                     cy="29.921871"
                     cx="39.904682"
                     id="path4213-6-6-7-8-8-7-0"
                     style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:#992500;fill-opacity:1;fill-rule:evenodd;stroke:#9a2400;stroke-width:1.07879508;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" />
                  <path
                     id="path4249-92-8-2-1-2"
                     d="m 20.859848,36.491107 1.078792,0 c 0.85915,6.330342 6.272314,11.213833 12.838276,11.213833 6.565961,0 11.976719,-4.883491 12.835869,-11.213833 l 1.078793,0"
                     style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:none;fill-opacity:1;fill-rule:evenodd;stroke:#9a2400;stroke-width:2.15759015;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" />
                  <path
                     id="path4704"
                     d="M 27.360984,11.596682 C 26.604827,15.646101 21.816672,19.284163 19.355062,23.403401 32.514915,21.31555 41.312412,22.153204 50.023671,23.294249 47.106832,18.22391 45.914659,11.526086 40.802424,6.786064 35.690232,2.0460422 28.10808,-0.41395119 20.313806,0.34941692 25.698296,3.5672118 28.117099,7.5472529 27.360984,11.596682 Z"
                     style="fill:#1260ee;fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1.1353085px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" />
                  <ellipse
                     ry="1.2810724"
                     rx="1.2810658"
                     cy="5.2163053"
                     cx="31.442875"
                     id="path4820"
                     style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:#ffffff;fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1.70000005;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:0.22699387;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" />
                  <ellipse
                     ry="1.2810724"
                     rx="1.2810658"
                     cy="10.947418"
                     cx="39.196693"
                     id="path4820-2"
                     style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:#ffffff;fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1.70000005;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:0.22699387;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" />
                  <ellipse
                     ry="1.2810724"
                     rx="1.2810658"
                     cy="12.430765"
                     cx="31.914846"
                     id="path4820-3"
                     style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:#ffffff;fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1.70000005;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:0.22699387;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" />
                  <ellipse
                     ry="1.2810724"
                     rx="1.2810658"
                     cy="17.015656"
                     cx="36.769413"
                     id="path4820-36"
                     style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:#ffffff;fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1.70000005;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:0.22699387;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" />
                  <ellipse
                     ry="1.2810724"
                     rx="1.2810658"
                     cy="18.633852"
                     cx="43.646713"
                     id="path4820-31"
                     style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:#ffffff;fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1.70000005;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:0.22699387;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" />
                  <ellipse
                     ry="1.2810724"
                     rx="1.2810658"
                     cy="18.768703"
                     cx="28.273924"
                     id="path4820-4"
                     style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:#ffffff;fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1.70000005;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:0.22699387;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" />
                </svg>
            <!-- end emoji svg vector  -->
            </div>
            
            <!-- all rating stars -->
            <div id="product-page-comment-stars" class="flex items-center justify-center mt-8 cursor-pointer">
                <!-- start start -->
  
                    <svg id="comment-star-1" star='1' onclick="onProductPageCommentStar(this);" class="fill-yellow" width="60" height="60" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.58639 15.443C3.20313 15.641 2.76823 15.294 2.84568 14.851L3.66979 10.121L0.171779 6.765C-0.154888 6.451 0.0148994 5.877 0.452772 5.815L5.31603 5.119L7.48454 0.791996C7.68015 0.401996 8.20937 0.401996 8.40497 0.791996L10.5735 5.119L15.4367 5.815C15.8746 5.877 16.0444 6.451 15.7167 6.765L12.2197 10.121L13.0438 14.851C13.1213 15.294 12.6864 15.641 12.3031 15.443L7.94327 13.187L3.5854 15.443H3.58639Z" />
                    </svg>

                <!-- end start -->
                <!-- start start -->

                    <svg id="comment-star-2" star='2' onclick="onProductPageCommentStar(this);" class="fill-yellow" width="60" height="60" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.58639 15.443C3.20313 15.641 2.76823 15.294 2.84568 14.851L3.66979 10.121L0.171779 6.765C-0.154888 6.451 0.0148994 5.877 0.452772 5.815L5.31603 5.119L7.48454 0.791996C7.68015 0.401996 8.20937 0.401996 8.40497 0.791996L10.5735 5.119L15.4367 5.815C15.8746 5.877 16.0444 6.451 15.7167 6.765L12.2197 10.121L13.0438 14.851C13.1213 15.294 12.6864 15.641 12.3031 15.443L7.94327 13.187L3.5854 15.443H3.58639Z" />
                    </svg>

                <!-- end start -->
                <!-- start start -->
            
                    <svg id="comment-star-3" star='3' onclick="onProductPageCommentStar(this);" class="fill-yellow" width="60" height="60" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.58639 15.443C3.20313 15.641 2.76823 15.294 2.84568 14.851L3.66979 10.121L0.171779 6.765C-0.154888 6.451 0.0148994 5.877 0.452772 5.815L5.31603 5.119L7.48454 0.791996C7.68015 0.401996 8.20937 0.401996 8.40497 0.791996L10.5735 5.119L15.4367 5.815C15.8746 5.877 16.0444 6.451 15.7167 6.765L12.2197 10.121L13.0438 14.851C13.1213 15.294 12.6864 15.641 12.3031 15.443L7.94327 13.187L3.5854 15.443H3.58639Z" />
                    </svg>
              
                <!-- end start -->
                <!-- start start -->
            
                    <svg id="comment-star-4" star='4' onclick="onProductPageCommentStar(this);" class="fill-yellow" width="60" height="60" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.58639 15.443C3.20313 15.641 2.76823 15.294 2.84568 14.851L3.66979 10.121L0.171779 6.765C-0.154888 6.451 0.0148994 5.877 0.452772 5.815L5.31603 5.119L7.48454 0.791996C7.68015 0.401996 8.20937 0.401996 8.40497 0.791996L10.5735 5.119L15.4367 5.815C15.8746 5.877 16.0444 6.451 15.7167 6.765L12.2197 10.121L13.0438 14.851C13.1213 15.294 12.6864 15.641 12.3031 15.443L7.94327 13.187L3.5854 15.443H3.58639Z" />
                    </svg>
              
                <!-- end start -->
                <!-- start start -->
             
                    <svg id="comment-star-5" star='5' onclick="onProductPageCommentStar(this);" class="fill-yellow" width="60" height="60" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.58639 15.443C3.20313 15.641 2.76823 15.294 2.84568 14.851L3.66979 10.121L0.171779 6.765C-0.154888 6.451 0.0148994 5.877 0.452772 5.815L5.31603 5.119L7.48454 0.791996C7.68015 0.401996 8.20937 0.401996 8.40497 0.791996L10.5735 5.119L15.4367 5.815C15.8746 5.877 16.0444 6.451 15.7167 6.765L12.2197 10.121L13.0438 14.851C13.1213 15.294 12.6864 15.641 12.3031 15.443L7.94327 13.187L3.5854 15.443H3.58639Z" />
                    </svg>
                
                <!-- end start -->
            </div>
            <!-- all rating stars end -->

            <form action="{{route('buyer.product.comment')}}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{$product->id}}">
                <input type="hidden" name="stars" id="productPage-stars-field" value="5">
                <!--  comment start -->
                <div id="comment-feild" class=" flex flex-col w-full p-4 pl-0 ">
                    <label for="comment-feild" class=" text-sm">Comment:</label>
                    <textarea name="comment" id="comment-feild" required cols="60" rows="5" placeholder="write your comment here" class=" placeholder:gray-5 w-full rounded-md p-1 pl-4 border-2 border-gray-5 background-gray-2"></textarea>
                </div>
                <!-- end comment field -->
                 <!-- button comoponenet start -->
                    <div class=" w-full flex justify-center items-center p-8">
                        <button id="login-button" class=" background-primary max-w-max flex justify-center items-center py-1 px-8 border-2 border-primary rounded-full space-x-2 shadow-md shadow-gray-500 hover:opacity-70">
                            <span class=" white font-bold">SUBMIT</span>
                            <!-- right arrow -->
                            <svg width="19" height="12" viewBox="0 0 19 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 6H17.5M17.5 6L12.5 1M17.5 6L12.5 11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" stroke-white"/>
                            </svg>
                        </button>
                    </div>
                    <!-- end button comoponenet -->
            </form>
        </div>
    </div>
    <!-- ////////// END RATINGS AND COMMENTS MODEL SECTION ///////// -->

<!-- ////////// buyer Authentication warning start ///////// -->

<div class="relative">
    <div id="productPage-AuthenticationWarning-overlay" class="scale-0 z-40 w-screen h-screen fixed top-0 left-0 background-black opacity-40"></div>
    <div id="productPage-AuthenticationWarning-body" class="scale-0 transition-all duration-1000 z-50 p-8 fixed top-4 md:top-32 left-1/2 -translate-x-1/2 background-white shadow-2xl shadow-gray-3 border-8 border-red">
       <!-- start close button -->
       <button id="productPage-AuthenticationWarning-closeButton" class="absolute right-4 top-4 max-w-max flex items-center px-4 py-1 space-x-2 rounded-full border-2 border-secondary-2 shadow-md shadow-gray-3">
        <span class=" text-sm font-bold secondary-2 uppercase">Close</span>
     </button>
    <!-- end close button -->
        <div class="flex flex-col md:flex-row items-center space-x-4 py-12">
           <div>
               <?xml version="1.0" encoding="UTF-8"?>
               <svg width="120" height="120" version="1.1" viewBox="0 0 712.32 696.47" xmlns="http://www.w3.org/2000/svg" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">
                   <g transform="translate(-17.279 -27.314)">
                   <text x="352.30161" y="723.78192" fill="#000000" font-family="Sans" font-size="40px" letter-spacing="0px" word-spacing="0px" style="line-height:125%" xml:space="preserve">
                       <tspan x="352.30161" y="723.78192"/>
                       </text>
                   <g transform="matrix(.80562 0 0 .80562 81.4 -19.868)">
                   <g transform="translate(1173.1 -80.938)" stroke-linecap="round" stroke-linejoin="round">
                   <path transform="matrix(-.46631 .80802 -.80768 -.46651 -304.88 496.69)" d="m823.84 632.91h-835.52l417.76-723.57z" opacity=".51899" stroke="#000" stroke-width="112.56"/>
                   <path transform="matrix(-.46631 .80802 -.80768 -.46651 -304.88 496.69)" d="m823.84 632.91h-835.52l417.76-723.57z" fill="none" stroke="#fff" stroke-width="107.2"/>
                   <path transform="matrix(-.46631 .80802 -.80768 -.46651 -304.88 496.69)" d="m823.84 632.91h-835.52l417.76-723.57z" fill="#fff" stroke="#f00" stroke-width="75.041"/>
                   </g>
                   <g transform="matrix(.70711 .70711 -.70711 .70711 997.43 652.92)" stroke="#000" stroke-width="1.0065">
                   <rect transform="scale(-1,1)" x="465.77" y="210.96" width="68.469" height="373.94"/>
                   <rect transform="matrix(0,-1,-1,0,0,0)" x="-432.16" y="313.03" width="68.469" height="373.94"/>
                   </g>
                   </g>
                   </g>
                   <metadata>
                   <rdf:RDF>
                   <cc:Work>
                   <dc:format>image/svg+xml</dc:format>
                   <dc:type rdf:resource="http://purl.org/dc/dcmitype/StillImage"/>
                   <cc:license rdf:resource="http://creativecommons.org/licenses/publicdomain/"/>
                   <dc:publisher>
                   <cc:Agent rdf:about="http://openclipart.org/">
                   <dc:title>Openclipart</dc:title>
                   </cc:Agent>
                   </dc:publisher>
                   <dc:title/>
                   <dc:date>2012-11-25T03:20:35</dc:date>
                   <dc:description>Road, Sign, France</dc:description>
                   <dc:source>https://openclipart.org/detail/173248/-by-desmoric-173248</dc:source>
                   <dc:creator>
                   <cc:Agent>
                   <dc:title>Desmoric</dc:title>
                   </cc:Agent>
                   </dc:creator>
                   <dc:subject>
                   <rdf:Bag>
                   <rdf:li>France</rdf:li>
                   <rdf:li>Road</rdf:li>
                   <rdf:li>Sign</rdf:li>
                   </rdf:Bag>
                   </dc:subject>
                   </cc:Work>
                   <cc:License rdf:about="http://creativecommons.org/licenses/publicdomain/">
                   <cc:permits rdf:resource="http://creativecommons.org/ns#Reproduction"/>
                   <cc:permits rdf:resource="http://creativecommons.org/ns#Distribution"/>
                   <cc:permits rdf:resource="http://creativecommons.org/ns#DerivativeWorks"/>
                   </cc:License>
                   </rdf:RDF>
                   </metadata>
               </svg>
                   
           </div> 
           <div>
               <h1 class="red">Authentication Error</h1>
               <p class="text-lg font-bold">Buyer has to (LOGIN or REGISTER) first to complete this process.</p>
           </div>
       </div>
       <div class="flex flex-col md:flex-row items-center justify-center space-x-4">
            <!-- start button component with eye -->
            <a href="{{route('login')}}" class="btn max-w-max flex items-center px-4 py-1 space-x-2 rounded-full background-ternary shadow-md shadow-gray-3">
                <span class=" text-lg font-bold black uppercase">LOGIN NOW</span>
                <span>
                    <svg width="18" height="18" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.16663 6.99999H12.8333M12.8333 6.99999L6.99996 1.16666M12.8333 6.99999L6.99996 12.8333" class=" stroke-black" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
            </a>
            <!-- end button component with eye -->
            <div class=" text-2xl font-bold">OR</div>
            <!-- start button component with arrow -->
            <a href="{{route('register')}}" class="btn max-w-max flex items-center px-4 py-1 space-x-2 rounded-full background-primary shadow-md shadow-gray-3">
                <span class=" text-lg font-bold white uppercase">REGISTER NOW</span>
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
<!-- ////////// buyer Authentication warning end ///////// -->



    {{-- this javascript settings current product collection from ProductController to javascript loacal hoast memory
    each time we request prodcut page then new currect product set again --}}
    <script>
        var productFromProductControllerToProductPage = {!! json_encode($product->toArray(), JSON_HEX_TAG) !!}
        // var product = {{ $product->toJson() }};
        window.sessionStorage.setItem('productFromProductControllerToProductPage', JSON.stringify(productFromProductControllerToProductPage));
        
        // console.log("$product->toJson()...",productFromProductControllerToProductPage);
        // console.log('[productFromProductControllerToProductPage getting...]');
        // console.log(JSON.parse(window.sessionStorage.getItem('productFromProductControllerToProductPage')));

        window.addEventListener('load',function(){
            // getting first page of commetns of this product initlizing
            let productPageCommentData = JSON.parse(window.sessionStorage.getItem('productFromProductControllerToProductPage'));
            fetchProductPageCommentData(productPageCommentData.id);
        });

    </script>
@endsection