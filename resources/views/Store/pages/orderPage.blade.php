@extends('Store.app') 

@section('app')
<!-- ////////// START order SECTION ///////// -->
        
<section  class="max-w-[1440px] w-11/12 relative z-10 mx-auto mt-10 p-12 background-white rounded-xl shadow-lg shadow-gray-3 overflow-hidden">
    <!-- product detail start -->
    <div>
        <h2 class="flex capitalize border-b-4 border-gray-3 mb-4 opacity-80">
            Product Detail
        </h2>
        <div class=" flex flex-col lg:flex-row space-x-4 items-center">
            <span>
                <img width="200" height="200" class=" rounded-xl border-2 border-gray-3 p-4" src="{{asset($product->image_1)}}" alt="">
            </span>
            <div class=" space-y-4">

                <h2>{{$product->title}} </h2>
                
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
                <!-- start button component with quantity -->
                <div class="flex items-center space-x-4">
                    <span class=" text-2xl">Quantity: </span>
                    <button class="max-w-max flex items-center px-4 py-1 space-x-2 rounded-full background-gray-1 shadow-md shadow-gray-3">
                        
                        <span id="orderPage-quantity-minus" class=" text-lg font-bold uppercase">
                            <?xml version="1.0"?>
                            <svg class=" fill-black width="30" height="30" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" xml:space="preserve"><rect height="64" width="384" x="64" y="224"/></svg>
                        </span>
                        <span id="orderPage-quantity-body" class=" text-2xl font-bold uppercase">1</span>
                        <span id="orderPage-quantity-plus" class=" text-lg font-bold uppercase">
                            <?xml version="1.0"?>
                            <svg width="30px"  height="30px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 50 50"  id="Layer_1" version="1.1" viewBox="0 0 50 50" xml:space="preserve"><rect fill="none"/><line fill="none" class=" stroke-black" stroke-miterlimit="10" stroke-width="4" x1="9" x2="41" y1="25" y2="25"/><line fill="none" class=" stroke-black" stroke-miterlimit="10" stroke-width="4" x1="25" x2="25" y1="9" y2="41"/></svg>
                        </span>
                    </button>
                </div>
                <!-- end button component with quantity -->
            </div>
        </div>
    </div>
    <!-- product detail end -->
    <!-- buyer detail start -->
    <div class=" mt-12">
        <h2 class="flex capitalize border-b-4 border-gray-3 mb-4 opacity-80">
            Buyer Detail
        </h2>
        <!-- buyer data start  -->
        <div>
            <div class=" flex flex-col justify-center border-2 border-gray-3 rounded-xl p-4 my-4">
                <div class=" flex items-center space-x-4 border-b-2 border-gray-3 pb-4 mb-4">
                    <span class=" w-20 h-20 overflow-hidden rounded-[100%] border-4 border-gray-3">
                        <img width="80" height="80" src="{{asset($buyer->profile_image)}}" alt="">
                    </span>
                    <div>
                        <h2 class=" primary">{{$buyer->first_name}} {{$buyer->last_name}}</h2>
                    </div>
                </div>
                <div class=" flex flex-col text-lg font-bold space-y-2">
                    <span><span class=" secondary-2">Email:</span> {{$buyer->email}}</span>
                    <span><span class=" secondary-2">Phone Number:</span> 0{{$buyer->phone_number}}</span>
                    <span><span class=" secondary-2">Home Address:</span> {{$buyer->address}}</span> 
                    <span><span class=" secondary-2">Account Status:</span> <span class=" red">{{$buyer->status}}</span> </span>
                </div>
            </div>              
        </div>
        <!-- buyer data end -->
    </div>
    <!-- buyer detail end -->

    <form action="{{route('buyer.placeOrder')}}" method="POST" class="w-full">
        @csrf
        <input type="hidden" name="product_id" value="{{$product->id}}">
        <input id="orders-quantity" type="hidden" name="quantity" value="1">
        <!-- shipping address start -->
        <div>
            <div class=" mt-12">
                <h2 class="flex capitalize border-b-4 border-gray-3 opacity-80">
                    Your Shipping Address
                </h2>
            </div>
            <!-- shipping input field start -->
            <div id="order-shipping-address" class=" flex flex-col w-full p-4 pl-0 ">
                <label for="order_shipping_address" class=" text-sm">Shipping Address:</label>
                <input type="text" name="order_shipping_address" id="order_shipping_address" required placeholder="enter your shipping address where we can delever this product" class=" @error('order_shipping_address') !border-red-500 @enderror w-full rounded-md p-1 pl-4 border-2 border-gray-5 background-gray-1">
                @error('order_shipping_address')
                    <h3 class="red">{{ $message }}</h3>
                @enderror
            </div>
            <!-- end shipping field -->
             <!-- shipping input field start -->
             <div id="order-shipping-address" class=" flex flex-col w-full p-4 pl-0 ">
                <label for="order_description" class=" text-sm">Description:</label>
                <textarea name="order_description" id="order_description" cols="30" rows="10" placeholder="please describe about product" class=" w-full rounded-md p-1 pl-4 border-2 border-gray-5 background-gray-1"></textarea>
            </div>
            <!-- end shipping field -->
        </div>
        <!-- shipping address end -->

            <!-- payment method start -->
            <div>
                <div class=" mt-8">
                <h2 class="flex capitalize border-b-4 border-gray-3 opacity-80">
                    Choose Payment Method
                </h2>
            </div>
            <div class=" flex flex-col lg:flex-row space-y-4 lg:space-y-0 content-between space-x-4 mt-8">
                <span class="cursor-pointer flex border-4 border-secondary background-gray-2 rounded-xl p-3">
                    <label class="h-full flex flex-col justify-between items-center" for="cash_delivery_payment_method" id="cash_delivery_payment_method_label">
                        <span class="w-40 h-40 flex overflow-hidden border-b-2 pb-2 border-gray-3">
                            <img width="200" src="{{asset('assets/images/payment/cashOnDelivery.png')}}" alt="">
                        </span>
                        <h3 class="secondary mt-4">Cash on Delivery</h3>
                    </label>
                    <input class="hidden" type="radio" name="order_payment_method" id="cash_delivery_payment_method" checked>
                </span>
                <span class="flex border-4 border-gray-3 rounded-xl p-3">
                    <label class=" cursor-pointer flex flex-col justify-between items-center" for="jazz_cash_payment_method" id="jazz_cash_payment_method_label">
                        <span class="w-40 h-40 flex overflow-hidden border-b-2 pb-2 border-gray-3">
                            <img width="200" src="{{asset('assets/images/payment/jazzCash.png')}}" alt="">
                        </span>
                        <h3 class="secondary mt-4">Jazz Cash</h3>
                    </label>
                    <input class="hidden" type="radio" name="order_payment_method" id="jazz_cash_payment_method" >
                </span>
                <span class="flex border-4 border-gray-3 rounded-xl p-3">
                    <label class=" cursor-pointer flex flex-col justify-between items-center" for="easypiasa_payment_method" id="easypiasa_payment_method_label">
                        <span class="w-40 h-40 flex overflow-hidden border-b-2 pb-2 border-gray-3">
                            <img width="200" src="{{asset('assets/images/payment/easypaisa.png')}}" alt="">
                            
                        </span>
                        <h3 class="secondary mt-4">Easypaisa</h3>
                    </label>
                    <input class="hidden" type="radio" name="order_payment_method" id="easypiasa_payment_method" >
                </span>
            </div>
            </div>
        <!-- payment method end -->
            <!-- start button component with arrow -->
            <button class="btn w-1/2 mx-auto flex justify-center items-center px-4 py-2 mt-12 space-x-2 rounded-full background-primary shadow-md shadow-gray-3">
            <span class=" text-lg font-bold white uppercase">PLACE ORDER</span>
            <span>
                <svg width="18" height="18" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.16663 6.99999H12.8333M12.8333 6.99999L6.99996 1.16666M12.8333 6.99999L6.99996 12.8333" class=" stroke-white" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>
            </button>
        <!-- end button component with arrow -->
    </form>


