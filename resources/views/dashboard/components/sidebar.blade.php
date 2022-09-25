{{-- <div class="relative w-[22%] ml-6"> --}}
    <div class="fixed z-50 top-0 flex justify-between items-center w-full bg-white shadow-lg ">
        <header class="flex items-center px-6 space-x-4">
            <div >
                <img class="min-w-14 min-h-14 w-14 h-14 rounded-[50%] border-2 border-black overflow-hidden" 
                    src="
                        @if(auth()->guard('buyer')->check())
                            {{asset(auth()->guard('buyer')->user()->profile_image)}}
                        @elseif (auth()->guard('supplier')->check())
                            {{asset(auth()->guard('supplier')->user()->profile_image)}}
                        @elseif (auth()->guard('admin')->check())
                            {{asset(auth()->guard('admin')->user()->profile_image)}}
                        @endif
                    " 
                    width="64px" height="64px" alt=""
                >
            </div>
            <div>
                <h4> {{auth()->guard()->user()->first_name}}</h4>
                <span>Role: 
                    <span class=" text-red-500">
                        @if(auth()->guard('buyer')->check())
                            Buyer
                        @elseif (auth()->guard('supplier')->check())
                            Supplier
                        @elseif (auth()->guard('admin')->check())
                            Admin
                        @endif
                    </span>
                </span>
            </div>
        </header>
        <nav class=" flex mx-4 font-bold">
            <ul id="dashboarSidebar" class="flex uppercase">
              @if(auth()->guard('buyer')->check())
                @include('dashboard.roles.buyer.navigations')
              @elseif (auth()->guard('supplier')->check())
                @include('dashboard.roles.supplier.navigations')
              @elseif (auth()->guard('admin')->check())
                @include('dashboard.roles.admin.navigations')
              @endif
            </ul>
        </nav>
    </div>
{{-- </div> --}}