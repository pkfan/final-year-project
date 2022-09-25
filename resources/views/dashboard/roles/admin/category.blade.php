@extends('dashboard.app') 

@section('app')
{{-- create category form --}}
<form action="{{route('admin.dashboard.category.create')}}" method="POST">
    @csrf
    <div class="relative w-1/3 mx-auto">
        <div class="flex items-center">
            <input type="text" name="category_name" id="category_name" placeholder="create new category" value="{{old('category_name')}}" class="w-full text-lg font-bold border-4 border-blue-600 rounded-lg p-4 placeholder:text-gray-400">
            <button class="absolute right-4 bg-blue-600 text-center rounded-full text-white font-bold block p-2 px-4 hover:bg-blue-700">
                Create
            </button>
        </div>
        @error('category_name')
            <div class="red">{{ $message }}</div>
        @enderror
    </div>
</form>


{{-- category list --}}
<div class="container flex flex-col bg-white shadow-lg mt-8">
    <h3 class=" text-white bg-black p-2 text-center">All Categories</h3>

    <div class="flex items-center justify-between mx-6 mt-6 capitalize border-b-4 border-gray-3">
        <h3 class=" opacity-80 secondary capitalize">
            Categories List
        </h3>
        {{-- pagination results  --}}
        <div class="font-bold">
            <div>
                {!! __('Showing (') !!}
                @if ($categories->firstItem())
                    <span class="secondary-2">{{ $categories->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="secondary-2">{{ $categories->lastItem() }}</span>
                @else
                    {{ $categories->count() }}
                @endif
                {!! __(') of') !!}
                <span class="secondary-2">{{ $categories->total() }}</span>
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
                <th  class=" border border-slate-500 p-2">Category Name</th>
                <th  class=" border border-slate-500 p-2">Created at</th>
                <th  class=" border border-slate-500 p-2">Action</th>
            </tr>

            @foreach ($categories as $category )
                @if (($loop->index+$categories->firstItem())%2 == 0)
                    <tr class=" bg-slate-100">
                @else
                    <tr class=" bg-white">
                @endif
                    <td  class=" border border-slate-500 p-2">{{$loop->index+$categories->firstItem()}}</td>
                    <td  class=" border border-slate-500 p-2">{{$category->name}}</td>
                    <td  class=" border border-slate-500 p-2">{{\Carbon\Carbon::parse($category->created_at)->diffForHumans()}}</td>
                    <td  class=" border border-slate-500 p-2">
                        <div>
                            <a href="{{route('admin.dashboard.category.delete',['category_id' => $category->id])}}" class="bg-red-600 text-center text-xs rounded-lg text-white font-bold block p-2 m-2 hover:bg-red-700">
                                delete
                            </a>
                        </div>

                    </td>
                </tr>
            @endforeach

        </table>
         {{-- Pagination --}}
         <div class=" flex justify-center w-full">
            {!! $categories->appends($query ?? null)->links() !!}
        </div>
    </div>
</div>


@endsection