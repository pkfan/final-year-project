
/**********************************'
 * PRODUCT PAGE TAB FOR DESCRIPTION, SHOP AND SUPPLLIER DETAILS
 **********************************/
// for tab of product page start
// tab click to fetch category data with APIs

function insertProductPageDescripiton(description){
    let tabBody = document.querySelector('#productPage-tab-section-body');

    tabBody.innerHTML = ''; // clear body before insert description

    console.log('#product-tab-sectin-body...',tabBody);

    let body =  `<p>
                    ${description}
                </p>`;

    // console.log(tabBody);
    
    tabBody.insertAdjacentHTML('beforeend', body);
}


function insertProductPageShopDetail(shop){
    let tabBody = document.querySelector('#productPage-tab-section-body');

    tabBody.innerHTML = ''; // clear body before insert description

    console.log('#product-tab-sectin-body...',tabBody);


    let body =  `<span class=" w-10/12 mx-auto">
                    <img class=" rounded-xl border-4 border-gray-4 shadow-lg shadow-gray-3" width="100%" src="${website_domain_name}/${shop.shop_image}" alt="">
                </span>
                <table class=" w-full border border-black my-8 p-4 ">
                    <tr>
                        <td  class="w-1/4 border border-black p-2">Shop Name</td>
                        <td  class="w-3/4 border border-black p-2">${shop.name}</td>
                    </tr>
                    <tr>
                        <td  class="w-1/4 border border-black p-2">Address</td>
                        <td  class="w-3/4 border border-black p-2">${shop.address}</td>
                    </tr>
                    <tr>
                        <td  class="w-1/4 border border-black p-2">State</td>
                        <td  class="w-3/4 border border-black p-2">${shop.state}</td>
                    </tr>
                    <tr>
                        <td  class="w-1/4 border border-black p-2">City</td>
                        <td  class="w-3/4 border border-black p-2">${shop.city}</td>
                    </tr>
                    <tr>
                        <td  class="w-1/4 border border-black p-2">About Shop</td>
                        <td  class="w-3/4 border border-black p-2">${shop.description}</td>
                    </tr>
                </table>`;

    // console.log(tabBody);
    
    tabBody.insertAdjacentHTML('beforeend', body);
}

function insertProductPageSupplierDetail(supplier){
    let tabBody = document.querySelector('#productPage-tab-section-body');

    tabBody.innerHTML = ''; // clear body before insert description

    console.log('#product-tab-sectin-body...',tabBody);

    let body =  `<span class=" w-10/12 mx-auto">
                    <img class=" rounded-xl border-4 border-gray-4 shadow-lg shadow-gray-3" width="100%" src="${website_domain_name}/${supplier.profile_image}" alt="">
                </span>
                <table class=" w-full border border-black my-8 p-4 ">
                    <tr>
                        <td  class="w-1/4 border border-black p-2">Supplier Name</td>
                        <td  class="w-3/4 border border-black p-2">${supplier.first_name} ${supplier.last_name}</td>
                    </tr>
                    <tr>
                        <td  class="w-1/4 border border-black p-2">Supplier Address</td>
                        <td  class="w-3/4 border border-black p-2">${supplier.address}</td>
                    </tr>
                    <tr>
                        <td  class="w-1/4 border border-black p-2">Supplier Email</td>
                        <td  class="w-3/4 border border-black p-2">${supplier.email}</td>
                    </tr>
                    <tr>
                        <td  class="w-1/4 border border-black p-2">Phone Number</td>
                        <td  class="w-3/4 border border-black p-2">0${supplier.phone_number}</td>
                    </tr>
                    <tr>
                        <td  class="w-1/4 border border-black p-2">About Supplier</td>
                        <td  class="w-3/4 border border-black p-2">${supplier.about}</td>
                    </tr>
                </table>`;

    // console.log(tabBody);
    
    tabBody.insertAdjacentHTML('beforeend', body);
}

function onClickProductPageTab(event){
    let tabAllCategory = document.querySelectorAll('#productPage-tab-section ul li button')
    console.log('tab all category data....',tabAllCategory);

    tabAllCategory.forEach(function(tab){
        tab.classList.remove('active');
    });
    event.classList.add('active');
    // console.log(event.getAttribute('id'));

    let type = event.getAttribute('type');

    console.log('type...', type);

    // getting data from local storage of current seted product
    ProductDataFromLocalHost = JSON.parse(window.sessionStorage.getItem('productFromProductControllerToProductPage'));



    if(type == 'Product Description'){
        insertProductPageDescripiton(ProductDataFromLocalHost.description);
    }
    else if(type == 'Shop Detail'){
        insertProductPageShopDetail(ProductDataFromLocalHost.shop);
    } 
    else if(type == 'About Supplier'){
        insertProductPageSupplierDetail(ProductDataFromLocalHost.shop.supplier);
    }
    else{
        alert('[line 133] : type of product page tabs not matchings...')
    }
    
}

// for tab of product page end

/**********************************'
 * RECOMMENDED PRODCUTS START
 **********************************/

 function insertMessageForImptyComments(productComment,number){
    let productPageComment = document.querySelector('#product-page-all-comments-load-more-button');
    
    let comment = `<h2>Be first one to POST COMMENT for this product<h2>`;

    productPageComment.parentNode.innerHTML = comment;
}

