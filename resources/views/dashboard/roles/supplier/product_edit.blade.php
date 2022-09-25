@extends('dashboard.app') 

@section('app')

{{-- edit personal information --}}
<div class="container flex flex-col bg-white shadow-lg">
    <h3 class=" text-white bg-black p-2 text-center">Edit Product</h3>

    <div class=" w-4/5 mx-auto flex flex-col justify-center items-center">
        

        <form action="{{route('supplier.dashboard.product.edit')}}" method="post" enctype="multipart/form-data" class="w-full px-4 py-2 ">
            @csrf
            <input type="hidden" name="product_id" id="$product->id" value="{{$product->id}}">
            <div class=" my-4">
                <h3 class="flex capitalize border-b-4 border-gray-3 opacity-80">
                    Product Images
                </h3>
            </div>

            {{-- profile images --}}
            <div class=" space-y-4">
                {{-- profile image 1 --}}
                <div class="flex justify-center items-center space-x-4">
                    <h4 class=" secondary">Image 1</h4>
                    <img class="rounded-lg border-2 border-secondary" src="{{asset($product->image_1)}}" alt="" width="150px" height="150px">
                    <div class='w-64'>
                        <input type="file" name="image_1" id="image_1" >
                        @error('image_1')
                            <div class="red">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
    
                {{-- profile image 2 --}}
                <div class="flex justify-center items-center space-x-4">
                    <h4 class=" secondary">Image 2</h4>
                    <img class="rounded-lg border-2 border-secondary" src="{{asset($product->image_2)}}" alt="" width="150px" height="150px">
                    <div class='w-64'>
                        <input type="file" name="image_2" id="image_2" >
                        @error('image_2')
                            <div class="red">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
    
                {{-- profile image 3 --}}
                <div class="flex justify-center items-center space-x-4">
                    <h4 class=" secondary">Image 3</h4>
                    <img class="rounded-lg border-2 border-secondary" src="{{asset($product->image_3)}}" alt="" width="150px" height="150px">
                    <div class='w-64'>
                        <input type="file" name="image_3" id="image_3" >
                        @error('image_3')
                            <div class="red">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
    
                 {{-- profile image 4 --}}
                 <div class="flex justify-center items-center space-x-4">
                    <h4 class=" secondary">Image 4</h4>
                    <img class="rounded-lg border-2 border-secondary" src="{{asset($product->image_4)}}" alt="" width="150px" height="150px">
                    <div class='w-64'>
                        <input type="file" name="image_4" id="image_4" >
                        @error('image_4')
                            <div class="red">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
    
            </div>


            <div class=" my-6">
                <h3 class="flex capitalize border-b-4 border-gray-3 opacity-80">
                    Product Details
                </h3>
            </div>

            <!-- Title input field start -->
            <div id="title-feild" class=" flex flex-col w-full px-4 py-2 pl-0 ">
                <label for="title" class=" text-sm">Title:</label>
                <input type="text" name="title" required id="title" placeholder="e.g. product title" value="{{$product->title}}" class=" @error('title') !border-red-500 @enderror placeholder:gray-5 w-full rounded-md p-1 pl-4 border-2 border-gray-5 background-gray-1">
                @error('title')
                    <div class="red">{{ $message }}</div>
                @enderror
            </div>
            <!-- end Title field -->
                <!-- Price input field start -->
                <div id="price-feild" class=" flex flex-col w-full px-4 py-2 pl-0 ">
                <label for="price" class=" text-sm">Price:</label>
                <input type="number" name="price" id="price" required placeholder="e.g. Amir" value="{{$product->price}}" class=" @error('price') !border-red-500 @enderror placeholder:gray-5 w-full rounded-md p-1 pl-4 border-2 border-gray-5 background-gray-1">
                @error('price')
                    <div class="red">{{ $message }}</div>
                @enderror
            </div>
            <!-- end Price field -->

            <!-- type input field start -->
            <div id="type-feild" class=" flex flex-col w-full px-4 py-2 pl-0 ">
                <label for="type" class=" text-sm">Type:</label>
                <input type="text" name="type" value="{{$product->type}}" id="type" required placeholder="e.g. House 10 ghoar chowk serhali road Mustafabad" class=" @error('type') !border-red-500 @enderror placeholder:gray-5 w-full rounded-md p-1 pl-4 border-2 border-gray-5 background-gray-1">
                @error('type')
                    <div class="red">{{ $message }}</div>
                @enderror
            </div>

            <!-- brand input field start -->
            <div id="brand-feild" class=" flex flex-col w-full px-4 py-2 pl-0 ">
                <label for="brand" class=" text-sm">Brand:</label>
                <input type="brand" name="brand" value="{{$product->brand}}" id="brand" required placeholder="e.g. House 10 ghoar chowk serhali road Mustafabad" class=" @error('brand') !border-red-500 @enderror placeholder:gray-5 w-full rounded-md p-1 pl-4 border-2 border-gray-5 background-gray-1">
                @error('brand')
                    <div class="red">{{ $message }}</div>
                @enderror
            </div>

            {{-- choose category start --}}
            <div class=" flex flex-col w-full p-4 pl-0">
                <label for="category" class=" text-sm">Choose Category:</label>
                <select name="category_id" id="category" required class=" w-full rounded-md py-1 px-4 border-2 border-gray-5 background-gray-1">
                    <option value="">None</option>
                    @foreach ($categories as $category)
                        @if ($category->id == $product->category_id)
                            <option selected value="{{$category->id}}">{{$category->name}}</option>
                        @else
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endif
                    @endforeach

                </select>
            </div>
            {{-- choose category end --}}

            <!-- description input field start -->
            <div class=" flex flex-col w-full p-4 pl-0 ">
                <label for="description" class=" text-sm">Description:</label>
                <textarea name="description" required id="description" cols="30" rows="10" placeholder="write description of product." class=" w-full rounded-md p-1 pl-4 border-2 border-gray-5 background-gray-1">{{$product->description}}</textarea>
                @error('description')
                    <div class="red">{{ $message }}</div>
                @enderror
            </div>
            <!-- end description field -->

            


            <!-- button comoponenet start -->
            <!-- login button -->
            <div class=" w-full flex justify-center items-center p-8 space-x-4">
                <button id="login-button" class=" bg-blue-600 max-w-max flex justify-center items-center py-1 px-8 border-2 border-primary rounded-full space-x-2 shadow-md shadow-gray-500 hover:opacity-70">
                    <span class=" white font-bold uppercase">update</span>
                    <!-- right arrow -->
                    <svg width="19" height="12" viewBox="0 0 19 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 6H17.5M17.5 6L12.5 1M17.5 6L12.5 11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" stroke-white"/>
                    </svg>
                </button>
                <a href="{{route('supplier.dashboard.product')}}" class=" bg-yellow-600 max-w-max flex justify-center items-center py-1 px-8 border-2 border-primary rounded-full space-x-2 shadow-md shadow-gray-500 hover:opacity-70">
                    <span class=" white font-bold uppercase">cancel</span>
                    <!-- right arrow -->
                    <svg width="19" height="12" viewBox="0 0 19 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 6H17.5M17.5 6L12.5 1M17.5 6L12.5 11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" stroke-white"/>
                    </svg>
                </a>
            </div>
        </form>
    </div>
</div>

@endsection