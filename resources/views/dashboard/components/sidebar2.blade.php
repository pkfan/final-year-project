<div class="relative w-[22%] ml-6">
    <div class="fixed w-[22%] h-[90vh] bg-white shadow-lg ">
        <header class="flex items-center px-6 mt-4 space-x-4">
            <div >
                <img class="min-w-16 min-h-16 w-16 h-16 rounded-[50%] border-2 border-black overflow-hidden" 
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
        <nav class=" mt-8 font-bold">
            <ul id="dashboarSidebar" class=" uppercase">
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
</div>