// for recommed section products cards start
function createProductPageComment(productComment,number){
    let productPageComment = document.querySelector('#product-page-all-comments');
    
    let comment = ` <!-- comment start -->
                <div class=" flex flex-col justify-center border-2 border-gray-3 rounded-xl p-4 my-4">
                    <div class=" flex items-center space-x-4 border-b-2 border-gray-3 pb-4 mb-4">
                        <span>
                            <img class=" rounded-[100%] border-4 border-gray-3 max-w-[80px] max-h-[80px]" width="80" height="80" src="${website_domain_name}/${productComment.profile_image}" alt="">
                        </span>
                        <div>
                            <h2>${productComment.first_name} ${productComment.last_name}</h2>
                            <div class="flex items-center">
                                <!-- all rating stars -->
                                <div id="product-page-all-comments-stars-${number}" class="flex items-center">
                                    <!-- start start -->
                                        <!-- stars are inserted here by javascript  -->
                                    <!-- end start -->
                                    <!-- count rating -->
                                </div>
                                <span class=" secondary-2  px-2">${parseFloat(productComment.product_rating).toFixed(1)}</span>
                                <!-- all rating stars end -->
                            </div>
                            <div>
                                Posted at: ${productComment.added_on}
                            </div>
                        </div>
                    </div>
                    <div>
                        ${productComment.product_comment}                    
                    </div>
                </div>
                <!-- comment end -->`;

    // console.log(tabCards);
    
    productPageComment.insertAdjacentHTML('beforeend', comment);
    addProductStars(Math.round(productComment.product_rating),`#product-page-all-comments-stars-${number}`);

}
function insertProductPageCommentDataAfterFetched(status, productCommentsArray, startFrom){
    if(status == 200){
        // console.log('executed after status 200 true...');
        productCommentsArray.forEach(function(productComment,index){
            createProductPageComment(productComment,index+startFrom);
        });
    }
    else{
        alert(`status code : ${status},(cannot get data)`);
    }
}

function hasProductPageCommentDataWithPagination(status, responseData){
    let loadMoreButton = document.querySelector('#product-page-all-comments-load-more-button');
    let loadMoreButtonText = document.querySelector('#product-page-all-comments-load-more-button span');
    loadMoreButton.setAttribute('nextRecommendPage',responseData.current_page+1);
    loadMoreButton.setAttribute('nextPageUrl',responseData.next_page_url);
    // console.log(loadMoreButton);
    // console.log(loadMoreButtonText);
    if(!responseData.next_page_url){
        loadMoreButtonText.innerHTML = "Results Ended";
    }

    if(responseData.data.length == 0){
        // console.log('there are no comment for this post',responseData.data.length);
        insertMessageForImptyComments();
    }
    else{
        // console.log('current page',responseData.current_page);
        // console.log('responseData.from',responseData.from);
        let startFrom = parseInt(responseData.from);
        insertProductPageCommentDataAfterFetched(status,responseData.data,startFrom);
    }

}
// fetch recommed section data with APIs
function fetchProductPageCommentData(product_id=1,pageNumber=1){
    // axios.get('https://jsonplaceholder.typicode.com/users')
    axios.get(`${website_domain_name}/api/product/getCommentsAndRatings/${product_id}?page=${pageNumber}`)
        .then(function (response) {
            // handle success

            // showLoader('#recommended-section-loader');
            // console.log('[recommended]',response.status);
            console.log('[comments data]', response.data);

            hasProductPageCommentDataWithPagination(response.status, response.data);
                            // hideLoader('#recommended-section-loader');
        })
        .catch(function (error) {
            // handle error
            alert('recommended axios feched errors.')
            // console.log(error);
        });
}

function onClickLoadMoreProductPageComment(event){
    // console.log(event.getAttribute('nextrecommendpage'));
    ProductDataFromLocalHost = JSON.parse(window.sessionStorage.getItem('productFromProductControllerToProductPage'));

    nextPageNumber = parseInt(event.getAttribute('nextrecommendpage'));
    nextPageUrl = event.getAttribute('nextPageUrl');

    console.log(nextPageUrl);
    if(nextPageUrl != 'null'){
        fetchProductPageCommentData(ProductDataFromLocalHost.id, nextPageNumber);
    }
}


/**********************************'
 * PRODUCT PAGE comments fucntion with emoji
 **********************************/
 function setStarsHiddenFieldOfProductPage(startCount){
    let starsField = document.querySelector('#productPage-stars-field');
    starsField.setAttribute('value',startCount)
}

