@extends('dashboard.app') 

@section('app')

{{-- edit personal information --}}
<div class="container flex flex-col bg-white shadow-lg">
    <h3 class=" text-white bg-black p-2 text-center">Edit your Persoan Information</h3>

    <div class=" w-4/5 mx-auto flex flex-col justify-center items-center">
        

        <form action="{{route('admin.profile.updateInformation')}}" method="post" enctype="multipart/form-data" class="w-full px-4 py-2 ">
            @csrf
            <div class=" my-4">
                <h3 class="flex capitalize border-b-4 border-gray-3 opacity-80">
                    Profile Picture
                </h3>
            </div>

            {{-- profile image --}}
            <div class="flex justify-center items-center space-x-4">
                <img class="rounded-lg" src="{{asset(auth()->guard('admin')->user()->profile_image)}}" alt="" width="200px" height="200px">
                <input type="file" name="profile_image" id="profile_image" value="{{auth()->guard('admin')->user()->profile_image}}">
                @error('profile_image')
                    <div class="red">{{ $message }}</div>
                @enderror
            </div>

            <div class=" my-4">
                <h3 class="flex capitalize border-b-4 border-gray-3 opacity-80">
                    Personal Information
                </h3>
            </div>

            <!-- first name input field start -->
            <div id="firstName-feild" class=" flex flex-col w-full px-4 py-2 pl-0 ">
                <label for="firstName" class=" text-sm">First Name:</label>
                <input type="text" name="firstName" id="firstName" placeholder="e.g. Muhammad" value="{{auth()->guard('admin')->user()->first_name}}" class=" @error('firstName') !border-red-500 @enderror placeholder:gray-5 w-full rounded-md p-1 pl-4 border-2 border-gray-5 background-gray-1">
                @error('firstName')
                    <div class="red">{{ $message }}</div>
                @enderror
            </div>
            <!-- end first name field -->
                <!-- last name input field start -->
                <div id="lastName-feild" class=" flex flex-col w-full px-4 py-2 pl-0 ">
                <label for="lastName" class=" text-sm">Last Name:</label>
                <input type="text" name="lastName" id="lastName" required placeholder="e.g. Amir" value="{{auth()->guard('admin')->user()->last_name}}" class=" @error('lastName') !border-red-500 @enderror placeholder:gray-5 w-full rounded-md p-1 pl-4 border-2 border-gray-5 background-gray-1">
                @error('lastName')
                    <div class="red">{{ $message }}</div>
                @enderror
            </div>
            <!-- end last name field -->
            <!-- email input field start -->
            <div id="email-feild" class=" flex flex-col w-full px-4 py-2 pl-0 ">
                <label for="email" class=" text-sm">Email Address:</label>
                <input type="email" name="email" id="email" disabled placeholder="e.g. BC1800400920@vu.edu.pk" value="{{auth()->guard('admin')->user()->email}}"  class=" @error('email') !border-red-500 @enderror placeholder:gray-5 w-full rounded-md p-1 pl-4 border-2 border-gray-5 background-gray-1">
                @error('email')
                    <div class="red">{{ $message }}</div>
                @enderror
            </div>
            <!-- end email field -->

            <!-- address input field start -->
            <div id="address-feild" class=" flex flex-col w-full px-4 py-2 pl-0 ">
                <label for="address" class=" text-sm">Address:</label>
                <input type="address" name="address" value="{{auth()->guard('admin')->user()->address}}" id="address" required placeholder="e.g. House 10 ghoar chowk serhali road Mustafabad" class=" @error('address') !border-red-500 @enderror placeholder:gray-5 w-full rounded-md p-1 pl-4 border-2 border-gray-5 background-gray-1">
                @error('address')
                    <div class="red">{{ $message }}</div>
                @enderror
            </div>
            <!-- end email field -->
                <!-- address input field start -->
                <div id="phone-feild" class=" flex flex-col w-full px-4 py-2 pl-0 ">
                <label for="phone" class=" text-sm">Phone Number:</label>
                <input type="phone" name="phone" value="0{{auth()->guard('admin')->user()->phone_number}}" id="phone" required placeholder="e.g. 03186323046" class=" @error('phone') !border-red-500 @enderror placeholder:gray-5 w-full rounded-md p-1 pl-4 border-2 border-gray-5 background-gray-1">
                @error('phone')
                    <div class="red">{{ $message }}</div>
                @enderror
            </div>
            <!-- end email field -->

                <!-- shipping input field start -->
            <div id="order-shipping-address" class=" flex flex-col w-full p-4 pl-0 ">
                <label for="order_description" class=" text-sm">About You:</label>
                <textarea name="about" id="about" cols="30" rows="10" placeholder="please tell us about yourself." class=" w-full rounded-md p-1 pl-4 border-2 border-gray-5 background-gray-1">{{auth()->guard('admin')->user()->about}}</textarea>
                @error('about')
                    <div class="red">{{ $message }}</div>
                @enderror
            </div>
            <!-- end shipping field -->

            <!-- button comoponenet start -->
            <!-- login button -->
            <div class=" w-full flex justify-center items-center p-8">
                <button id="login-button" class=" bg-blue-600 max-w-max flex justify-center items-center py-1 px-8 border-2 border-primary rounded-full space-x-2 shadow-md shadow-gray-500 hover:opacity-70">
                    <span class=" white font-bold uppercase">update</span>
                    <!-- right arrow -->
                    <svg width="19" height="12" viewBox="0 0 19 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 6H17.5M17.5 6L12.5 1M17.5 6L12.5 11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" stroke-white"/>
                    </svg>
                </button>
            </div>
            <!-- end button comoponenet -->
        </form>
    </div>
