@extends('dashboard.app') 

@section('app')

{{-- filter results  --}}
<form action="{{route('admin.dashboard.supplier')}}">
    <div class="container flex flex-col bg-white shadow-lg p-4">
        <h3 class="flex capitalize border-b-4 border-gray-3 opacity-80 secondary">
            Filter Supplier Accounts Data
        </h3>
        <div class="mt-4">
            <h5 class=" text-lg font-bold ml-6">Show status type of:</h5>
            {{-- options  --}}
            <div class=" flex space-x-8 ml-10">
                <div>
                    <input type="radio" name="status" id="products-all" value='all'>
                    <label class="cursor-pointer" for="products-all">All Supplier Account</label>
                </div>

                <div>
                    <input type="radio" name="status" id="products-pending" value='pending'>
                    <label class="cursor-pointer" for="products-pending">Pending Supplier Account</label>
                </div>


                <div>
                    <input type="radio" name="status" id="products-approved" value='approved'>
                    <label class="cursor-pointer" for="products-approved">Approved Supplier Account</label>
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
    <h3 class=" text-white bg-black p-2 text-center">Supplier Account History</h3>

    <div class="flex items-center justify-between mx-6 mt-6 capitalize border-b-4 border-gray-3">
        <h3 class=" opacity-80 secondary capitalize">
            {{$status}} Supplier Account
        </h3>
        {{-- pagination results  --}}
        <div class="font-bold">
            <div>
                {!! __('Showing (') !!}
                @if ($suppliers->firstItem())
                    <span class="secondary-2">{{ $suppliers->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="secondary-2">{{ $suppliers->lastItem() }}</span>
                @else
                    {{ $suppliers->count() }}
                @endif
                {!! __(') of') !!}
                <span class="secondary-2">{{ $suppliers->total() }}</span>
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
                <th  class=" border border-slate-500 p-2 max-w-[125px]">First Name</th>
                <th  class=" border border-slate-500 p-2">Last Name</th>
                <th  class=" border border-slate-500 p-2">Email</th>
                <th  class=" border border-slate-500 p-2">Phone</th>
                <th  class=" border border-slate-500 p-2">Created at</th>
                <th  class=" border border-slate-500 p-2">Updated at</th>
                <th  class=" border border-slate-500 p-2">Status</th>
                <th  class=" border border-slate-500 p-2">Action</th>
            </tr>

            @foreach ($suppliers as $supplier )
                @if (($loop->index+$suppliers->firstItem())%2 == 0)
                    <tr class=" bg-slate-100">
                @else
                    <tr class=" bg-white">
                @endif
                    <td  class=" border border-slate-500 p-2">{{$loop->index+$suppliers->firstItem()}}</td>
                    <td  class=" border border-slate-500 p-2">{{$supplier->first_name}}</td>
                    <td  class=" border border-slate-500 p-2">{{$supplier->last_name}}</td>
                    <td  class=" border border-slate-500 p-2 break-words">{{$supplier->email}}</td>
                    <td  class=" border border-slate-500 p-2">0{{$supplier->phone_number}}</td>
                    <td  class=" border border-slate-500 p-2">{{\Carbon\Carbon::parse($supplier->created_at)->diffForHumans()}}</td>
                    <td  class=" border border-slate-500 p-2">{{\Carbon\Carbon::parse($supplier->updated_at)->diffForHumans()}}</td>
                    <td  class=" border border-slate-500 p-2">{{$supplier->status}}</td>
                    <td  class=" border border-slate-500 p-2">
                        <div>
                            @if ($supplier->status != 'approved')
                                <a href="{{route('admin.dashboard.supplier.approve',['supplier_id'=>$supplier->id])}}" class="bg-green-600 text-center text-xs rounded-lg text-white font-bold block p-2 m-2 hover:bg-green-700">
                                    approve
                                </a>
                            @endif
    
                            <a href="{{route('admin.dashboard.supplier.delete',['supplier_id'=>$supplier->id])}}" class="bg-red-600 text-center text-xs rounded-lg text-white font-bold block p-2 m-2 hover:bg-red-700">
                                delete
                            </a>

                        </div>

                    </td>
                </tr>
            @endforeach

        </table>
         {{-- Pagination --}}
         <div class=" flex justify-center w-full">
            {!! $suppliers->appends($query)->links() !!}
        </div>
    </div>
</div>


@endsection