// for recommed section products cards start
function insertCommentEmojiForProductPage(starCount){
    let commentEmoji = document.querySelector('#product-page-comment-emoji');
    // removing current emoji 
    commentEmoji.innerHTML = '';

    let commentEmojiSvg = null;

    if(startCount == 1){
        commentEmojiSvg = `
            <?xml version="1.0" encoding="UTF-8" standalone="no"?>
            <svg
            xmlns:dc="http://purl.org/dc/elements/1.1/"
            xmlns:cc="http://creativecommons.org/ns#"
            xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
            xmlns:svg="http://www.w3.org/2000/svg"
            xmlns="http://www.w3.org/2000/svg"
            width="200"
            height="200"
            viewBox="0 0 50.826003 53.999999"
            id="svg4625"
            version="1.1">
            <defs
                id="defs4627" />
            <metadata
                id="metadata4630">
                <rdf:RDF>
                <cc:Work
                    rdf:about="">
                    <dc:format>image/svg+xml</dc:format>
                    <dc:type
                    rdf:resource="http://purl.org/dc/dcmitype/StillImage" />
                    <dc:title></dc:title>
                </cc:Work>
                </rdf:RDF>
            </metadata>
            <path
                id="path4485-5-5"
                d="M 3.4694403e-4,47.466184 C 0.07921034,51.638457 17.047355,48.640451 20.025338,51.471183 23.00331,54.301915 31.280363,53.71606 33.566053,50.612963 35.851743,47.509878 50.921405,49.377052 50.82569,45.654398 50.729997,41.931733 40.077753,46.012315 38.619978,40.600473 30.202621,37.22813 13.423048,36.807241 9.7267711,39.932961 13.462458,45.23202 -0.07857039,43.293912 3.4694403e-4,47.466184 Z"
                style="fill:#3daeff;fill-opacity:0.61349697;fill-rule:evenodd;stroke:none;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" />
            <circle
                r="19.141293"
                cy="30.03434"
                cx="25.186176"
                id="path4138-0-0-4-1-9-8-7"
                style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:#f8ad32;fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1.25;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" />
            <path
                id="path4138-2-28-0-4-5-4-6-9"
                d="M 44.529679,5.33784 A 15.244264,15.244264 0 0 0 23.61967,10.584335 15.244264,15.244264 0 0 0 23.367447,11.042396 15.244264,15.244264 0 0 0 24.20916,11.605464 15.244264,15.244264 0 0 0 45.120981,6.360051 15.244264,15.244264 0 0 0 45.372114,5.9037966 15.244264,15.244264 0 0 0 44.529679,5.3378336 Z"
                style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:#479f00;fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1.25;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" />
            <path
                id="path4138-2-5-2-4-7-3-73-7-1"
                d="M 5.6293439,9.4293862 A 11.709531,11.709531 0 0 1 22.13091,10.812129 11.709531,11.709531 0 0 1 22.378958,11.128054 11.709531,11.709531 0 0 1 21.810764,11.659312 11.709531,11.709531 0 0 1 5.3079459,10.277613 11.709531,11.709531 0 0 1 5.0609664,9.9629246 11.709531,11.709531 0 0 1 5.6293331,9.4293797 Z"
                style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:#479f00;fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1.25;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" />
            <ellipse
                ry="0.78303552"
                rx="1.7072622"
                cy="27.730967"
                cx="19.932268"
                id="path4213-6-3-5-8-9-48-65-7"
                style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:#992500;fill-opacity:1;fill-rule:evenodd;stroke:#9a2400;stroke-width:1.07884252;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" />
            <ellipse
                ry="0.78303552"
                rx="1.7072622"
                cy="27.730967"
                cx="30.440042"
                id="path4213-6-6-7-8-8-3-21-7-5"
                style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:#992500;fill-opacity:1;fill-rule:evenodd;stroke:#9a2400;stroke-width:1.07884252;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" />
            <path
                id="path4249-92-8-2-2-9-6-9"
                d="m 34.219465,41.788635 c -4.239711,-6.090433 -5.512001,-0.0191 -9.030862,-0.0191 -3.521008,0 -4.604101,-5.878927 -9.035533,0.0232"
                style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:none;fill-opacity:1;fill-rule:evenodd;stroke:#9a2400;stroke-width:1.61826384;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" />
            <path
                id="path4408-32-3"
                d="m 18.125812,30.062808 3.528215,4.64e-4"
                style="fill:none;fill-rule:evenodd;stroke:#c4f3ff;stroke-width:2.15768528;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" />
            <path
                id="path4408-0-6-2"
                d="m 28.718331,30.062808 3.528215,4.64e-4"
                style="fill:none;fill-rule:evenodd;stroke:#c4f3ff;stroke-width:2.15768528;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" />
            <path
                style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:none;fill-opacity:1;fill-rule:evenodd;stroke:#9a2400;stroke-width:1.29461122;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate"
                d="m 15.34894,24.073532 c 1.36083,-3.185455 3.092265,-4.156413 4.457669,-4.295519"
                id="path4624-0-1-7-8-4" />
            <path
                style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:none;fill-opacity:1;fill-rule:evenodd;stroke:#9a2400;stroke-width:1.29461122;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate"
                d="M 35.023415,24.073532 C 33.662584,20.888077 31.93115,19.917119 30.565745,19.778013"
                id="path4624-0-1-7-8-6" />
            <path
                id="path4735"
                d="M 17.990734,30.360358 C 12.972433,29.760403 7.7519888,34.310853 11.30383,42.190935"
                style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:none;fill-opacity:1;fill-rule:evenodd;stroke:#c4f3ff;stroke-width:1.61826384;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" />
            <path
                id="path4735-0"
                d="m 32.381609,30.360358 c 5.018301,-0.599955 10.238745,3.950495 6.686904,11.830577"
                style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:none;fill-opacity:1;fill-rule:evenodd;stroke:#c4f3ff;stroke-width:1.61826384;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" />
            </svg>`;
    }
    else if(startCount == 2){
        
        commentEmojiSvg = ` 
            <?xml version="1.0" encoding="UTF-8" standalone="no"?>
            <svg
            xmlns:dc="http://purl.org/dc/elements/1.1/"
            xmlns:cc="http://creativecommons.org/ns#"
            xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
            xmlns:svg="http://www.w3.org/2000/svg"
            xmlns="http://www.w3.org/2000/svg"
            xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
            xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
            version="1.1"
            id="svg4625"
            viewBox="0 0 40.221212 53.999968"
            height="200"
            width="200"
            inkscape:version="0.91pre3 r13670"
            sodipodi:docname="clem3_depit.svg">
            <sodipodi:namedview
                pagecolor="#ffffff"
                bordercolor="#666666"
                borderopacity="1"
                objecttolerance="10"
                gridtolerance="10"
                guidetolerance="10"
                inkscape:pageopacity="0"
                inkscape:pageshadow="2"
                inkscape:window-width="1600"
                inkscape:window-height="837"
                id="namedview14"
                showgrid="false"
                inkscape:zoom="11.864879"
                inkscape:cx="20.110605"
                inkscape:cy="26.999985"
                inkscape:window-x="-8"
                inkscape:window-y="-8"
                inkscape:window-maximized="1"
                inkscape:current-layer="svg4625" />
            <defs
                id="defs4627">
                <pattern
                id="EMFhbasepattern"
                patternUnits="userSpaceOnUse"
                width="6"
                height="6"
                x="0"
                y="0" />
            </defs>
            <metadata
                id="metadata4630">
                <rdf:RDF>
                <cc:Work
                    rdf:about="">
                    <dc:format>image/svg+xml</dc:format>
                    <dc:type
                    rdf:resource="http://purl.org/dc/dcmitype/StillImage" />
                    <dc:title />
                </cc:Work>
                </rdf:RDF>
            </metadata>
            <path
                id="path4173"
                d="m 39.413544,10.225298 c -7.188077,-4.3613707 -16.556946,-2.0192803 -20.91821,5.249671 -0.08078,0.08013 -0.161519,0.24039 -0.242298,0.404085 0.323077,0.24039 0.56536,0.403703 0.888426,0.565108 7.188077,4.361371 16.556946,2.019281 20.837443,-5.24967 0.08078,-0.08013 0.161519,-0.244207 0.242298,-0.403704 -0.242298,-0.24039 -0.56536,-0.404085 -0.807659,-0.56549 z"
                style="fill:#479f00;fill-opacity:1;fill-rule:evenodd;stroke:none"
                inkscape:connector-curvature="0" />
            <path
                id="path4175"
                d="M 0.56535792,14.263477 C 5.4920508,10.144405 12.841704,10.709895 17.041544,15.636756 c 0.08078,0.16026 0.16152,0.24039 0.242299,0.324336 -0.16152,0.24039 -0.403834,0.403703 -0.565365,0.56549 C 11.791744,20.645654 4.4421052,20.080164 0.24229597,15.153685 0.16151712,15.073555 0.08077644,14.913295 -2.4067752e-6,14.829349 0.16151712,14.669088 0.40382313,14.425645 0.5653541,14.263859 Z"
                style="fill:#479f00;fill-opacity:1;fill-rule:evenodd;stroke:none"
                inkscape:connector-curvature="0" />
            <path
                id="path4177"
                d="m 39.171246,34.858839 c 0,10.580235 -8.561104,19.14119 -19.06059,19.14119 -10.5803308,0 -19.14147255,-8.560955 -19.14147255,-19.14119 0,-10.580235 8.56114175,-19.141572 19.14147255,-19.141572 10.499486,0 19.06059,8.561337 19.06059,19.141572 z"
                style="fill:#f8ad32;fill-opacity:1;fill-rule:evenodd;stroke:none"
                inkscape:connector-curvature="0" />
            <path
                id="path4179"
                d="m 16.637711,32.112663 c 0,0.8883 -0.726895,1.615196 -1.696089,1.615196 -0.888426,0 -1.615321,-0.726896 -1.615321,-1.615196 0,-0.969193 0.726895,-1.696088 1.615321,-1.696088 0.969194,0 1.696089,0.726895 1.696089,1.696088 z"
                style="fill:#9a2400;fill-opacity:1;fill-rule:evenodd;stroke:#9a2400;stroke-width:1.04995191px;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                inkscape:connector-curvature="0" />
            <path
                id="path4181"
                d="m 26.894903,32.112663 c 0,0.8883 -0.807662,1.615196 -1.696088,1.615196 -0.888426,0 -1.615322,-0.726896 -1.615322,-1.615196 0,-0.969193 0.726896,-1.696088 1.615322,-1.696088 0.888426,0 1.696088,0.726895 1.696088,1.696088 z"
                style="fill:#9a2400;fill-opacity:1;fill-rule:evenodd;stroke:#9a2400;stroke-width:1.04995191px;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                inkscape:connector-curvature="0" />
            <path
                id="path4183"
                d="m 29.075589,45.761884 c -2.261453,-2.261197 -5.492096,-3.634094 -8.964933,-3.634094 -3.553709,0 -6.703587,1.372897 -9.045808,3.634094"
                style="fill:none;stroke:#9a2400;stroke-width:2.18066931px;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                inkscape:connector-curvature="0" />
            </svg>`;
    }
    else if(startCount == 3){
        
        commentEmojiSvg = ` 
            <?xml version="1.0" encoding="UTF-8" standalone="no"?>
            <svg
            xmlns:dc="http://purl.org/dc/elements/1.1/"
            xmlns:cc="http://creativecommons.org/ns#"
            xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
            xmlns:svg="http://www.w3.org/2000/svg"
            xmlns="http://www.w3.org/2000/svg"
            xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
            xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
            version="1.1"
            id="svg4625"
            viewBox="0 0 38.292345 54"
            height="200"
            width="200"
            inkscape:version="0.91pre3 r13670"
            sodipodi:docname="clem1_sourir.svg">
            <sodipodi:namedview
                pagecolor="#ffffff"
                bordercolor="#666666"
                borderopacity="1"
                objecttolerance="10"
                gridtolerance="10"
                guidetolerance="10"
                inkscape:pageopacity="0"
                inkscape:pageshadow="2"
                inkscape:window-width="1600"
                inkscape:window-height="837"
                id="namedview12"
                showgrid="false"
                fit-margin-top="0"
                fit-margin-left="0"
                fit-margin-right="0"
                fit-margin-bottom="0"
                inkscape:zoom="18.221449"
                inkscape:cx="1.2254493"
                inkscape:cy="22.302094"
                inkscape:window-x="-8"
                inkscape:window-y="-8"
                inkscape:window-maximized="1"
                inkscape:current-layer="svg4625" />
            <defs
                id="defs4627" />
            <metadata
                id="metadata4630">
                <rdf:RDF>
                <cc:Work
                    rdf:about="">
                    <dc:format>image/svg+xml</dc:format>
                    <dc:type
                    rdf:resource="http://purl.org/dc/dcmitype/StillImage" />
                    <dc:title />
                </cc:Work>
                </rdf:RDF>
            </metadata>
            <path
                inkscape:connector-curvature="0"
                style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:#479f00;fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1.25;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate"
                d="M 35.081232,-3.964064e-5 A 15.248149,15.248149 0 0 0 19.834476,15.24889 a 15.248149,15.248149 0 0 0 0.01899,0.522719 15.248149,15.248149 0 0 0 1.011674,0.0512 A 15.248149,15.248149 0 0 0 36.114001,0.57387921 15.248149,15.248149 0 0 0 36.095009,0.05340025 15.248149,15.248149 0 0 0 35.081232,6.0035808e-4 Z"
                id="path4138-2" />
            <path
                inkscape:connector-curvature="0"
                style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:#479f00;fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1.25;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate"
                d="M 6.5173132,3.668753 A 11.712515,11.712515 0 0 1 18.22876,15.38185 11.712515,11.712515 0 0 1 18.2142,15.783289 11.712515,11.712515 0 0 1 17.437105,15.821689 11.712515,11.712515 0 0 1 5.7240404,4.1085921 a 11.712515,11.712515 0 0 1 0.01456,-0.3998392 11.712515,11.712515 0 0 1 0.7787128,-0.04 z"
                id="path4138-2-5" />
            <circle
                style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:#faac2c;fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1.25;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate"
                id="path4138"
                cx="19.146172"
                cy="34.85379"
                r="19.146172" />
            <circle
                style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:#992500;fill-opacity:1;fill-rule:evenodd;stroke:#9a2400;stroke-width:1.079;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate;filter-blend-mode:normal;filter-gaussianBlur-deviation:0"
                id="path4213-6"
                cx="14.015682"
                cy="29.914738"
                r="1.6671649" />
            <circle
                style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:#992500;fill-opacity:1;fill-rule:evenodd;stroke:#9a2400;stroke-width:1.079;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate;filter-blend-mode:normal;filter-gaussianBlur-deviation:0"
                id="path4213-6-6"
                cx="24.276669"
                cy="29.914738"
                r="1.6671649" />
            <path
                inkscape:connector-curvature="0"
                style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:none;fill-opacity:1;fill-rule:evenodd;stroke:#9a2500;stroke-width:2.15823507;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate"
                d="m 5.2260841,36.485807 1.0791175,0 c 0.8593876,6.332308 6.2741734,11.217258 12.8421034,11.217258 6.567929,0 11.980427,-4.88495 12.839816,-11.217258 l 1.079116,0"
                id="path4249" />
            </svg>`;
    }
    else if(startCount == 4){
        
        commentEmojiSvg = ` 
            <?xml version="1.0" encoding="UTF-8" standalone="no"?>
            <svg
            xmlns:dc="http://purl.org/dc/elements/1.1/"
            xmlns:cc="http://creativecommons.org/ns#"
            xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
            xmlns:svg="http://www.w3.org/2000/svg"
            xmlns="http://www.w3.org/2000/svg"
            version="1.1"
            id="svg4625"
            viewBox="0 0 41.195002 53.999999"
            height="200"
            width="200">
            <defs
                id="defs4627">
                <pattern
                id="EMFhbasepattern"
                patternUnits="userSpaceOnUse"
                width="6"
                height="6"
                x="0"
                y="0" />
            </defs>
            <metadata
                id="metadata4630">
                <rdf:RDF>
                <cc:Work
                    rdf:about="">
                    <dc:format>image/svg+xml</dc:format>
                    <dc:type
                    rdf:resource="http://purl.org/dc/dcmitype/StillImage" />
                    <dc:title></dc:title>
                </cc:Work>
                </rdf:RDF>
            </metadata>
            <path
                style="fill:#f8ad32;fill-opacity:1;fill-rule:evenodd;stroke:none"
                d="m 38.274143,34.822416 c 0,10.600218 -8.577258,19.177587 -19.096561,19.177587 C 8.5772991,54.000003 -7.631152e-7,45.422634 -7.631152e-7,34.822416 -7.631152e-7,24.303113 8.5772991,15.725752 19.177582,15.725752 c 10.519303,0 19.096561,8.577361 19.096561,19.096664 z"
                id="path4146" />
            <path
                style="fill:#479f00;fill-opacity:1;fill-rule:evenodd;stroke:none"
                d="M 40.378023,9.8996796 C 33.419138,5.7728693 24.437178,8.0385663 20.229525,14.997482 c -0.08093,0.161824 -0.161825,0.242755 -0.242756,0.404595 0.323687,0.242755 0.566427,0.404591 0.809183,0.566431 6.958888,4.126845 16.021657,1.861125 20.148502,-5.016898 0.08093,-0.161824 0.161824,-0.323687 0.242755,-0.485511 -0.242755,-0.161824 -0.56643,-0.323648 -0.809186,-0.5664194 z"
                id="path4148" />
            <path
                style="fill:#479f00;fill-opacity:1;fill-rule:evenodd;stroke:none"
                d="m 8.5772991,3.6689966 c 6.4734389,0 11.7331409,5.2596608 11.7331409,11.7330804 0,0.08093 0,0.242755 -0.08093,0.404591 -0.242755,0 -0.485511,0 -0.728267,0 -6.47348,0 -11.7331294,-5.259649 -11.7331294,-11.73308 0,-0.080931 0,-0.2427556 0,-0.4045914 0.2427555,0 0.5664156,0 0.8091712,0 z"
                id="path4150" />
            <path
                style="fill:none;stroke:#9a2400;stroke-width:1.29468679px;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                d="m 29.049538,27.296993 c 0.323687,-4.855005 -3.479498,-7.20164 -7.039916,-6.392458"
                id="path4152" />
            <path
                style="fill:none;stroke:#9a2400;stroke-width:1.29468679px;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                d="m 8.2536237,27.054237 c 0.3236868,-1.699182 1.9420333,-2.83204 4.3695583,-2.670204"
                id="path4154" />
            <path
                style="fill:#ffffff;fill-opacity:1;fill-rule:evenodd;stroke:none"
                d="m 28.806782,38.94926 c -5.907053,-0.08093 -7.525315,0.728267 -9.871955,1.537347 -2.26572,0.647346 -5.097867,1.294697 -12.4613892,0.728266 2.5893724,4.450517 7.4444422,7.201751 12.6232252,7.201751 6.068782,0 11.490324,-3.722257 13.675124,-9.305524 -1.456533,-0.08093 -2.832147,-0.161824 -3.965005,-0.161824 z"
                id="path4156" />
            <path
                style="fill:none;stroke:#595959;stroke-width:1.29468679px;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                d="m 1.1328458,31.019246 36.0084352,0"
                id="path4158" />
            <path
                style="fill:#595959;fill-opacity:1;fill-rule:evenodd;stroke:none"
                d="m 22.252378,28.429851 7.849098,0 c 0.971022,0 1.780209,0.809186 1.780209,1.780209 l 0,3.317662 c 0,2.913067 -2.993987,3.965005 -3.965009,3.965005 l -3.479498,0 c -0.971022,0 -3.883982,-1.294694 -3.883982,-3.965005 l 0,-3.317662 c 0,-0.971023 0.728271,-1.780209 1.699182,-1.780209 z"
                id="path4160" />
            <path
                style="fill:#595959;fill-opacity:1;fill-rule:evenodd;stroke:none"
                d="m 8.1727039,28.429851 7.8490561,0 c 0.971022,0 1.699289,0.809186 1.699289,1.780209 l 0,3.317662 c 0,2.913067 -2.913067,3.965005 -3.884089,3.965005 l -3.479464,0 c -0.9710142,0 -3.964978,-1.294694 -3.964978,-3.965005 l 0,-3.317662 c 0,-0.971023 0.8091751,-1.780209 1.7801859,-1.780209 z"
                id="path4162" />
            <path
                style="fill:#ffffff;fill-opacity:1;fill-rule:evenodd;stroke:none"
                d="m 23.627995,29.967304 c -0.809186,0 -1.456533,0.566431 -1.456533,1.375614 l 0,0.323687 c 0.323687,0.08093 0.728267,0.08093 1.051938,0.08093 1.699289,0 3.236743,-0.728267 3.884089,-1.780205 l -3.479494,0 z"
                id="path4164" />
            <path
                style="fill:#ffffff;fill-opacity:1;fill-rule:evenodd;stroke:none"
                d="m 9.5483099,29.967304 c -0.809175,0 -1.5374303,0.566431 -1.5374303,1.375614 l 0,0.323687 c 0.4045799,0.08093 0.7282553,0.08093 1.1328466,0.08093 1.6992468,0 3.1557808,-0.728267 3.8031308,-1.780205 l -3.3985471,0 z"
                id="path4166" />
            </svg>`;
    }
    else if(startCount == 5){
        
        commentEmojiSvg = `
            <?xml version="1.0" encoding="UTF-8" standalone="no"?>
            <svg
            xmlns:dc="http://purl.org/dc/elements/1.1/"
            xmlns:cc="http://creativecommons.org/ns#"
            xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
            xmlns:svg="http://www.w3.org/2000/svg"
            xmlns="http://www.w3.org/2000/svg"
            width="200"
            height="200"
            viewBox="0 0 54.000003 53.999999"
            id="svg4625"
            version="1.1">
            <defs
                id="defs4627" />
            <metadata
                id="metadata4630">
                <rdf:RDF>
                <cc:Work
                    rdf:about="">
                    <dc:format>image/svg+xml</dc:format>
                    <dc:type
                    rdf:resource="http://purl.org/dc/dcmitype/StillImage" />
                    <dc:title></dc:title>
                </cc:Work>
                </rdf:RDF>
            </metadata>
            <path
                transform="matrix(0.64172577,0.2855999,-0.28559845,0.64172904,-472.04655,-389.15727)"
                d="m 867.25767,248.63878 -8.79214,-2.00489 -4.39318,7.87537 -0.81016,-8.98137 -8.84749,-1.74454 8.29145,-3.5459 -1.07488,-8.95355 5.93455,6.78988 8.18318,-3.78907 -4.62369,7.74229 z"
                id="path4641-2"
                style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:#ffc601;fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" />
            <path
                id="path4608-3-3"
                d="m 8.4137878,10.21874 -5.39e-5,5.461953"
                style="fill:none;fill-rule:evenodd;stroke:#ffffff;stroke-width:1.83395159;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" />
            <path
                id="path4608-0"
                d="m 8.4137339,15.680693 0,23.329002"
                style="fill:none;fill-rule:evenodd;stroke:#515151;stroke-width:1.83395159;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" />
            <path
                id="path4138-2-5-2-4-7-8-3"
                d="m 4.0809918,25.79912 a 11.708985,11.709045 0 0 1 11.7079172,11.709595 11.708985,11.709045 0 0 1 -0.0151,0.401378 11.708985,11.709045 0 0 1 -0.776946,0.03884 11.708985,11.709045 0 0 1 -11.7095357,-11.709584 11.708985,11.709045 0 0 1 0.015103,-0.399759 11.708985,11.709045 0 0 1 0.7785644,-0.04046 z"
                style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:#479f00;fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1.25;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" />
            <ellipse
                ry="19.140499"
                rx="19.1404"
                cy="34.859509"
                cx="34.775581"
                id="path4138-0-0-4-5-3"
                style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:#f8ad32;fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1.25;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" />
            <ellipse
                ry="1.6666709"
                rx="1.6666625"
                cy="29.921871"
                cx="29.64679"
                id="path4213-6-3-5-8-98-1"
                style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:#992500;fill-opacity:1;fill-rule:evenodd;stroke:#9a2400;stroke-width:1.07879508;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" />
            <ellipse
                ry="1.6666709"
                rx="1.6666625"
                cy="29.921871"
                cx="39.904682"
                id="path4213-6-6-7-8-8-7-0"
                style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:#992500;fill-opacity:1;fill-rule:evenodd;stroke:#9a2400;stroke-width:1.07879508;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" />
            <path
                id="path4249-92-8-2-1-2"
                d="m 20.859848,36.491107 1.078792,0 c 0.85915,6.330342 6.272314,11.213833 12.838276,11.213833 6.565961,0 11.976719,-4.883491 12.835869,-11.213833 l 1.078793,0"
                style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:none;fill-opacity:1;fill-rule:evenodd;stroke:#9a2400;stroke-width:2.15759015;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" />
            <path
                id="path4704"
                d="M 27.360984,11.596682 C 26.604827,15.646101 21.816672,19.284163 19.355062,23.403401 32.514915,21.31555 41.312412,22.153204 50.023671,23.294249 47.106832,18.22391 45.914659,11.526086 40.802424,6.786064 35.690232,2.0460422 28.10808,-0.41395119 20.313806,0.34941692 25.698296,3.5672118 28.117099,7.5472529 27.360984,11.596682 Z"
                style="fill:#1260ee;fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1.1353085px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" />
            <ellipse
                ry="1.2810724"
                rx="1.2810658"
                cy="5.2163053"
                cx="31.442875"
                id="path4820"
                style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:#ffffff;fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1.70000005;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:0.22699387;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" />
            <ellipse
                ry="1.2810724"
                rx="1.2810658"
                cy="10.947418"
                cx="39.196693"
                id="path4820-2"
                style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:#ffffff;fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1.70000005;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:0.22699387;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" />
            <ellipse
                ry="1.2810724"
                rx="1.2810658"
                cy="12.430765"
                cx="31.914846"
                id="path4820-3"
                style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:#ffffff;fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1.70000005;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:0.22699387;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" />
            <ellipse
                ry="1.2810724"
                rx="1.2810658"
                cy="17.015656"
                cx="36.769413"
                id="path4820-36"
                style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:#ffffff;fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1.70000005;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:0.22699387;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" />
            <ellipse
                ry="1.2810724"
                rx="1.2810658"
                cy="18.633852"
                cx="43.646713"
                id="path4820-31"
                style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:#ffffff;fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1.70000005;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:0.22699387;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" />
            <ellipse
                ry="1.2810724"
                rx="1.2810658"
                cy="18.768703"
                cx="28.273924"
                id="path4820-4"
                style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill:#ffffff;fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1.70000005;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:0.22699387;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" />
            </svg>`;
    }
    commentEmoji.insertAdjacentHTML('beforeend', commentEmojiSvg);
}

