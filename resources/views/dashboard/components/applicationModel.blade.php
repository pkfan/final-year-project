    <!-- ////////// START RATINGS AND COMMENTS MODEL SECTION ///////// -->

    <div class="relative">
        <div id="application-overlay" class=" scale-100 z-40 w-screen h-screen fixed top-0 left-0 background-black opacity-40"></div>
        <div id="application-body" class=" scale-100 transition-all duration-1000 w-1/2 h-[650px] overflow-y-scroll z-50 fixed top-12 left-1/2 -translate-x-1/2 background-white shadow-2xl shadow-gray-3">
             
            
            <h3 class=" bg-black text-white py-2 px-6 w-full">Buyer Details

                <!-- start close button -->
                <button id="application-closeButton" class="absolute top-0 right-0 my-1 max-w-max flex items-center px-4 py-1 space-x-2 rounded-full border-2 border-secondary-2 shadow-md shadow-gray-3">
                    <span class=" text-sm font-bold text-white uppercase">Close</span>
                </button>
                <!-- end close button -->
            </h3>

            <!-- emoji svg vector start -->
            <div class=" flex justify-center my-4 ">
                <img id="application-image" class="animate-spin rounded-2xl border-2 border-black -skew-x-3 shadow-2xl shadow-black hover:skew-x-3" src="#" alt="image" width="200" height="200">
            </div>
            
            <div id="application-content" class=" flex flex-col text-lg space-y-2 p-6">
               {{-- inserted by javascript --}}
            </div>

            <div id="application-actions" class=" flex justify-center">
                {{-- <a href="" class="bg-green-600 text-center text-lg rounded-full text-white font-bold block py-2 px-8 m-2 hover:bg-green-700">
                    approve
                </a>
    
                <a href="" class="bg-red-600 text-center text-lg rounded-full text-white font-bold block py-2 px-8 m-2 hover:bg-red-700">
                    delete
                </a> --}}
            </div>


        </div>
    </div>

    <script>
        function innsertApplicationDataHtml(applicationData){
            document.querySelector('#application-image').setAttribute('src',website_domain_name + '/' + applicationData.profile_image);
            console.log('working....', applicationData);

            let html = `
                <span class="border-b border-slate-300"><span class=" secondary-2 font-bold">First Name:</span> ${applicationData.first_name}</span>
                <span class="border-b border-slate-300"><span class=" secondary-2 font-bold">Last Name:</span> ${applicationData.last_name}</span>
                <span class="border-b border-slate-300"><span class=" secondary-2 font-bold">Email:</span> ${applicationData.email}</span>
                <span class="border-b border-slate-300"><span class=" secondary-2 font-bold">Phone Number:</span> ${applicationData.phone_number}</span>
                <span class="border-b border-slate-300"><span class=" secondary-2 font-bold">Address:</span> ${applicationData.address}</span>
                <span class="border-b border-slate-300"><span class=" secondary-2 font-bold">About:</span> ${applicationData.about}</span>
                <span class="border-b border-slate-300 text-red-500"><span class=" secondary-2 font-bold">Status:</span> ${applicationData.status}</span>
                

            `;

            document.querySelector('#application-content').innerHTML = html;



            // let approveButton = `
            //     <a href="${website_domain_name}/admin/buyer/${applicationData.id}" class="order-first bg-green-600 text-center text-lg rounded-full text-white font-bold block py-2 px-8 m-2 hover:bg-green-700">
            //         approve
            //     </a>
            // `;

            // let deleteButton = `
            //     <a href="" class="bg-red-600 text-center text-lg rounded-full text-white font-bold block py-2 px-8 m-2 hover:bg-red-700">
            //         delete
            //     </a>
            // `;

            // let actionButtonHtml = deleteButton;

            // if(applicationData.status == 'pending'){
            //     actionButtonHtml = actionButtonHtml + approveButton;
            // }

            // document.querySelector('#application-actions').innerHTML = actionButtonHtml;


        }
        function getApplicationData(url = null){
            axios.get(`${website_domain_name}/api/admin/buyer/2`)
                .then(function (response) {
                    // handle success
                    if(response.status == 200){
                        innsertApplicationDataHtml(response.data);
                    }
                    else{
                        alert('[status code error ] axios feched errors.')
                    }
                })
                .catch(function (error) {
                    // handle error
                    alert('axios feched errors.')
                    // console.log(error);
                });
        }
        (function(){
            let applicationData = getApplicationData();
           


        }());
    </script>
    <!-- ////////// END RATINGS AND COMMENTS MODEL SECTION ///////// -->