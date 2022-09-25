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

    <!-- /////////////// COLOR PALLETE START ////////// -->
    @include('Store.components.color-palletes')
    <!-- /////////////// COLOR PALLETE END ////////// -->

    <div id="root" class=" w-full h-full">
        <!-- theme setting start -->
        <div id="theme-settings" class=" cursor-pointer flex justify-end font-bold mr-10 mt-10">
           <span class="py-1 px-4 border-4 border-gray-3 rounded-xl background-white">Theme Settings</span>
        </div>
        <!-- theme setting end -->
        <div class="container w-[600px] my-6 mx-auto flex flex-col background-white shadow-lg shadow-gray-500 rounded-xl overflow-hidden ">
            <div id="header" class=" background-primary w-full h-14 flex justify-center items-center relative z-10 overflow-hidden">
                <h2 class=" white">Online Electronic Accessories Portal</h2>
                <!-- right yello circle -->
                <div class=" w-44 h-20 background-ternary rounded-[50%] absolute -right-12 -top-1 -z-10"></div>
            </div>

            <div id="body" class=" w-4/5 mx-auto flex flex-col justify-center items-center">
                
                @include('Store.components.alertMessages')
                @if(session()->has('successPassChanged'))
                    <div class="flex justify-start items-center p-1 ml-4 green font-bold">{{ session()->get("successPassChanged") }}</div>
                @endif

                <form action="{{route('login')}}" method="post" class="w-full p-4 ">
                    @csrf
                    <input type="hidden" id="redirectProductIdforBuyerAfterLogin" name='redirectProductIdforBuyerAfterLogin' value="-1">
                    <!-- email input field start -->
                    <div id="email-feild" class=" flex flex-col w-full p-4 pl-0 ">
                        <label for="email" class=" text-sm">Email Address:</label>
                        <input type="email" name="email" id="email" required placeholder="e.g. BC1800400920@vu.edu.pk" class=" @error('order_shipping_address') !border-red-500 @enderror placeholder:gray-5 w-full rounded-md p-1 pl-4 border-2 border-gray-5 background-gray-1">
                        @error('email')
                            <h3 class="red">{{ $message }}</h3>
                        @enderror
                    </div>
                    <!-- end email field -->

                    <!-- password input field start -->
                    <div id="password-feild" class=" flex flex-col w-full p-4 pl-0 ">
                        <label for="password" class=" text-sm">Password:</label>
                        <input type="text" name="password" id="password" required placeholder="***************"  class=" @error('order_shipping_address') !border-red-500 @enderror placeholder:gray-5 w-full rounded-md p-1 pl-4 border-2 border-gray-5 background-gray-1">
                        @error('password')
                            <h3 class="red">{{ $message }}</h3>
                        @enderror
                    </div>
                    <!-- end password field -->

                    <!-- radio fields start -->
                    <div id="role" class=" flex flex-col w-full p-4 pl-0 ">
                        <span class=" text-sm">Login as:</span>
                        <div  class="flex w-full border-2 border-gray-5 background-gray-1 rounded-full overflow-hidden">
                            <!-- buyer role radio button-->
                            <input type="radio" name="role" value="buyer" id="buyer" checked class=" hidden">
                            <label for="buyer" id="buyer-label" class="checked-yellow background-gray-2 w-1/2 p-1 font-bold text-center border-r-2 border-gray-5 cursor-pointer">
                                Buyer 
                            </label>
                            <!-- supplier role radio button-->
                            <input type="radio" name="role" value="supplier" id="supplier" class=" hidden">
                            <label for="supplier" id="supplier-label" class="background-gray-2 w-1/2 p-1 font-bold text-center border-r-2 border-gray-5 cursor-pointer">
                                Supplier 
                            </label>
                            <!-- admin role radio button-->
                            <input type="radio" name="role" value="admin" id="admin" class=" hidden">
                            <label for="admin" id="admin-label" class=" background-gray-2 w-1/2 p-1 font-bold text-center cursor-pointer">
                                Admin
                            </label>
                        </div>
                    </div>
                    <!-- end radio fields -->

                    <!-- button comoponenet start -->
                    <!-- login button -->
                    <div class=" w-full flex justify-center items-center p-8">
                        <button id="login-button" class=" background-primary max-w-max flex justify-center items-center py-1 px-8 border-2 border-primary rounded-full space-x-2 shadow-md shadow-gray-500 hover:opacity-70">
                            <span class=" white font-bold">LOGIN</span>
                            <!-- right arrow -->
                            <svg width="19" height="12" viewBox="0 0 19 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 6H17.5M17.5 6L12.5 1M17.5 6L12.5 11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" stroke-white"/>
                            </svg>
                        </button>
                    </div>
                    <!-- end button comoponenet -->
                </form>
            </div>
            <!-- end login body -->
            <div id="footer" class="w-full flex justify-end p-8 pt-0 ">
                <div>Create New Account <a href="{{route('register')}}" class=" secondary-2 font-bold underline">Register</a> </div>
            </div>
        </div>
    </div>
    <!-- end root -->

    <script src="{{asset('assets/js/vendors/axios.min.js')}}"></script>
    <script src="{{asset('assets/js/colorPallete.js')}}"></script>

    <script>
        
        // label for input radio fields
        let buyerRoleLable = document.querySelector("#buyer-label"); 
        let adminRoleLable = document.querySelector("#admin-label"); 
        let supplierRoleLable = document.querySelector("#supplier-label"); 

        // input radio fields
        let buyerRoleInput = document.querySelector("#buyer"); 
        let adminRoleInput = document.querySelector("#admin"); 
        let supplierRoleInput = document.querySelector("#supplier"); 

        console.log(buyerRoleLable);
        console.log(adminRoleLable);

        buyerRoleLable.addEventListener('click',function(event){
            console.log('buyer role lable event working...');
            buyerRoleInput.checked = true;
            adminRoleInput.checked = false;
            supplierRoleInput.checked = false;

            buyerRoleLable.classList.add('checked-yellow');
            adminRoleLable.classList.remove('checked-yellow');
            supplierRoleLable.classList.remove('checked-yellow');
        });

        adminRoleLable.addEventListener('click',function(event){
            console.log('admin role lable event working...');
            buyerRoleInput.checked = false;
            supplierRoleInput.checked = false;
            adminRoleInput.checked = true;

            buyerRoleLable.classList.remove('checked-yellow');
            supplierRoleLable.classList.remove('checked-yellow');
            adminRoleLable.classList.add('checked-yellow');
        });

        supplierRoleLable.addEventListener('click',function(event){
            console.log('supplier role lable event working...');
            
            supplierRoleInput.checked = true;
            buyerRoleInput.checked = false;
            adminRoleInput.checked = false;

            buyerRoleLable.classList.remove('checked-yellow');
            adminRoleLable.classList.remove('checked-yellow');
            supplierRoleLable.classList.add('checked-yellow');
        });


    </script>

    <script>
        (function(){
            let redirectProductIdforBuyerAfterLogin = document.querySelector('#redirectProductIdforBuyerAfterLogin');
           let product_id = window.sessionStorage.getItem('redirectProductIdforBuyerAfterLogin');

           redirectProductIdforBuyerAfterLogin.setAttribute('value',product_id);

        }());
    </script>
     
</body>
</html>