function onProductPageCommentStar(event){
    let commentStars = document.querySelectorAll('#product-page-comment-stars svg');
    
    startCount = parseInt(event.getAttribute('star'));
    commentStars.forEach((commentStar,index) => {
        if(index < startCount){
            commentStar.classList.remove('fill-gray-5');
            commentStar.classList.add('fill-yellow');
        }
        else{
            
            commentStar.classList.remove('fill-yellow');
            commentStar.classList.add('fill-gray-5');
        }
            
    });
    insertCommentEmojiForProductPage(startCount);
    setStarsHiddenFieldOfProductPage(startCount);
    
}

function incrementCartIconNumber(){
    let navigationCartIconCounter = document.querySelector('#navigation-cartIcon-Counter');
    let CartIconCounter =  parseInt(navigationCartIconCounter.textContent);
    CartIconCounter = CartIconCounter + 1;
    navigationCartIconCounter.textContent = CartIconCounter;
}

function decrementCartIconNumber(){
    let navigationCartIconCounter = document.querySelector('#navigation-cartIcon-Counter');
    let CartIconCounter =  parseInt(navigationCartIconCounter.textContent);
    CartIconCounter = CartIconCounter - 1;
    navigationCartIconCounter.textContent = CartIconCounter;
}

function set_AddToCart_text_in_button(){
    let cartButton = document.querySelector('#productPage-addToCart-text');
    // console.log(cartButton)
    cartButton.textContent = 'Add To Cart';

}

