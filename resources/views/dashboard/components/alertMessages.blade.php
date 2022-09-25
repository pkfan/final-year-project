<!-- ////////// buyer successfully actions end ///////// -->
@if(session()->has('success'))
   <div class="relative">
     <div id="successfully-actions-body" class="max-w-[700px] transition-all duration-1000 z-50 p-8 fixed bottom-0 right-0 background-white shadow-2xl shadow-gray-3 border-8 border-green">
        <!-- start close button -->
        <button id="successfully-actions-closeButton" class="absolute right-4 top-4 max-w-max flex items-center px-4 py-1 space-x-2 rounded-full border-2 border-black shadow-md shadow-gray-3">
            <span class=" text-sm font-bold black uppercase">Close</span>
        </button>
        <!-- end close button -->
        <div class="flex flex-col md:flex-row items-center space-x-4 py-4">
            <div>
                <?xml version="1.0" encoding="UTF-8"?>
                <svg width='100' version="1.0" viewBox="0 0 52.963 52.963" xmlns="http://www.w3.org/2000/svg" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">
                <defs>
                <linearGradient id="c" x1="314.57" x2="332.02" y1="369.98" y2="387.44" gradientUnits="userSpaceOnUse">
                <stop stop-color="#0f0" offset="0"/>
                <stop stop-color="#226122" offset="1"/>
                </linearGradient>
                <linearGradient id="b" x1="433.73" x2="405.65" y1="377.2" y2="379.77" gradientTransform="matrix(.99995 0 0 1.0001 -223.46 -147.82)" gradientUnits="userSpaceOnUse">
                <stop stop-color="#fff" stop-opacity=".72656" offset="0"/>
                <stop stop-color="#fff" offset="1"/>
                </linearGradient>
                <linearGradient id="a" x1="302.74" x2="311.27" y1="377.95" y2="390.78" gradientTransform="matrix(1.9519 0 0 1.8418 -426.22 -488.52)" gradientUnits="userSpaceOnUse">
                <stop stop-color="#fff" offset="0"/>
                <stop stop-color="#fff" stop-opacity="0" offset="1"/>
                </linearGradient>
                </defs>
                <g transform="translate(-164.6 -201.82)">
                <path transform="matrix(1.8961 0 0 1.8961 -426.22 -488.52)" d="m339.54 378.06a13.967 13.967 0 1 1-27.94 0 13.967 13.967 0 1 1 27.94 0z" fill="#226122"/>
                <path transform="matrix(1.7312 0 0 1.7312 -372.54 -426.19)" d="m339.54 378.06a13.967 13.967 0 1 1-27.94 0 13.967 13.967 0 1 1 27.94 0z" fill="url(#c)" stroke="#fff" stroke-width=".32492"/>
                <path d="m173.98 230.81c-0.22 0.22-0.18 0.57 0.04 0.8l13.53 14.18 22.53-25.48c0.22-0.22 0.22-0.53 0-0.76l-5.03-5.02c-0.22-0.23-0.58-0.28-0.79-0.05l-16.83 18.89-7.59-7.59c-0.22-0.22-0.61-0.22-0.83 0l-5.03 5.03z" fill="url(#b)"/>
                <path d="m191.07 204.13c-13.35 0-24.18 10.83-24.18 24.18 0 6.41 2.62 12.14 6.7 16.47 2.12-17.5 16.89-31.11 34.96-31.11 0.49 0 0.94 0.1 1.42 0.12-4.42-5.75-11.09-9.66-18.9-9.66z" fill="url(#a)"/>
                </g>
                <metadata>
                <rdf:RDF>
                <cc:Work>
                <dc:format>image/svg+xml</dc:format>
                <dc:type rdf:resource="http://purl.org/dc/dcmitype/StillImage"/>
                <cc:license rdf:resource="http://creativecommons.org/licenses/publicdomain/"/>
                <dc:publisher>
                <cc:Agent rdf:about="http://openclipart.org/">
                <dc:title>Openclipart</dc:title>
                </cc:Agent>
                </dc:publisher>
                <dc:title>ok</dc:title>
                <dc:date>2009-03-24T10:27:19</dc:date>
                <dc:description/>
                <dc:source>https://openclipart.org/detail/23156/ok-by-dholler</dc:source>
                <dc:creator>
                <cc:Agent>
                <dc:title>dholler</dc:title>
                </cc:Agent>
                </dc:creator>
                <dc:subject>
                <rdf:Bag>
                <rdf:li>glossy</rdf:li>
                <rdf:li>green</rdf:li>
                <rdf:li>icon</rdf:li>
                <rdf:li>okay</rdf:li>
                <rdf:li>remix</rdf:li>
                </rdf:Bag>
                </dc:subject>
                </cc:Work>
                <cc:License rdf:about="http://creativecommons.org/licenses/publicdomain/">
                <cc:permits rdf:resource="http://creativecommons.org/ns#Reproduction"/>
                <cc:permits rdf:resource="http://creativecommons.org/ns#Distribution"/>
                <cc:permits rdf:resource="http://creativecommons.org/ns#DerivativeWorks"/>
                </cc:License>
                </rdf:RDF>
                </metadata>
                </svg>   
            </div> 
            
            <div>
                <h3 class="primary">{{ session()->get("success") }}</h3>
            </div>
        </div>

     </div>
   </div>
   <script>
       let successBody = document.querySelector('#successfully-actions-body');
       (function(){
           let successButton = document.querySelector('#successfully-actions-closeButton');
           console.log(successButton);

           successButton.addEventListener('click',function(){
                successBody.classList.add('scale-0');
           });

           clearTimeOutId = setTimeout(function(){
                successBody.classList.add('scale-0');
            },10000);
       
       }());
   </script>