</div>

{{-- reset password --}}
<div class="container flex flex-col mt-6 bg-white shadow-lg">
    <div class=" w-4/5 mx-auto flex flex-col justify-center items-center">

        <form action="{{route('admin.profile.updatePassword')}}" method="post" class="w-full px-4 py-2 ">
            @csrf
            <div class=" my-4">
                <h3 class="flex capitalize border-b-4 border-gray-3 opacity-80">
                    Change Your Password
                </h3>
            </div>

            <!-- current password input field start -->
            <div id="currentPassword-feild" class=" flex flex-col w-full px-4 py-2 pl-0 ">
                <label for="currentPassword" class=" text-sm">Current Password:</label>
                <input type="text" name="currentPassword" id="currentPassword" required value="{{old('currentPassword')}}" placeholder="*******************" class=" @error('currentPassword') !border-red-500 @enderror placeholder:gray-5 w-full rounded-md p-1 pl-4 border-2 border-gray-5 background-gray-1">
                @error('currentPassword')
                    <div class="red">{{ $message }}</div>
                @enderror
            </div>
            <!-- end current password field -->

             <!-- New Password input field start -->
             <div id="newPassword-feild" class=" flex flex-col w-full px-4 py-2 pl-0 ">
                <label for="newPassword" class=" text-sm">New Password:</label>
                <input type="text" name="newPassword" id="newPassword" required value="{{old('newPassword')}}" placeholder="*******************" class=" @error('newPassword') !border-red-500 @enderror placeholder:gray-5 w-full rounded-md p-1 pl-4 border-2 border-gray-5 background-gray-1">
                @error('newPassword')
                    <div class="red">{{ $message }}</div>
                @enderror
            </div>
            <!-- end New Password field -->

            <!-- button comoponenet start -->
            <!-- login button -->
            <div class=" w-full flex justify-center items-center p-8">
                <button id="login-button" class=" bg-blue-600 max-w-max flex justify-center items-center py-1 px-8 border-2 border-primary rounded-full space-x-2 shadow-md shadow-gray-500 hover:opacity-70">
                    <span class=" white font-bold uppercase">update</span>
                    <!-- right arrow -->
                    <svg width="19" height="12" viewBox="0 0 19 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 6H17.5M17.5 6L12.5 1M17.5 6L12.5 11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" stroke-white"/>
                    </svg>
                </button>
            </div>
            <!-- end button comoponenet -->
        </form>
    </div>
</div>


@endsection