function set_RemoveFromCart_text_in_button(){
    let cartButton = document.querySelector('#productPage-addToCart-text');
    // console.log(cartButton)
    cartButton.textContent = 'Remove From Cart';

}

function addOrRemoveProductToCart(){
    let currentBuyerAuth = window.sessionStorage.getItem('CURRENT_BUYER_AUTH_ID');
    let buyer_id = currentBuyerAuth;
    let ProductDataFromLocalHost = JSON.parse(window.sessionStorage.getItem('productFromProductControllerToProductPage'));
    let product_id = ProductDataFromLocalHost.id;
    
    axios.post(`${website_domain_name}/api/frontstore/cart`,{
        buyer_id : buyer_id,
        product_id : product_id
    })
    .then(function (response) {
        // console.log('successfully add to cart...',response.data);
        if(response.data == 'deletedFromCart'){
            set_AddToCart_text_in_button();
            decrementCartIconNumber();
        }
        else if(response.data == 'addedTocart'){
            set_RemoveFromCart_text_in_button();
            incrementCartIconNumber();

        }
    })
    .catch(function (error) {
        // handle error
        alert('cannot set cart item exception.',error);
        // console.log(error);
    });

//     let navigationCartIconCounter = document.querySelector('#navigation-cartIcon-Counter');
//     let CartIconCounter =  parseInt(navigationCartIconCounter.textContent);
//     CartIconCounter = CartIconCounter + 1;
//     navigationCartIconCounter.textContent = CartIconCounter;
}

