@extends('Store.app') 

@section('app')
<!-- ////////// START SEARCH results SECTION ///////// -->  
<section  class="max-w-[1440px] w-full flex space-x-4 relative z-10 mx-auto mt-4 p-8 overflow-hidden">
    <!-- left side filter section start -->
    <div class=" w-3/12 ">
        <div class="p-4 background-white rounded-xl shadow-lg shadow-gray-3 "> 
            <h4 class="mb-4  flex capitalize secondary border-b-4 border-gray-3 opacity-80">
                Filter by Locations
            </h4>
            <!-- start tree structure -->
            <ul class=" space-y-4">
                @php
                    $states = $filterByLocation['states'];
                    $stateOfCities = $filterByLocation['cities'];
                @endphp

                @foreach ($states as $state => $stateCount)
                    <li>
                        <a href="{{route('search_state_city_query_category',['state_city_query_category' => base64_encode($state. ':' . null . ':' . $search_query . ':' . $category_id)])}}">
                            <h4>{{$state}} <span class="secondary-2">({{$stateCount}})</span></h4>
                        </a> 
                        <ul class=" pl-6">
                            @foreach ($stateOfCities as $stateOfCityName => $stateOfCity )
                                @if($stateOfCityName == $state)
                                    @foreach ($stateOfCity as $city => $cityCount)
                                        <li class="transition-all duration-300 red-hover hover:pl-2"><a href="{{route('search_state_city_query_category',['state_city_query_category' => base64_encode($state. ':' . $city . ':' . $search_query . ':' . $category_id)])}}">
                                            {{$city}} <span class="secondary-2">({{$cityCount}})</span>
                                        </a></li>
                                    @endforeach
                                @endif
                                
                            @endforeach
                        </ul>
                    </li>
                    
                @endforeach

            </ul>
        <!-- end tree structure -->
        </div>


        <!-- ////////// START ADS SECTION ///////// -->
        <section  class="w-full mx-auto mt-10 ">
            <img src="{{asset('assets/images/ads5.webp')}}" alt="" width="100%">
        </section>
        <!-- ////////// END ADS SECTION ///////// -->
        <!-- ////////// START ADS SECTION ///////// -->
        <section  class="w-full mx-auto mt-10 ">
            <img src="{{asset('assets/images/ads4.webp')}}" alt="" width="100%">
        </section>
        <!-- ////////// END ADS SECTION ///////// -->
    </div>
    <!-- left side filter section end -->

    <!-- right side all product list section start -->
    <div class=" w-9/12 p-4 background-white rounded-xl shadow-lg shadow-gray-3 overflow-hidden">
        <h4 class="flex capitalize border-b-4 border-gray-3 opacity-80">
            {{-- Showing (25 of 43) results for <span class=" secondary-2 px-4"> (Asus Laptop 2020)</span> --}}
            {{-- pagination results start --}}
            <div>
                {!! __('Showing (') !!}
                @if ($productsSearchResults->firstItem())
                    <span class="secondary-2">{{ $productsSearchResults->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="secondary-2">{{ $productsSearchResults->lastItem() }}</span>
                @else
                    {{ $productsSearchResults->count() }}
                @endif
                {!! __(') of') !!}
                <span class="secondary-2">{{ $productsSearchResults->total() }}</span>
                {!! __('results') !!}
            </div>
            {{-- pagination results end --}}
            @if ($search_query != null || chop(' ', $search_query) == '')
                <span class="px-1"> for  (<span class=" secondary-2 px-1">{{$search_query}}</span>)</span> 
            @endif
            @if ($category_id != null)
                <span class="px-1"> for  (<span class=" secondary-2 px-1">{{DB::table('categories')->find($category_id)->name}}</span>)</span> 
            @endif
            {{-- @if ($searchedState != null) --}}
            @if ($searchedState ?? null)
                <span class="px-1"> of state <span class=" secondary-2 px-1">({{$searchedState}})</span></span> 
            @endif
            @if ($searchedCity ?? null)
                <span class="px-1"> and city <span class=" secondary-2 px-1">({{$searchedCity}})</span></span> 
            @endif
            

        </h4>

        <!-- start products cards and loaders -->
        <div class=" w-full h-full relative">
            <!-- loader start -->
            <!-- <div id="recommended-loader" class="z-50 absolute pt-12 pb-40 w-full h-full  text-center background-white overflow-hidden">
                <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
            </div> -->
            <!-- loader end -->
            <!--start all products cards -->
            <div id="recommended-section-cards" class="flex justify-evenly flex-wrap py-4 ">

                @foreach ($productsSearchResults as $productsSearchResult)
                <!-- start product card -->
                <a href="{{route('productPage',['product_id'=>$productsSearchResult->id])}}" class="my-4 w-[97%] flex flex-col md:flex-row background-gray-1 border border-gray-2 rounded-xl hover:shadow-lg hover:shadow-gray-3 hover:-translate-y-4 transition-all duration-500 overflow-hidden">
                    <header class="min-w-[100px] w-full md:w-2/3 lg:w-1/3 mx-auto p-4 flex justify-center items-center">
                        <img class=" rounded-md" src="{{asset($productsSearchResult->image_1)}}" alt="" width="300">
                    </header>
                    <footer class="w-full h-full p-4 flex flex-col justify-between space-y-2">
                        <h4 class=" text-base">
                            {{$productsSearchResult->title}}
                        </h4>
                        <p class=" text-xs">
                            {{substr($productsSearchResult->description,0,300)}}                    </p>
                        <div class="flex flex-col md:flex-row md:space-x-8 items-center">
                            <h3 class="md:self-end red px-4 bg-gradient-to-tl from-[var(--ternary)]">
                            Rs. {{number_format($productsSearchResult->price,0,".",",")}}
                            </h3>
                            
                            <!-- all rating stars -->
                                <div class="flex items-center">
                                    <div id="recommended-section-stars-${number}" class="flex items-center">
                                        <!-- all rating stars -->
                                        <div class="flex items-center">
                                            <div id="hero-slider-stars-${number}" class="flex items-center">
                                                <!-- start start -->
                                                    <!-- adding each star with javascript -->
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= round($productsSearchResult->stars))
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
                                        </div>
                                            <span class=" secondary-2  px-2">
                                                {{number_format($productsSearchResult->stars,1,".",",")}}
                                            </span>
                                        </div>
                                        <!-- all rating stars end -->
                                                            <!-- start start -->
                                            <!-- adding each star with javascript -->
                                        <!-- end start -->
                                    
                                        <!-- count rating -->
                                    </div>
                                </div>
                            <!-- all rating stars end -->

                            
                        </div>
                        

                    </footer>
                </a>
                <!-- end product card -->
                @endforeach 
            </div>
            <!--end all products cards -->
            {{-- Pagination --}}
            <div class=" flex justify-center w-full">
                {!! $productsSearchResults->appends(['search_query' => $search_query])->links() !!}
            </div>


            {{-- if results not found then show this one --}}
            @if($productsSearchResults->count() == 0)
            <div class=" flex flex-col items-center">
                <h2>Products were not found for 
                    @if ($search_query ?? null)
                        <span class=" secondary-2 px-1">({{$search_query}}) </span> keyword.
                    @else
                        this type.
                    @endif
                </h2>
                <img src="{{asset('assets/images/confused_resutls.png')}}" alt="" width="600" height="450">
            </div>
            @endif

        </div>
        <!-- end products cards and loaders -->
    </div>
    <!-- left side all product list section end -->

</section>
<!-- ////////// END SEARCH results SECTION ///////// -->
@endsection