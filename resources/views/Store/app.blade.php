<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>

    <link rel="stylesheet" href="{{asset('assets/css/vendors/splide.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/tailwind.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/loader.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/backToTop.css')}}">
</head>
{{-- <body class="debug-screens background-gray-1 relative overflow-x-hidden"> --}}
<body class="background-gray-1 relative overflow-x-hidden">

    <!-- start preloader -->
    @include('Store.components.preloader-topbar')
    <!-- end preloader -->
    
    <div id="overlay" class=" overflow-hidden"></div>

    <!-- back to top button -->
   @include('Store.components.back-to-top')

    <!-- /////////////// COLOR PALLETE START ////////// -->
    @include('Store.components.color-palletes')
    <!-- /////////////// COLOR PALLETE END ////////// -->


    @include('Store.components.alertMessages')

    <div id="root" class="w-screen overflow-hidden">
        <!-- ////////// START NAVIGATION ///////// -->
        @include('Store.components.navigation')
        <!-- ////////// END NAVIGATION ///////// -->

        @yield('app')

        <!-- ////////// START FOOTER SECTION ///////// -->
        @include('Store.components.footer')
        <!-- ////////// END FOOTER SECTION ///////// -->

    </div>
    <script>
        /**************************
         * GETTING CURRENT BUYER AUTHENTICATED USER ID
         * AND SET IT TO CLIENT BROWSER FOR SOME AUTH WORK
         * ************************/
        var CURRENT_BUYER_AUTH_ID = {!! auth()->guard('buyer')->user()->id ?? -1 !!}
        window.sessionStorage.setItem('CURRENT_BUYER_AUTH_ID', CURRENT_BUYER_AUTH_ID);
    </script>


    <script src="{{asset('assets/js/vendors/axios.min.js')}}"></script>
    <script src="{{asset('assets/js/vendors/splide.min.js')}}"></script>
    
    <script src="{{asset('assets/js/colorPallete.js')}}"></script>
    <script src="{{asset('assets/js/root.js')}}"></script>
    <script src="{{asset('assets/js/navigation.js')}}"></script>
    <script src="{{asset('assets/js/homePage.js')}}"></script>
    <script src="{{asset('assets/js/productPage.js')}}"></script>
    <script src="{{asset('assets/js/backToTop.js')}}"></script>
    <script src="{{asset('assets/js/timeDefference.js')}}"></script>

    {{-- this is for home slider --}}
    <script>

        new Splide( '#hero-slider', {
            perPage: 1,
            perMove: 1,
            rewind : true,
            pagination: true,
            autoplay: true,
             }
         ).mount();
         
         
         const homeOptions =  {
            perPage: 4,
            perMove: 1,
            rewind : true,
            pagination: true,
            gap:'1rem',
            breakpoints: {
                 1360: {
                     perPage: 3,
                 },
                 1050: {
                     perPage: 2,
                 },
                 767: {
                     fixedWidth: '320px',
                     perPage: 1,
                 },
             }
         }
         new Splide( '#featured-slider',homeOptions).mount();
         new Splide( '#new-arrivals-slider',homeOptions).mount();
    </script>
     
     {{-- <script src="{{asset('assets/js/homePage.js')}}"></script> --}}
</body>
</html>