(function(){
    let commentOverlay = document.querySelector('#productPage-comment-overlay');
    let commentBody = document.querySelector('#productPage-comment-body');
    
    // this is for close button start
    let commentCloseButton = document.querySelector('#productPage-comment-closeButton');
    commentCloseButton.addEventListener('click',function(){

        commentOverlay.classList.remove('scale-100');
        commentBody.classList.remove('scale-100');
        commentOverlay.classList.add('scale-0');
        commentBody.classList.add('scale-0');
        
    })
    // this is for close button end

    let authenticationWarningOverlay = document.querySelector('#productPage-AuthenticationWarning-overlay');
    let authenticationWarningBody = document.querySelector('#productPage-AuthenticationWarning-body');
    // this is for close button start
    let authenticationWarningCloseButton = document.querySelector('#productPage-AuthenticationWarning-closeButton');
    authenticationWarningCloseButton.addEventListener('click',function(){
        console.log('working authenticationWarningCloseButton close button');

        authenticationWarningOverlay.classList.remove('scale-100');
        authenticationWarningBody.classList.remove('scale-100');
        authenticationWarningOverlay.classList.add('scale-0');
        authenticationWarningBody.classList.add('scale-0');

        // delete and reset current product page id after warning close by buyer
        window.sessionStorage.setItem('redirectProductIdforBuyerAfterLogin','-1');

        
    })
    // this is for close button end


    let postCommentButton = document.querySelector('#productPage-postComment');
    postCommentButton.addEventListener('click',function(){
        
        
        // checking buyer auth and if not auth then warning model otherwise comment model
        let currentBuyerAuth = window.sessionStorage.getItem('CURRENT_BUYER_AUTH_ID');
        
        if (currentBuyerAuth == -1){
            authenticationWarningOverlay.classList.remove('scale-0');
            authenticationWarningBody.classList.remove('scale-0');
            authenticationWarningOverlay.classList.add('scale-100');
            authenticationWarningBody.classList.add('scale-100');
            
            // setting current product page id for redirect after login 
            ProductDataFromLocalHost = JSON.parse(window.sessionStorage.getItem('productFromProductControllerToProductPage'));
            window.sessionStorage.setItem('redirectProductIdforBuyerAfterLogin',ProductDataFromLocalHost.id);
        }
        else{

            commentOverlay.classList.remove('scale-0');
            commentBody.classList.remove('scale-0');
            commentOverlay.classList.add('scale-100');
            commentBody.classList.add('scale-100');
        }
    });


    // product page add to cart actions button
    let addOrRemoveToCartButton = document.querySelector('#productPage-addToCart-Button');
    addOrRemoveToCartButton.addEventListener('click',function(){
        console.log('addToCartButton working...')
    // checking buyer auth and if not auth then warning model otherwise comment model
        let currentBuyerAuth = window.sessionStorage.getItem('CURRENT_BUYER_AUTH_ID');
        if (currentBuyerAuth == -1){
            authenticationWarningOverlay.classList.remove('scale-0');
            authenticationWarningBody.classList.remove('scale-0');
            authenticationWarningOverlay.classList.add('scale-100');
            authenticationWarningBody.classList.add('scale-100');
            
            // setting current product page id for redirect after login 
            ProductDataFromLocalHost = JSON.parse(window.sessionStorage.getItem('productFromProductControllerToProductPage'));
            window.sessionStorage.setItem('redirectProductIdforBuyerAfterLogin',ProductDataFromLocalHost.id);
        }
        else{
            addOrRemoveProductToCart();
        }
    });

    // buy now button button 
    let buyNowButton = document.querySelector('#productPage-BuyNow-button');
    buyNowButton.addEventListener('click',function(){
        
        
        // checking buyer auth and if not auth then warning model otherwise comment model
        let currentBuyerAuth = window.sessionStorage.getItem('CURRENT_BUYER_AUTH_ID');
        
        if (currentBuyerAuth == -1){
            authenticationWarningOverlay.classList.remove('scale-0');
            authenticationWarningBody.classList.remove('scale-0');
            authenticationWarningOverlay.classList.add('scale-100');
            authenticationWarningBody.classList.add('scale-100');
            
            // setting current product page id for redirect after login 
            ProductDataFromLocalHost = JSON.parse(window.sessionStorage.getItem('productFromProductControllerToProductPage'));
            window.sessionStorage.setItem('redirectProductIdforBuyerAfterLogin',ProductDataFromLocalHost.id);
        }
    });

}());


