@extends('dashboard.app') 

@section('app')

    @if (auth()->guard('supplier')->user()->status == 'pending')
        <div class=" space-y-8 mt-8">
            <h2>>> you cannot post New Product because your supplier account is in <span class="red">PENDING</span> status.</h2>
            <h2>>> Please wait 2 and 3 working days to <span class="green">APPROVE</span> your account by ADMIN.</h2>
            <h2>>> Soryy for inconvenience for this time.</h2>

            <div class="flex justify-center">
                <img src="{{asset('assets/images/confused_resutls.png')}}" alt="">
            </div>
        </div>
    @else
        <!-- button comoponenet start -->
        <!-- login button -->
        <div class=" w-full flex justify-center items-center pb-4">
            <a href="{{route('supplier.dashboard.product.createPage')}}" class=" bg-yellow-400 max-w-max flex justify-center items-center py-1 px-8 border-2 border-primary rounded-lg space-x-2 shadow-md shadow-gray-500 hover:opacity-70">
                <!-- right arrow -->
                <svg width="32pt" height="32pt" version="1.0" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                    <g transform="translate(0 66) scale(.1 -.1)">
                        <path d="m254 530c-13-5-31-32-47-72l-25-63-56-3c-48-3-56-6-56-22 0-13 7-20 19-20 15 0 21-15 36-91 27-136 23-134 205-134s178-2 205 134c15 76 21 91 36 91 12 0 19 7 19 20 0 16-8 19-56 22l-56 3-25 63c-18 45-33 66-50 73-30 11-120 11-149-1zm156-86c11-25 20-48 20-50s-45-4-100-4-100 2-100 4 9 25 20 50l19 46h61 61l19-46zm-63-145c3-11 17-25 30-30 29-11 26-33-5-37-14-2-22-11-22-23s-7-19-20-19-20 7-20 19-8 21-22 23c-29 4-35 28-8 35 12 3 26 16 31 29 11 30 29 31 36 3z"/>
                    </g>
                </svg>
                <h3 class="font-bold uppercase">Post New Product</h3>

            </a>
        </div>
        <!-- end button comoponenet -->

        {{-- filter results  --}}
        <form action="{{route('supplier.dashboard.product')}}">
            <div class="container flex flex-col bg-white shadow-lg p-4">
                <h3 class="flex capitalize border-b-4 border-gray-3 opacity-80 secondary">
                    Filter Your Product Data
                </h3>
                <div class="mt-4">
                    <h5 class=" text-lg font-bold ml-6">Show status type of:</h5>
                    {{-- options  --}}
                    <div class=" flex space-x-8 ml-10">
                        <div>
                            <input type="radio" name="status" id="products-all" value='all'>
                            <label class="cursor-pointer" for="products-all">All products</label>
                        </div>

                        <div>
                            <input type="radio" name="status" id="products-pending" value='pending'>
                            <label class="cursor-pointer" for="products-pending">Pending products</label>
                        </div>


                        <div>
                            <input type="radio" name="status" id="products-approved" value='approved'>
                            <label class="cursor-pointer" for="products-approved">Approved products</label>
                        </div>

                        <div>
                            <input type="radio" name="status" id="products-cancel" value='cancel'>
                            <label class="cursor-pointer" for="products-cancel">Cancel products</label>
                        </div>

                    </div>
                </div>

                <div class="mt-4">
                    <h5 class=" text-lg font-bold ml-6">Sort by:</h5>
                    {{-- options  --}}
                    <div class=" flex space-x-8 ml-10">
                        <div>
                            <input type="radio" name="sort" id="products-desc" value='desc'>
                            <label class="cursor-pointer" for="products-desc">Latest</label>
                        </div>

                        <div>
                            <input type="radio" name="sort" id="products-asc" value='asc'>
                            <label class="cursor-pointer" for="products-asc">Old</label>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <h5 class=" text-lg font-bold ml-6">Show total results of:</h5>
                    {{-- options  --}}
                    <div class=" flex space-x-8 ml-10">
                        <div>
                            <input type="radio" name="limit" id="products-limit-25" value='25'>
                            <label class="cursor-pointer" for="products-limit-25">25 records</label>
                        </div>

                        <div>
                            <input type="radio" name="limit" id="products-limit-50" value='50'>
                            <label class="cursor-pointer" for="products-limit-50">50 records</label>
                        </div>

                        <div>
                            <input type="radio" name="limit" id="products-limit-75" value='75'>
                            <label class="cursor-pointer" for="products-limit-75">75 records</label>
                        </div>

                        <div>
                            <input type="radio" name="limit" id="products-limit-100" value='100'>
                            <label class="cursor-pointer" for="products-limit-100">100 records</label>
                        </div>
                    </div>
                </div>

                <!-- button comoponenet start -->
                <!-- login button -->
                <div class=" w-full flex justify-center items-center p-8">
                    <button id="login-button" class=" bg-blue-600 max-w-max flex justify-center items-center py-1 px-8 border-2 border-primary rounded-full space-x-2 shadow-md shadow-gray-500 hover:opacity-70">
                        <span class=" white font-bold uppercase">submit</span>
                        <!-- right arrow -->
                        <svg width="19" height="12" viewBox="0 0 19 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 6H17.5M17.5 6L12.5 1M17.5 6L12.5 11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" stroke-white"/>
                        </svg>
                    </button>
                </div>
                <!-- end button comoponenet -->

            </div>
        </form>

        {{-- orders list --}}
        <div class="container flex flex-col bg-white shadow-lg mt-8">
            <h3 class=" text-white bg-black p-2 text-center">Product History</h3>

            <div class="flex items-center justify-between mx-6 mt-6 capitalize border-b-4 border-gray-3">
                <h3 class=" opacity-80 secondary capitalize">
                    {{$status}} Products
                </h3>
                {{-- pagination results  --}}
                <div class="font-bold">
                    <div>
                        {!! __('Showing (') !!}
                        @if ($products->firstItem())
                            <span class="secondary-2">{{ $products->firstItem() }}</span>
                            {!! __('to') !!}
                            <span class="secondary-2">{{ $products->lastItem() }}</span>
                        @else
                            {{ $products->count() }}
                        @endif
                        {!! __(') of') !!}
                        <span class="secondary-2">{{ $products->total() }}</span>
                        {!! __('results') !!}
                    </div>
                    
                </div>
            </div>

            <div class=" p-4 mx-6 flex flex-col justify-center items-center">
                <!-- <p>Please Note: You can only cancel your orders, if it is in <span class="red">PENDING</span> status.</p> -->
                
                {{-- all records list --}}
                <table class=" w-full mx-6 border border-slate-500 my-4 p-4 ">
                    <tr class=" bg-gray-300">
                        <th  class=" border border-slate-500 p-2">Id</th>
                        <th  class=" border border-slate-500 p-2 max-w-[125px]">Title</th>
                        <th  class=" border border-slate-500 p-2">Price</th>
                        <th  class=" border border-slate-500 p-2">Type</th>
                        <th  class=" border border-slate-500 p-2">Stars</th>
                        <th  class=" border border-slate-500 p-2">Ratings</th>
                        <th  class=" border border-slate-500 p-2">Total Orders</th>
                        <th  class=" border border-slate-500 p-2">Created at</th>
                        <th  class=" border border-slate-500 p-2">Updated at</th>
                        <th  class=" border border-slate-500 p-2">Status</th>
                        <th  class=" border border-slate-500 p-2">Action</th>
                    </tr>

                    @foreach ($products as $product )
                    @if (($loop->index+$products->firstItem())%2 == 0)
                        <tr class=" bg-slate-100">
                    @else
                        <tr class=" bg-white">
                    @endif
                            <td  class=" border border-slate-500 p-2">{{$loop->index+$products->firstItem()}}</td>
                            <td  class=" border border-slate-500 p-2 max-w-[125px] break-words">{{$product->title}}</td>
                            <td  class=" border border-slate-500 p-2">Rs.{{$product->price}}</td>
                            <td  class=" border border-slate-500 p-2 break-words">{{$product->type}}</td>
                            <td  class=" border border-slate-500 p-2">{{$product->stars}}</td>
                            <td  class=" border border-slate-500 p-2">{{$product->ratings}}</td>
                            <td  class=" border border-slate-500 p-2">{{$product->orders}}</td>
                            <td  class=" border border-slate-500 p-2">{{\Carbon\Carbon::parse($product->created_at)->diffForHumans()}}</td>
                            <td  class=" border border-slate-500 p-2">{{\Carbon\Carbon::parse($product->updated_at)->diffForHumans()}}</td>
                            <td  class=" border border-slate-500 p-2">{{$product->status}}</td>
                            <td  class=" border border-slate-500 p-2">
                                
                                <div>

                                    @if ($product->status != 'cancel')
                                        <a href="{{route('productPage',['product_id'=>$product->id])}}" class="bg-blue-600 text-center text-xs rounded-lg text-white font-bold block p-2 m-2 hover:bg-blue-700">
                                            view
                                        </a>

                                        <a href="{{route('supplier.dashboard.product.editPage',['product_id'=>$product->id])}}" class="bg-yellow-600 text-center text-xs rounded-lg text-white font-bold block p-2 m-2 hover:bg-yellow-700">
                                            edit
                                        </a>
                                    @endif

                                    <a href="{{route('supplier.dashboard.product.delete',['product_id'=>$product->id])}}" class="bg-red-600 text-center text-xs rounded-lg text-white font-bold block p-2 m-2 hover:bg-red-700">
                                        delete
                                    </a>
                                </div>

                            </td>
                        </tr>
                    @endforeach

                </table>
                {{-- Pagination --}}
                <div class=" flex justify-center w-full">
                    {!! $products->appends($query)->links() !!}
                </div>
            </div>
        </div>
    @endif
@endsection