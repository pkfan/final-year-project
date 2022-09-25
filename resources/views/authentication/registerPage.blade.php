<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>

    <link rel="stylesheet" href="{{asset('assets/css/tailwind.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/loader.css')}}">

<style>
    #shopStateautocomplete-list{
        background: var(--white)
    }
    #shopCityautocomplete-list{
        background: var(--white)
    }
    .autocomplete-items {
    position: absolute;
    border: 1px solid var(--gray-2);
    border-bottom: none;
    border-top: none;
    z-index: 99;
    /*position the autocomplete items to be the same width as the container:*/
    top: 100%;
    left: 0;
    right: 0;

    height: 300px;
    overflow-y: scroll;

    box-shadow: 0 0 10px 5px var(--gray-3);
    }
    .autocomplete-items div {
    padding: 10px;
    cursor: pointer;
    background-color: var(--white);
    border-bottom: 1px solid var(--gray-3);
    }
    .autocomplete-items div:hover {
    /*when hovering an item:*/
    background-color: var(--gray-1);
    }
    .autocomplete-active {
    /*when navigating through the items using the arrow keys:*/
    background-color: var( --ternary) !important;
    color: var(--black);
    }
</style>

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
        <div class="container max-w-[600px] my-6 mx-auto flex flex-col background-white shadow-lg shadow-gray-500 rounded-xl  ">
            <div id="header" class=" background-primary w-full h-14 flex justify-center items-center relative z-10 overflow-hidden rounded-tl-xl rounded-tr-xl">
                <h2 class=" white">Online Electronic Accessories Portal</h2>
                <!-- right yello circle -->
                <div class=" w-44 h-20 background-ternary rounded-[50%] absolute -right-12 -top-1 -z-10"></div>
            </div>

            <div id="body" class=" w-4/5 mx-auto flex flex-col justify-center items-center">
                
                @include('Store.components.alertMessages')

                <form autocomplete="off" action="{{route('register')}}" method="post" class="w-full px-4 py-2 ">
                    <div class=" my-4">
                        <h3 class="flex capitalize border-b-4 border-gray-3 opacity-80">
                            Personal Information
                        </h3>
                    </div>


                    @csrf
                    <input type="hidden" id="redirectProductIdforBuyerAfterLogin" name='redirectProductIdforBuyerAfterLogin' value="-1">
                    <!-- first name input field start -->
                    <div id="firstName-feild" class=" flex flex-col w-full px-4 py-2 pl-0 ">
                        <label for="firstName" class=" text-sm">First Name:</label>
                        <input type="text" name="firstName" id="firstName" required placeholder="e.g. Muhammad" value="{{old('firstName')}}" class=" @error('firstName') !border-red-500 @enderror placeholder:gray-5 w-full rounded-md p-1 pl-4 border-2 border-gray-5 background-gray-1">
                        @error('firstName')
                            <div class="red">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- end first name field -->
                     <!-- last name input field start -->
                     <div id="lastName-feild" class=" flex flex-col w-full px-4 py-2 pl-0 ">
                        <label for="lastName" class=" text-sm">Last Name:</label>
                        <input type="text" name="lastName" id="lastName" required placeholder="e.g. Amir" value="{{old('lastName')}}" class=" @error('lastName') !border-red-500 @enderror placeholder:gray-5 w-full rounded-md p-1 pl-4 border-2 border-gray-5 background-gray-1">
                        @error('lastName')
                            <div class="red">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- end last name field -->
                    <!-- email input field start -->
                    <div id="email-feild" class=" flex flex-col w-full px-4 py-2 pl-0 ">
                        <label for="email" class=" text-sm">Email Address:</label>
                        <input type="email" name="email" id="email" required placeholder="e.g. BC1800400920@vu.edu.pk" value="{{old('email')}}"  class=" @error('email') !border-red-500 @enderror placeholder:gray-5 w-full rounded-md p-1 pl-4 border-2 border-gray-5 background-gray-1">
                        @error('email')
                            <div class="red">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- end email field -->

                    <!-- password input field start -->
                    <div id="password-feild" class=" flex flex-col w-full px-4 py-2 pl-0 ">
                        <label for="password" class=" text-sm">Password:</label>
                        <input type="text" name="password" value="{{old('password')}}" id="password" required placeholder="***************"  class=" @error('password') !border-red-500 @enderror placeholder:gray-5 w-full rounded-md p-1 pl-4 border-2 border-gray-5 background-gray-1">
                        @error('password')
                            <div class="red">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- end password field -->

                    <!-- address input field start -->
                    <div id="address-feild" class=" flex flex-col w-full px-4 py-2 pl-0 ">
                        <label for="address" class=" text-sm">Address:</label>
                        <input type="address" name="address" value="{{old('address')}}" id="address" required placeholder="e.g. House 10 ghoar chowk serhali road Mustafabad" class=" @error('address') !border-red-500 @enderror placeholder:gray-5 w-full rounded-md p-1 pl-4 border-2 border-gray-5 background-gray-1">
                        @error('address')
                            <div class="red">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- end email field -->
                     <!-- address input field start -->
                     <div id="phone-feild" class=" flex flex-col w-full px-4 py-2 pl-0 ">
                        <label for="phone" class=" text-sm">Phone Number:</label>
                        <input type="phone" name="phone" value="{{old('phone')}}" id="phone" required placeholder="e.g. 03186323046" class=" @error('phone') !border-red-500 @enderror placeholder:gray-5 w-full rounded-md p-1 pl-4 border-2 border-gray-5 background-gray-1">
                        @error('phone')
                            <div class="red">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- end email field -->

                    <!-- radio fields start -->
                    <div id="role" class=" flex flex-col w-full px-4 py-2 pl-0 ">
                        <span class=" text-sm">Register as:</span>
                        <div  class="flex w-full border-2 border-gray-5 background-gray-1 rounded-full overflow-hidden">
                            <!-- buyer role radio button-->
                            <input type="radio" name="role" value="buyer" id="buyer" checked class=" hidden">
                            <label for="buyer" id="buyer-label" class="checked-yellow background-gray-2 w-1/2 p-1 font-bold text-center border-r-2 border-gray-5 cursor-pointer">
                                Buyer 
                            </label>
                            <!-- supplier role radio button-->
                            <input type="radio" name="role" value="supplier" id="supplier" class=" hidden">
                            <label for="supplier" id="supplier-label" class="background-gray-2 w-1/2 p-1 font-bold text-center border-gray-5 cursor-pointer">
                                Supplier 
                            </label>
                        </div>
                    </div>
                    <!-- end radio fields -->

                    {{-- ///////////////////// SHOP DETAIL START //////////////////// --}}
                    <div id="registerPage-shop-detail">
                        <div class=" mb-4 mt-8">
                            <h3 class="flex capitalize border-b-4 border-gray-3 opacity-80">
                                Tell us about your SHOP
                            </h3>
                        </div>
                        <!-- Shop name input field start -->
                        <div id="shopName-feild" class=" flex flex-col w-full px-4 py-2 pl-0 ">
                            <label for="shopName" class=" text-sm">Shop Name:</label>
                            <input type="text" name="shopName" value="{{old('shopName')}}" id="shopName" required placeholder="e.g. online electronic accessories" class=" @error('shopName') !border-red-500 @enderror placeholder:gray-5 w-full rounded-md p-1 pl-4 border-2 border-gray-5 background-gray-1">
                            @error('shopName')
                                <div class="red">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- end Shop name field -->
                         <!-- Shop Address input field start -->
                         <div id="shopAddress-feild" class=" flex flex-col w-full px-4 py-2 pl-0 ">
                            <label for="shopAddress" class=" text-sm">Shop Address:</label>
                            <input type="text" name="shopAddress" value="{{old('shopAddress')}}" id="shopAddress" required placeholder="e.g. shop No.20, Near Icchra Bus stop" class=" @error('shopAddress') !border-red-500 @enderror placeholder:gray-5 w-full rounded-md p-1 pl-4 border-2 border-gray-5 background-gray-1">
                            @error('shopAddress')
                                <div class="red">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- end Shop Address field -->
                        <!-- Shop shopState input field start -->
                        <div id="shopState-feild" class="autocomplete relative flex flex-col w-full px-4 py-2 pl-0 ">
                            <label for="shopState" class=" text-sm">Shop State:</label>
                            <input type="text" name="shopState" value="{{old('shopState')}}" id="shopState" required placeholder="e.g. Punjab" class=" @error('shopState') !border-red-500 @enderror placeholder:gray-5 w-full rounded-md p-1 pl-4 border-2 border-gray-5 background-gray-1">
                            @error('shopState')
                                <div class="red">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- end Shop shopState field -->
                          <!-- Shop shopCity input field start -->
                        <div id="shopCity-feild" class="autocomplete relative flex flex-col w-full px-4 py-2 pl-0 ">
                            <label for="shopCity" class=" text-sm">Shop City:</label>
                            <input type="text" name="shopCity" value="{{old('shopCity')}}" id="shopCity" required placeholder="e.g. Punjab" class=" @error('shopCity') !border-red-500 @enderror placeholder:gray-5 w-full rounded-md p-1 pl-4 border-2 border-gray-5 background-gray-1">
                            @error('shopCity')
                                <div class="red">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- end Shop shopCity field -->
                        {{-- <script>
                            autocomplete(document.getElementById("shopState"), registerPageStates);
                            autocomplete(document.getElementById("shopCity"), registerPageCities);
                        </script> --}}
                    </div>
                    
                    {{-- ///////////////////// SHOP DETAIL END //////////////////// --}}
                    <!-- button comoponenet start -->
                    <!-- login button -->
                    <div class=" w-full flex justify-center items-center p-8">
                        <button id="login-button" class=" background-primary max-w-max flex justify-center items-center py-1 px-8 border-2 border-primary rounded-full space-x-2 shadow-md shadow-gray-500 hover:opacity-70">
                            <span class=" white font-bold">REGISTER</span>
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
                <div>Already has an account <a href="{{route('login')}}" class=" secondary-2 font-bold underline">Login</a> </div>
            </div>
        </div>
    </div>
    <!-- end root -->

    <script src="{{asset('assets/js/vendors/axios.min.js')}}"></script>
    <script src="{{asset('assets/js/colorPallete.js')}}"></script>
    <script src="{{asset('assets/js/registerPage.js')}}"></script>

 

</body>
</html>