</section>
<!-- payment method choose script start -->
<script>
    // input radio fields
    let cashDelivery = document.querySelector("#cash_delivery_payment_method"); 
    let jazzCash = document.querySelector("#jazz_cash_payment_method"); 
    let easyPaisa = document.querySelector("#easypiasa_payment_method"); 
    console.log(cashDelivery);
    console.log(jazzCash);
    console.log(easyPaisa);
    // label for input radio fields
    let cashdeliveryLabel = document.querySelector("#cash_delivery_payment_method_label"); 
    let jazzCashLabel = document.querySelector("#jazz_cash_payment_method_label"); 
    let easyPaisaLabel = document.querySelector("#easypiasa_payment_method_label"); 
    console.log(cashdeliveryLabel);
    console.log(jazzCashLabel);
    console.log(easyPaisaLabel);

    cashdeliveryLabel.addEventListener('click',function(event){
        console.log('cash deliver lable event working...');
        cashDelivery.checked = true;
        jazzCash.checked = false;
        easyPaisa.checked = false;

        cashdeliveryLabel.parentNode.classList.add('border-secondary')
        cashdeliveryLabel.parentNode.classList.add('background-gray-2')
        cashdeliveryLabel.parentNode.classList.remove('border-gray-3')
        
        jazzCashLabel.parentNode.classList.add('border-gray-3');
        jazzCashLabel.parentNode.classList.remove('background-gray-2')
        jazzCashLabel.parentNode.classList.remove('border-secondary')


        easyPaisaLabel.parentNode.classList.add('border-gray-3');
        easyPaisaLabel.parentNode.classList.remove('background-gray-2')
        easyPaisaLabel.parentNode.classList.remove('border-secondary')


    });

    jazzCashLabel.addEventListener('click',function(event){
        console.log('jazzCash lable event working...');

        cashDelivery.checked = false;
        jazzCash.checked = true;
        easyPaisa.checked = false;

        jazzCashLabel.parentNode.classList.add('border-secondary')
        jazzCashLabel.parentNode.classList.add('background-gray-2')
        jazzCashLabel.parentNode.classList.remove('border-gray-3')
        
        cashdeliveryLabel.parentNode.classList.add('border-gray-3');
        cashdeliveryLabel.parentNode.classList.remove('background-gray-2')
        cashdeliveryLabel.parentNode.classList.remove('border-secondary')


        easyPaisaLabel.parentNode.classList.add('border-gray-3');
        easyPaisaLabel.parentNode.classList.remove('background-gray-2')
        easyPaisaLabel.parentNode.classList.remove('border-secondary')

    });

    easyPaisaLabel.addEventListener('click',function(event){
        console.log('easypaisa lable event working...');

        cashDelivery.checked = false;
        jazzCash.checked = false;
        easyPaisa.checked = true;

        easyPaisaLabel.parentNode.classList.add('border-secondary')
        easyPaisaLabel.parentNode.classList.add('background-gray-2')
        easyPaisaLabel.parentNode.classList.remove('border-gray-3')
        
        cashdeliveryLabel.parentNode.classList.add('border-gray-3');
        cashdeliveryLabel.parentNode.classList.remove('background-gray-2')
        cashdeliveryLabel.parentNode.classList.remove('border-secondary')

        jazzCashLabel.parentNode.classList.add('border-gray-3');
        jazzCashLabel.parentNode.classList.remove('background-gray-2')
        jazzCashLabel.parentNode.classList.remove('border-secondary')

    });