// quantity minus plus for product

(function(){
    // clear already exists value for prodcut quantity
    window.sessionStorage.setItem('BUYER_CURRENT_PRODUCT_QUANTITY',null);

    let currentBuyerAuth = window.sessionStorage.getItem('CURRENT_BUYER_AUTH_ID');
    let buyer_id = currentBuyerAuth;
    let ProductDataFromLocalHost = JSON.parse(window.sessionStorage.getItem('productFromProductControllerToProductPage'));
    let product_id = ProductDataFromLocalHost.id;


    let productHeroPrice = document.querySelector('#product-hero-price');
    let productHeroPriceHidden = document.querySelector('#product-hero-price-hidden');
    
    let minusButton = document.querySelector('#productPage-quantity-minus');
    let plusButton = document.querySelector('#productPage-quantity-plus');
    let quantityBody = document.querySelector('#productPage-quantity-body');

    let quantityForLocalHost = 1;

    minusButton.addEventListener('click',function(){
        let quantity = parseInt(quantityBody.textContent);

        if (quantity > 1){
            quantityBody.textContent = quantity-1;
            quantityForLocalHost = quantity-1;

            productHeroPriceInt = parseInt(productHeroPrice.textContent.replaceAll(',',''));
            productHeroPriceHiddenInt = parseInt(productHeroPriceHidden.textContent);
            
            let totalPrice = productHeroPriceInt-productHeroPriceHiddenInt;
            productHeroPrice.textContent = Intl.NumberFormat('en-PK').format(totalPrice);

            if(buyer_id != -1 && buyer_id > 0){
                let data = `${buyer_id}:${product_id}:${quantityForLocalHost}`;
                window.sessionStorage.setItem('BUYER_CURRENT_PRODUCT_QUANTITY',data);
                // console.log(data);
            }


        }
    });

    plusButton.addEventListener('click',function(){
        let quantity = parseInt(quantityBody.textContent);

        if (quantity < 50){
            quantityBody.textContent = quantity+1;
            quantityForLocalHost = quantity+1;

            productHeroPriceInt = parseInt(productHeroPrice.textContent.replaceAll(',',''));
            productHeroPriceHiddenInt = parseInt(productHeroPriceHidden.textContent);
            
            let totalPrice = productHeroPriceInt+productHeroPriceHiddenInt;
            productHeroPrice.textContent = Intl.NumberFormat('en-PK').format(totalPrice);

            if(buyer_id != -1 && buyer_id > 0){
                let data = `${buyer_id}:${product_id}:${quantityForLocalHost}`;
                window.sessionStorage.setItem('BUYER_CURRENT_PRODUCT_QUANTITY',data);
                // console.log(data);
            }

        }
    });

    if(buyer_id != -1 && buyer_id > 0){
        let data = `${buyer_id}:${product_id}:${quantityForLocalHost}`;
        window.sessionStorage.setItem('BUYER_CURRENT_PRODUCT_QUANTITY',data);
        // console.log(data);
    }
    // console.log('quantityForLocalHost ',quantityForLocalHost);

}());


