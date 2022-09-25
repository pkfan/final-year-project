<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{asset('assets/css/backToTop.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/tailwind.css')}}">

    <script src="{{asset('assets/js/vendors/axios.min.js')}}"></script>
    <script src="{{asset('assets/js/root.js')}}"></script>

</head>
<body class="bg-gray-100 ">
   @include('Store.components.back-to-top')
    @include('dashboard.components.alertMessages')
    <div id="root" class="w-screen flex">
        
        {{-- //// left side --}}
        {{-- ////////////START SIDEBAR NAVIGATION ///////////////// --}}
       @include('dashboard.components.sidebar')
        {{-- ////////////END SIDEBAR NAVIGATION ///////////////// --}}
        {{-- /////// right side --}}
        <div class=" w-11/12 mx-auto mt-20 mb-6 ">
            <div class="w-full">

                {{-- @include('dashboard.roles.buyer.profile') --}}
                @yield('app')

            </div>
        </div>
    </div>

    <script>
        (function(){
            let navigationList = document.querySelectorAll('#dashboarSidebar a li')
            
            // navigationList.forEach(element => {
            //     element.classList.remove('dashboard-sidebar-active');
            // });
            
            navigationList.forEach(element =>{
                let name = element.textContent.trim().toLowerCase();
                let hasName = window.location.pathname.toLowerCase().includes(name);

                if(hasName){
                    element.classList.add('dashboard-sidebar-active');
                }
            })

            console.log('navigationList', navigationList );
        }())
    </script>

   

    <script src="{{asset('assets/js/backToTop.js')}}"></script>
</body>
</html>