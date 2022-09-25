@extends('Store.app') 

@section('app')
    <!-- ////////// START HERO SLIDER ///////// -->
    <div id="hero-slider" class="splide max-w-[1570px] mx-auto overflow-hidden">
        
        <div class="splide__track py-8">
            <ul class="splide__list cursor-move flex">
                <!-- adding all hero slider products data 
                with javascript and apis -->
                @foreach ($heroSliderProducts as $heroSliderProduct)
                    <li class="splide__slide flex">
                        <section  class=" w-11/12 relative z-10 mx-auto mt-1 p-12 grid grid-cols-1 lg:grid-cols-2 gap-0 background-white rounded-xl shadow-lg shadow-gray-3 overflow-hidden">
                            <!-- effect background -->
                            <img class=" w-full h-full absolute right-0 bottom-0 -z-10 opacity-20" src="{{$heroSliderProduct['effect_image']}}" alt="">

                            <!-- left side -->
                            <div class=" w-full h-full pt-4 lg:pt-0 flex flex-col justify-between space-y-4 order-last lg:order-first">
                                <h1>
                                    {{$heroSliderProduct['title']}}
                                </h1>
                                <p>
                                    {{substr($heroSliderProduct["description"],0,140)}}
                                </p>
                                <div class="flex items-center">
                                    <!-- all rating stars -->
                                    <div class="flex items-center">
                                        <div id="hero-slider-stars-${number}" class="flex items-center">
                                            <!-- start start -->
                                                <!-- adding each star with javascript -->
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= round($heroSliderProduct["stars"]))
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
                                        <span class=" secondary-2  px-2">({{$heroSliderProduct["ratings"]}} Ratings)</span>
                                    </div>
                                    <!-- all rating stars end -->
                                    <!-- product brand -->
                                    <span class=" border-l border-black black px-2">Brand:<span class=" secondary-2 "> {{$heroSliderProduct["brand"]}}</span></span>
                                    <!-- product category -->
                                    <span class=" border-l border-black black px-2">Category:<span class=" secondary-2 "> {{$heroSliderProduct["category"]}}</span></span>
                                </div>
                                <div class="flex py-4">
                                    <span class=" self-end mr-2">from</span>
                                    <h1 class=" primary">Rs. {{number_format($heroSliderProduct["price"],0,".",",")}}</h1>
                                </div>
                                <div class="flex space-x-4">
                                    <!-- start button component with eye -->
                                    <a href="{{route('productPage',['product_id'=>$heroSliderProduct['id']])}}" class="btn max-w-max flex items-center px-4 py-1 space-x-2 rounded-full background-ternary shadow-md shadow-gray-3">
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
                                    <a href="{{route('buyer.order',['product_id'=>$heroSliderProduct['id']])}}" class="btn max-w-max flex items-center px-4 py-1 space-x-2 rounded-full background-primary shadow-md shadow-gray-3">
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
                            <!-- right side -->
                            <div class=" w-full h-full flex justify-center items-center">
                                <span class="flex justify-center items-center">
                                    <img class="flex justify-center items-center rounded-xl max-h-[400px]" src="{{asset($heroSliderProduct["image_1"])}}" alt="" width="400" height="400">
                                </span>
                            </div>
                        </section>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <!-- ////////// END HERO SLIDER ///////// -->

    <!-- ////////// START TABLETS SECTION ///////// -->
    <section id="tablet-section"  class="max-w-[1440px] min-h-[300px] w-11/12 relative mx-auto mt-2 background-white rounded-xl shadow-md shadow-gray-3 overflow-hidden">
        @php
            $categories = DB::table('categories')->select('categories.id', 'categories.name')->limit(5)->get();
            // dump($categories);
        @endphp
        <!-- tab links start -->
        <ul class=" px-8 flex items-center uppercase">
            {{-- <li><button class="active" id="1-tab-category" onclick="onClickCategoryTab(this);">LAPTOPS</button></li>
            <li><button id="2-tab-category" onclick="onClickCategoryTab(this);">SMART PHONES</button></li>
            <li><button id="3-tab-category" onclick="onClickCategoryTab(this);">TABLETS</button></li>
            <li><button id="4-tab-category" onclick="onClickCategoryTab(this);">COMPUTERS</button></li> --}}
            @foreach ($categories as $category)
                <li><button id="{{$category->id}}-tab-category" onclick="onClickCategoryTab(this);">{{$category->name}}</button></li>
            @endforeach
        </ul>
        <!-- tab links end -->
        <!-- start products cards and loaders -->
        <div>
            <!-- loader start -->
            <div id="tab-loader" class="absolute pt-12 pb-80 w-full h-full text-center background-white">
                <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
            </div>
            <!-- loader end -->
            <!--start all products cards -->
            <div id="tab-section-cards" class="flex justify-evenly flex-wrap py-4 ">

                <!-- start product card -->
                <!-- all cards inserted with javascript -->
                <!-- end product card -->
            </div>
            <!--end all products cards -->
        </div>
        <!-- end products cards and loaders -->

    </section>
    <!-- ////////// END TABLETS SECTION ///////// -->

    <!-- ////////// START ADS SECTION ///////// -->
    <section  class="max-w-[1440px] w-10/12 mx-auto mt-10 ">
        <img src="{{asset('assets/images/ads.gif')}}" alt="" width="100%">
    </section>
    <!-- ////////// END ADS SECTION ///////// -->



    <!-- ////////// START FEATURED PRODUCTS SECTION ///////// -->
    <section id="featured-section"  class="max-w-[1440px] w-11/12 min-h-[200px] relative mx-auto mt-10 background-white rounded-xl shadow-md shadow-gray-3 overflow-hidden">
        <!-- HEADER start -->
        <div class="w-full flex justify-between border-b-4 border-gray-3 -translate-y-1">
            <div class=" background-primary max-w-max flex items-center relative z-10 overflow-hidden translate-y-1">
                <h2 class="white capitalize pl-8 pr-24 py-3">featured products</h2>
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
            <!-- ////////// featured SLIDER ///////// -->
            <div id="featured-slider" class="splide w-[95%] mx-auto">
                <div class="splide__track py-4 !overflow-visible">
                    <ul class="splide__list cursor-move -translate-x-4">
                    @foreach ($featuredProducts as $featuredProduct)
                        <li class="w-full splide__slide mx-4 max-w-max flex">
                            <!-- start product card -->
                            <div class="my-4 min-w-[270px] w-[270px] flex flex-col border border-gray-2 rounded-xl hover:shadow-lg hover:shadow-gray-3 hover:-translate-y-4 transition-all duration-500 overflow-hidden">
                                <header class="w-10/12 h-1/2 min-h-[220px] mx-auto p-4 flex justify-center items-center">
                                    <img class=" rounded-md max-h-[220px]" src="{{asset($featuredProduct->image_1)}}" alt="" width="300">
                                </header>
                                <footer class="h-full background-gray-1 p-4 flex flex-col justify-between space-y-2">
                                    <!-- all rating stars -->
                                    <div class="flex items-center">
                                        <div id="featured-stars-${number}" class="flex items-center">
                                            <!-- start start -->
                                                <!-- adding each star with javascript -->
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= round($featuredProduct->stars))
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
                                        <span class=" secondary-2  px-2">{{$featuredProduct->ratings}} Ratings</span>
                                    </div>
                                    <!-- all rating stars end -->
                                    <h4>
                                        {{substr($featuredProduct->title,0,70)}}
                                    </h4>
                                    <p class=" text-xs">
                                        {{substr($featuredProduct->description,0,120)}}
                                    </p>
                                    <h3 class="self-end primary px-4 bg-gradient-to-tl from-[var(--green)]">
                                        Rs. {{number_format($featuredProduct->price,0,".",",")}}
                                       
                                    </h3>
                                    <!-- start button component with eye -->
                                    <a href="{{route('productPage',['product_id'=>$featuredProduct->id])}}" class="btn max-w-max self-center flex items-center px-4 py-1 !mt-6 !mb-3 space-x-2 rounded-full background-ternary shadow-md shadow-gray-3">
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
            <!-- ////////// END featured SLIDER ///////// -->


        </div>
        <!-- end products cards and loaders -->

    </section>
    <!-- ////////// END FEATURED PRODUCTS SECTION ///////// -->


    <!-- ////////// START NEW ARRIVALS PRODUCTS SECTION ///////// -->
    <section id="new-arrivals-section"  class="max-w-[1440px] w-11/12 min-h-[200px] relative mx-auto mt-10 background-white rounded-xl shadow-md shadow-gray-3 overflow-hidden">
        <!-- HEADER start -->
        <div class="w-full flex justify-between border-b-4 border-gray-3 -translate-y-1">
            <div class=" background-primary max-w-max flex items-center relative z-10 overflow-hidden translate-y-1">
                <h2 class="white capitalize pl-8 pr-24 py-3">New Arrivals</h2>
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
            <!-- ////////// new-arrivals SLIDER ///////// -->
            <div id="new-arrivals-slider" class="splide w-[95%] mx-auto">
                <div class="splide__track py-4 !overflow-visible">
                    <ul class="splide__list cursor-move -translate-x-4">
                        @foreach ($newArrivalProducts as $newArrivalProduct)
                        <li class="w-full splide__slide mx-4 max-w-max flex">
                            <!-- start product card -->
                            <div class="my-4 min-w-[270px] w-[270px] flex flex-col border border-gray-2 rounded-xl hover:shadow-lg hover:shadow-gray-3 hover:-translate-y-4 transition-all duration-500 overflow-hidden">
                                <header class="w-10/12 h-1/2 min-h-[220px] mx-auto p-4 flex justify-center items-center">
                                    <img class=" rounded-md max-h-[220px]" src="{{asset($newArrivalProduct->image_1)}}" alt="" width="300">
                                </header>
                                <footer class="h-full background-gray-1 p-4 flex flex-col justify-between">
                                    <p class=" secondary-2  self-end">
                                        {{ \Carbon\Carbon::parse($newArrivalProduct->created_at)->diffForHumans() }}
                                    </p>
                                    <h4>
                                        {{substr($newArrivalProduct->title,0,70)}}
                                    </h4>
                                    <p class=" text-xs">
                                        {{substr($newArrivalProduct->description,0,120)}}
                                    </p>
                                   
                                    <h3 class="self-end primary px-4 bg-gradient-to-tl from-[var(--green)]">
                                        Rs. {{number_format($newArrivalProduct->price,0,".",",")}}
                                    </h3>
                                    <!-- start button component with eye -->
                                    <a href="{{route('productPage',['product_id'=>$newArrivalProduct->id])}}" class="btn max-w-max self-center flex items-center px-4 py-1 !mt-6 !mb-3 space-x-2 rounded-full background-ternary shadow-md shadow-gray-3">
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
            <!-- ////////// END featured SLIDER ///////// -->


        </div>
        <!-- end products cards and loaders -->

    </section>
    <!-- ////////// END NEW ARRIVALS PRODUCTS SECTION ///////// -->

    <!-- ////////// START ADS SECTION ///////// -->
    <section  class="max-w-[1440px] w-10/12 mx-auto mt-10 ">
        <img src="{{asset('assets/images/ads2.webp')}}" alt="" width="100%">
    </section>
    <!-- ////////// END ADS SECTION ///////// -->

    <!-- ////////// START RECOMMENDED PRODUCTS SECTION ///////// -->
    <section id="recommended-section"  class=" max-w-[1440px] w-11/12 relative mx-auto mt-10 bg-transparent rounded-xl border border-gray-3 overflow-hidden">
        <!-- HEADER start -->
        <div class="w-full flex justify-between border-b-4 border-gray-3 -translate-y-1">
            <div class=" background-primary max-w-max flex items-center relative z-10 overflow-hidden translate-y-1">
                <h2 class="white capitalize pl-8 pr-24 py-3">Recommended products</h2>
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
        <div class=" w-full h-full">
            <!-- loader start -->
            <div id="recommended-loader" class="z-50 absolute pt-12 pb-80 w-full h-full text-center background-gray-1">
                <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
            </div>
            <!-- loader end -->
            <!--start all products cards -->
            <div id="recommended-section-cards" class="flex justify-evenly flex-wrap py-4 ">

                <!-- start product card -->
                <!-- all cards inserted with javascript -->
                <!-- end product card -->
                
            </div>
            <!--end all products cards -->
        </div>
        <!-- end products cards and loaders -->
        <div class="flex justify-center items-center mb-8">
            <!-- start button component with arrow -->
            <button id="recommended-load-more-button" onclick="onClickLoadMoreRecommeded(this);" class="background-white flex items-center px-4 py-1 space-x-2 rounded-full border-2 border-secondary-2 shadow-md shadow-gray-3">
                <span class=" text-lg font-bold secondary-2 uppercase">Load More</span>
            </button>
            <!-- end button component with arrow -->
        </div>
    </section>
    <!-- ////////// END RECOMMENDED PRODUCTS SECTION ///////// -->
    <script>
        // for tab section cards start
        // insert cards after window fully loaded
        window.addEventListener('load',function(){
            let tabCategory = document.querySelector('#tablet-section ul li button');
            // console.log('tab category...',tabCategory.getAttribute('id'));
            tabCategory.classList.add('active');

            tabCategoryId = parseInt(tabCategory.getAttribute('id'));
            // console.log('tab category id...', tabCategoryId);

            fetchTabCategoryData(tabCategoryId);
            // for(let i = 1; i <= 9; i++){
            //     createTabCards(i);
            // }
            hideLoader('#tab-loader');
            // showLoader('#tab-loader');
        });
    // for tab section cards end

    // for recommed section products cards start
        // insert cards after window fully loaded
    window.addEventListener('load',function(){
        fetchRecommendedSectionData(1);
        hideLoader('#recommended-loader');
    });
    // for recommed section products cards end

    </script>
@endsection