/**********************************'
 * PRODUCT PAGE splider for image slider and related products slider
 **********************************/
// splider controllers 

var splide = new Splide( '#product-slider', {
    pagination: false,
    arrows: false,
});

var productPagethumbnails = document.getElementsByClassName( 'thumbnail' );
var current;

for ( var i = 0; i < productPagethumbnails.length; i++ ) {
initThumbnail( productPagethumbnails[ i ], i );
}

function initThumbnail( thumbnail, index ) {
thumbnail.addEventListener( 'click', function () {
    splide.go( index );
} );
}

splide.on( 'mounted move', function () {
    var thumbnail = productPagethumbnails[ splide.index ];

    if ( thumbnail ) {
        if ( current ) {
        current.classList.remove( 'is-active' );
        }

        thumbnail.classList.add( 'is-active' );
        current = thumbnail;
    }
} );

splide.mount();



const productPageOptions =  {
    perPage: 4,
    perMove: 1,
    rewind : true,
    pagination: false,
    gap:'1rem',
    breakpoints: {
        1360: {
            perPage: 3,
        },
        1050: {
            perPage: 2,
        },
        767: {
            fixedWidth: '320px',
            perPage: 1,
        },
    }
}
new Splide( '#productPage-related-slider',productPageOptions).mount();