</script>
<!-- payment method choose script start -->

<script>
    (function(){

    let ordersQuantityForm = document.querySelector('#orders-quantity');

    let minusButton = document.querySelector('#orderPage-quantity-minus');
    let plusButton = document.querySelector('#orderPage-quantity-plus');
    let quantityBody = document.querySelector('#orderPage-quantity-body');
    

    //start setting quantity value from product page to order pate
    let quantityFromProductPage = window.sessionStorage.getItem('BUYER_CURRENT_PRODUCT_QUANTITY');
    if(quantityFromProductPage){
        const quantityFromProductPageArray = quantityFromProductPage.split(':');
        let buyer_id =  quantityFromProductPageArray[0];
        let product_id = quantityFromProductPageArray[1];
        let quantity = quantityFromProductPageArray[2];
        console.log(product_id);

        const pathArray = window.location.pathname.split('/');
        product_id_from_current_url = pathArray[pathArray.length-1];

        if(product_id == product_id_from_current_url){
            quantityBody.textContent = quantity;
            ordersQuantityForm.value = quantity;
        }
    }

    //end setting quantity value from product page to order pate


    let quantityForLocalHost = 1;

    minusButton.addEventListener('click',function(){
        let quantity = parseInt(quantityBody.textContent);

        if (quantity > 1){
            quantityBody.textContent = quantity-1;
            quantityForLocalHost = quantity-1;
            ordersQuantityForm.value = quantityForLocalHost;

        }
    });

    plusButton.addEventListener('click',function(){
        let quantity = parseInt(quantityBody.textContent);

        if (quantity < 50){
            quantityBody.textContent = quantity+1;
            quantityForLocalHost = quantity+1;
            ordersQuantityForm.value = quantityForLocalHost;


        }
    });

}());
</script>
<!-- ////////// END order SECTION ///////// -->
@endsection