@endif
<!-- ////////// buyer successfully actions end ///////// -->


<!-- ////////// buyer successfully actions end ///////// -->
@if(session()->has('error'))
   <div class="relative">
     <div id="error-actions-body" class="max-w-[700px] transition-all duration-1000 z-50 p-8 fixed bottom-0 right-0 background-white shadow-2xl shadow-gray-3 border-8 border-red">
        <!-- start close button -->
        <button id="error-actions-closeButton" class="absolute right-4 top-4 max-w-max flex items-center px-4 py-1 space-x-2 rounded-full border-2 border-black shadow-md shadow-gray-3">
            <span class=" text-sm font-bold black uppercase">Close</span>
        </button>
        <!-- end close button -->
        <div class="flex flex-col md:flex-row items-center space-x-4 py-4">
            <div>
                <!--?xml version="1.0" encoding="UTF-8"?-->
                <svg width="120" height="120" version="1.1" viewBox="0 0 712.32 696.47" xmlns="http://www.w3.org/2000/svg" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">
                    <g transform="translate(-17.279 -27.314)">
                    <text x="352.30161" y="723.78192" fill="#000000" font-family="Sans" font-size="40px" letter-spacing="0px" word-spacing="0px" style="line-height:125%" xml:space="preserve">
                        <tspan x="352.30161" y="723.78192"></tspan>
                        </text>
                    <g transform="matrix(.80562 0 0 .80562 81.4 -19.868)">
                    <g transform="translate(1173.1 -80.938)" stroke-linecap="round" stroke-linejoin="round">
                    <path transform="matrix(-.46631 .80802 -.80768 -.46651 -304.88 496.69)" d="m823.84 632.91h-835.52l417.76-723.57z" opacity=".51899" stroke="#000" stroke-width="112.56"></path>
                    <path transform="matrix(-.46631 .80802 -.80768 -.46651 -304.88 496.69)" d="m823.84 632.91h-835.52l417.76-723.57z" fill="none" stroke="#fff" stroke-width="107.2"></path>
                    <path transform="matrix(-.46631 .80802 -.80768 -.46651 -304.88 496.69)" d="m823.84 632.91h-835.52l417.76-723.57z" fill="#fff" stroke="#f00" stroke-width="75.041"></path>
                    </g>
                    <g transform="matrix(.70711 .70711 -.70711 .70711 997.43 652.92)" stroke="#000" stroke-width="1.0065">
                    <rect transform="scale(-1,1)" x="465.77" y="210.96" width="68.469" height="373.94"></rect>
                    <rect transform="matrix(0,-1,-1,0,0,0)" x="-432.16" y="313.03" width="68.469" height="373.94"></rect>
                    </g>
                    </g>
                    </g>
                    <metadata>
                    <rdf:rdf>
                    <cc:work>
                    <dc:format>image/svg+xml</dc:format>
                    <dc:type rdf:resource="http://purl.org/dc/dcmitype/StillImage"></dc:type>
                    <cc:license rdf:resource="http://creativecommons.org/licenses/publicdomain/"></cc:license>
                    <dc:publisher>
                    <cc:agent rdf:about="http://openclipart.org/">
                    <dc:title>Openclipart</dc:title>
                    </cc:agent>
                    </dc:publisher>
                    <dc:title></dc:title>
                    <dc:date>2012-11-25T03:20:35</dc:date>
                    <dc:description>Road, Sign, France</dc:description>
                    <dc:source>https://openclipart.org/detail/173248/-by-desmoric-173248</dc:source>
                    <dc:creator>
                    <cc:agent>
                    <dc:title>Desmoric</dc:title>
                    </cc:agent>
                    </dc:creator>
                    <dc:subject>
                    <rdf:bag>
                    <rdf:li>France</rdf:li>
                    <rdf:li>Road</rdf:li>
                    <rdf:li>Sign</rdf:li>
                    </rdf:bag>
                    </dc:subject>
                    </cc:work>
                    <cc:license rdf:about="http://creativecommons.org/licenses/publicdomain/">
                    <cc:permits rdf:resource="http://creativecommons.org/ns#Reproduction"></cc:permits>
                    <cc:permits rdf:resource="http://creativecommons.org/ns#Distribution"></cc:permits>
                    <cc:permits rdf:resource="http://creativecommons.org/ns#DerivativeWorks"></cc:permits>
                    </cc:license>
                    </rdf:rdf>
                    </metadata>
                </svg>    
            </div>
            
            <div>
                <h3 class="primary">{{ session()->get("error") }}</h3>
            </div>
        </div>

     </div>
   </div>
   <script>
       let successBody = document.querySelector('#error-actions-body');
       (function(){
           let successButton = document.querySelector('#error-actions-closeButton');
           console.log(successButton);

           successButton.addEventListener('click',function(){
                successBody.classList.add('scale-0');
           });

           clearTimeOutId = setTimeout(function(){
                successBody.classList.add('scale-0');
            },10000);
       
       }());
   </script>
@endif
<!-- ////////// buyer successfully actions end ///////// -->



@if(session()->has("localError"))
    <!-- error 1 -->
    <div id="error" class="flex justify-start items-center p-1">
        <!-- error cross red svg -->
        <svg width="16" height="16" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M13.6479 1.57278L8.99994 6.22103C7.45069 4.67228 5.90094 3.12203 4.35144 1.57278C2.55893 -0.219723 -0.219566 2.55978 1.57143 4.35278C3.12118 5.90103 4.67144 7.45153 6.21944 9.00078C4.67073 10.5507 3.12139 12.1001 1.57143 13.6488C-0.219566 15.4408 2.55918 18.2195 4.35144 16.4288C5.90069 14.879 7.45044 13.329 8.99969 11.7803L13.6477 16.4288C15.4402 18.2208 18.2194 15.441 16.4277 13.6488C14.8779 12.099 13.3287 10.5498 11.7784 9.00028C13.3284 7.45053 14.8777 5.90078 16.4277 4.35128C18.2197 2.55978 15.4404 -0.219723 13.6477 1.57378" fill="#FF3D3D"/>
        </svg>
        <div class=" ml-4 text-red-600 font-bold">{{ session()->get("localError") }}</div>
    </div>
@endif
