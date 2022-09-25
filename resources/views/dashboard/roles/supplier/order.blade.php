@extends('dashboard.app') 

@section('app')
{{-- filter results  --}}
<form action="{{route('supplier.dashboard.order')}}">
    <div class="container flex flex-col bg-white shadow-lg p-4">
        <h3 class="flex capitalize border-b-4 border-gray-3 opacity-80 secondary">
            Filter Your Orders Data
        </h3>
        <div class="mt-4">
            <h5 class=" text-lg font-bold ml-6">Show status type of:</h5>
            {{-- options  --}}
            <div class=" flex space-x-8 ml-10">
                <div>
                    <input type="radio" name="status" id="orders-all" value='all'>
                    <label for="orders-all">All Orders</label>
                </div>

                <div>
                    <input type="radio" name="status" id="orders-pending" value='pending'>
                    <label for="orders-pending">Pending Orders</label>
                </div>

                <div>
                    <input type="radio" name="status" id="orders-processing" value='processing'>
                    <label for="orders-processing">Processing Orders</label>
                </div>

                <div>
                    <input type="radio" name="status" id="orders-completed" value='completed'>
                    <label for="orders-completed">Completed Orders</label>
                </div>

                <div>
                    <input type="radio" name="status" id="orders-cancel" value='cancel'>
                    <label for="orders-cancel">Cancel Orders</label>
                </div>

            </div>
        </div>

        <div class="mt-4">
            <h5 class=" text-lg font-bold ml-6">Sort by:</h5>
            {{-- options  --}}
            <div class=" flex space-x-8 ml-10">
                <div>
                    <input type="radio" name="sort" id="orders-desc" value='desc'>
                    <label for="orders-desc">Latest</label>
                </div>

                <div>
                    <input type="radio" name="sort" id="orders-asc" value='asc'>
                    <label for="orders-asc">Old</label>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <h5 class=" text-lg font-bold ml-6">Show total results of:</h5>
            {{-- options  --}}
            <div class=" flex space-x-8 ml-10">
                <div>
                    <input type="radio" name="limit" id="orders-limit-25" value='25'>
                    <label for="orders-limit-25">25 records</label>
                </div>

                <div>
                    <input type="radio" name="limit" id="orders-limit-50" value='50'>
                    <label for="orders-limit-50">50 records</label>
                </div>

                <div>
                    <input type="radio" name="limit" id="orders-limit-75" value='75'>
                    <label for="orders-limit-75">75 records</label>
                </div>

                <div>
                    <input type="radio" name="limit" id="orders-limit-100" value='100'>
                    <label for="orders-limit-100">100 records</label>
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
    <h3 class=" text-white bg-black p-2 text-center">Supplier Orders History</h3>

    <div class="flex items-center justify-between mx-6 mt-6 capitalize border-b-4 border-gray-3">
        <h3 class=" opacity-80 secondary capitalize">
            {{$status}} Products
        </h3>
        {{-- pagination results  --}}
        <div class="font-bold">
            <div>
                {!! __('Showing (') !!}
                @if ($orders->firstItem())
                    <span class="secondary-2">{{ $orders->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="secondary-2">{{ $orders->lastItem() }}</span>
                @else
                    {{ $orders->count() }}
                @endif
                {!! __(') of') !!}
                <span class="secondary-2">{{ $orders->total() }}</span>
                {!! __('results') !!}
            </div>
            
        </div>
    </div>

    <div class=" w-full p-4 flex flex-col justify-center items-center">
        <p>Please Note: You can only cancel your orders, if it is in <span class="red">PENDING</span> status.</p>
        
        {{-- all records list --}}
        <table class=" w-full border border-slate-500 my-4 p-4 ">
            <tr class=" bg-gray-300">
                <th  class=" border border-slate-500 p-2">Id</th>
                <th  class=" border border-slate-500 p-2">Title</th>
                <th  class=" border border-slate-500 p-2">Price</th>
                <th  class=" border border-slate-500 p-2">Qantity</th>
                <th  class=" border border-slate-500 p-2">Date</th>
                <th  class=" border border-slate-500 p-2">Status</th>
                <th  class=" border border-slate-500 p-2">Action</th>
            </tr>

            @foreach ($orders as $order )
                @if (($loop->index+$orders->firstItem())%2 == 0)
                    <tr class=" bg-slate-100">
                @else
                    <tr class=" bg-white">
                @endif
                    <td  class=" border border-slate-500 p-2">{{$loop->index+$orders->firstItem()}}</td>
                    <td  class=" border border-slate-500 p-2">{{$order->title}}</td>
                    <td  class=" border border-slate-500 p-2">Rs.{{$order->price}}</td>
                    <td  class=" border border-slate-500 p-2">{{$order->quantity}}</td>
                    <td  class=" border border-slate-500 p-2">{{\Carbon\Carbon::parse($order->order_date)->diffForHumans()}}</td>
                    <td  class=" border border-slate-500 p-2">

                            @if ($order->status == 'cancelByBuyer') 
                                Cancel by Buyer
                            @elseif ($order->status == 'cancelBySupplier')
                                Cancel by You
                            @else 
                                {{$order->status}}
                            @endif
    
                    </td>
                    <td  class=" border border-slate-500 p-2">
                        
                        <div>

                            <a href="{{route('productPage',['product_id' => $order->product_id])}}" class="bg-blue-600 text-center text-xs rounded-lg text-white font-bold block p-2 m-2 hover:bg-blue-700">
                                view
                            </a>

                            @if ($order->status == 'pending')
                                <a href="{{route('supplier.dashboard.order.approve',['order_id' => $order->order_id])}}" class="bg-green-600 text-center text-xs rounded-lg text-white font-bold block p-2 m-2 hover:bg-green-700">
                                    Approve
                                </a>
                                <a href="{{route('supplier.dashboard.order.cancel',['order_id' => $order->order_id])}}" class="bg-red-600 text-center text-xs rounded-lg text-white font-bold block p-2 m-2 hover:bg-red-700">
                                    Cancel Order
                                </a>
                            @endif

                        </div>

                    </td>
                </tr>
            @endforeach
        </table>
         {{-- Pagination --}}
         <div class=" flex justify-center w-full">
            {!! $orders->appends($query)->links() !!}
        </div>
    </div>
</div>


@endsection