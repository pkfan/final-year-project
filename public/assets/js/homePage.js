
/**********************************'
 * HOME CATEGORY TABS START
 **********************************/

function createTabCards(product,number){
    let tabCards = document.querySelector('#tab-section-cards');
    
    let card =  `<!-- start product card -->
                <div class="my-4 w-[300px] flex flex-col border border-gray-2 rounded-xl hover:shadow-lg hover:shadow-gray-3 hover:-translate-y-4 transition-all duration-500 overflow-hidden">
                    <header class="w-10/12 h-1/2 min-h-[220px] mx-auto p-4 flex justify-center items-center">
                        <img class="flex max-h-[220px] rounded-md" src="${website_domain_name}/${product.image_1}" alt="product.image_1">
                    </header>
                    <footer class="h-full background-gray-1 p-4 flex flex-col justify-between space-y-2">
                        <!-- all rating stars -->
                        <div class="flex items-center">
                            <div id="tab-stars-${number}" class="flex items-center">
                                <!-- start start -->
                                    <!-- adding each star with javascript -->
                                <!-- end start -->
                            
                                <!-- count rating -->
                            </div>
                            <span class=" secondary-2  px-2">${product.ratings} Ratings</span>
                        </div>
                        <!-- all rating stars end -->
                        <h4>
                            ${product.title.substring(0,80)}
                        </h4>
                        <p class=" text-xs">
                            ${product.description.substring(0,120)}
                        </p>
                        <h3 class="self-end red px-4 bg-gradient-to-tl from-[var(--ternary)]">
                           Rs. ${Intl.NumberFormat('en-PK').format(product.price)}
                        </h3>
                        <!-- start button component with eye -->
                        <a href="${website_domain_name}/product/${product.id}" class="btn max-w-max self-center flex items-center px-4 py-1 !mt-6 !mb-3 space-x-2 rounded-full background-secondary shadow-md shadow-gray-3">
                            <span class=" text-md font-bold white uppercase">VIEW DETAIL</span>
                            <span>
                                <svg width="30" height="26" viewBox="0 0 30 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15 16.25C17.0711 16.25 18.75 14.7949 18.75 13C18.75 11.2051 17.0711 9.75 15 9.75C12.9289 9.75 11.25 11.2051 11.25 13C11.25 14.7949 12.9289 16.25 15 16.25Z" class=" fill-white"/>
                                    <path d="M29.0066 12.7237C27.904 10.2518 25.9897 8.11413 23.5004 6.57482C21.0111 5.03551 18.0559 4.16209 15 4.0625C11.9441 4.16209 8.98894 5.03551 6.49964 6.57482C4.01033 8.11413 2.09603 10.2518 0.993353 12.7237C0.918882 12.9023 0.918882 13.0977 0.993353 13.2763C2.09603 15.7482 4.01033 17.8859 6.49964 19.4252C8.98894 20.9645 11.9441 21.8379 15 21.9375C18.0559 21.8379 21.0111 20.9645 23.5004 19.4252C25.9897 17.8859 27.904 15.7482 29.0066 13.2763C29.0811 13.0977 29.0811 12.9023 29.0066 12.7237V12.7237ZM15 18.2812C13.7947 18.2812 12.6165 17.9715 11.6144 17.3912C10.6123 16.8109 9.83118 15.9861 9.36995 15.021C8.90872 14.056 8.78804 12.9941 9.02317 11.9697C9.25831 10.9452 9.8387 10.0042 10.6909 9.26559C11.5432 8.527 12.629 8.02401 13.8111 7.82023C14.9932 7.61645 16.2185 7.72104 17.332 8.12076C18.4456 8.52049 19.3973 9.1974 20.0669 10.0659C20.7365 10.9344 21.0939 11.9555 21.0939 13C21.0914 14.4 20.4486 15.7421 19.3063 16.732C18.164 17.722 16.6154 18.2791 15 18.2812V18.2812Z" class=" fill-white"/>
                                </svg>
                            </span>
                        </a>
                        <!-- end button component with eye -->

                    </footer>
                </div>
                <!-- end product card -->`

    // console.log(tabCards);
    
    tabCards.insertAdjacentHTML('beforeend', card);
    addProductStars(Math.round(product.stars),`#tab-stars-${number}`);

}

function insertTabDataAfterFetched(status, productsArray){
    if(status == 200){
        // clear tab categories cards before next insert
        document.querySelector('#tab-section-cards').innerHTML = '';

        // console.log('executed after status 200 true...');
        productsArray.forEach(function(product,index){
            createTabCards(product,index+1);
        });
    }
    else{
        alert(`status code : ${status},(cannot get data)`);
    }
}

function fetchTabCategoryData(tabCategoryId=1){
    // axios.get('https://jsonplaceholder.typicode.com/users')
    axios.get(`${website_domain_name}/api/home/tab/category/${tabCategoryId}`)
        .then(function (response) {
            // handle success

            showLoader('#tab-loader');
            // console.log(response.status);
            // console.log(response.data);
            insertTabDataAfterFetched(response.status,response.data)
            hideLoader('#tab-loader');
            
        })
        .catch(function (error) {
            // handle error
            alert('axios feched errors.')
            // console.log(error);
        });
}

// tab click to fetch category data with APIs
function onClickCategoryTab(event){
    let tabAllCategory = document.querySelectorAll('#tablet-section ul li button')
    console.log('tab all category data....',tabAllCategory);

    tabAllCategory.forEach(function(tab){
        tab.classList.remove('active');
    });
    event.classList.add('active');
    // console.log(event.getAttribute('id'));

    tabCategoryId = parseInt(event.getAttribute('id'));
    // console.log('tab category id...', tabCategoryId);

    showLoader('#tab-loader');
    fetchTabCategoryData(tabCategoryId);
}

/*///////////// this code has been placed to (homePage.bladephp)*/
// // insert cards after window fully loaded
// window.addEventListener('load',function(){
//     let tabCategory = document.querySelector('#tablet-section ul li button');
//     // console.log('tab category...',tabCategory.getAttribute('id'));
//     tabCategory.classList.add('active');

//     tabCategoryId = parseInt(tabCategory.getAttribute('id'));
//     // console.log('tab category id...', tabCategoryId);

//     fetchTabCategoryData(tabCategoryId);
//     // for(let i = 1; i <= 9; i++){
//     //     createTabCards(i);
//     // }
//     hideLoader('#tab-loader');
//     // showLoader('#tab-loader');
// });
// // for tab section cards end


/**********************************'
 * RECOMMENDED PRODCUTS START
 **********************************/

// for recommed section products cards start
    function createRecommendedSectionCards(product,number){
        let recommendedSectionCards = document.querySelector('#recommended-section-cards');
        
        let card =  ` <div class="vertical-shake my-4 w-[500px] flex background-white border border-gray-2 rounded-xl shadow-md shadow-gray-3 overflow-hidden">
                        <header class="w-2/3 mx-auto p-4 flex justify-center items-center">
                            <img class=" rounded-md" src="${website_domain_name}/${product.image_1}" alt="" width="300">
                        </header>
                        <footer class="w-full h-full p-4 flex flex-col justify-between space-y-2">
                            <h4>
                                ${product.title.substring(0,72)}
                            </h4>
                            <p class=" text-xs">
                                ${product.description.substring(0,120)}
                            </p>
                            <div class="flex flex-row justify-between items-center">
                                <!-- all rating stars -->
                                <div class="flex items-center">
                                    <div id="recommended-section-stars-${number}" class="flex items-center">
                                        <!-- start start -->
                                            <!-- adding each star with javascript -->
                                        <!-- end start -->
                                    
                                        <!-- count rating -->
                                    </div>
                                    <div class="pl-1">${parseFloat(product.stars).toFixed(1)}</div>
                                </div>
                                <!-- all rating stars end -->

                                <h3 class="self-end red px-4 bg-gradient-to-tl from-[var(--ternary)]">
                                    Rs. ${Intl.NumberFormat('en-PK').format(product.price)}
                                </h3>
                            </div>
                            <!-- start button component with eye -->
                            <a href="${website_domain_name}/product/${product.id}" class="btn max-w-max self-center flex items-center px-4 py-1 !mt-3 space-x-2 rounded-full background-secondary shadow-md shadow-gray-3">
                                <span class=" text-md font-bold white uppercase">VIEW DETAIL</span>
                                <span>
                                    <svg width="30" height="26" viewBox="0 0 30 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15 16.25C17.0711 16.25 18.75 14.7949 18.75 13C18.75 11.2051 17.0711 9.75 15 9.75C12.9289 9.75 11.25 11.2051 11.25 13C11.25 14.7949 12.9289 16.25 15 16.25Z" class=" fill-white"/>
                                        <path d="M29.0066 12.7237C27.904 10.2518 25.9897 8.11413 23.5004 6.57482C21.0111 5.03551 18.0559 4.16209 15 4.0625C11.9441 4.16209 8.98894 5.03551 6.49964 6.57482C4.01033 8.11413 2.09603 10.2518 0.993353 12.7237C0.918882 12.9023 0.918882 13.0977 0.993353 13.2763C2.09603 15.7482 4.01033 17.8859 6.49964 19.4252C8.98894 20.9645 11.9441 21.8379 15 21.9375C18.0559 21.8379 21.0111 20.9645 23.5004 19.4252C25.9897 17.8859 27.904 15.7482 29.0066 13.2763C29.0811 13.0977 29.0811 12.9023 29.0066 12.7237V12.7237ZM15 18.2812C13.7947 18.2812 12.6165 17.9715 11.6144 17.3912C10.6123 16.8109 9.83118 15.9861 9.36995 15.021C8.90872 14.056 8.78804 12.9941 9.02317 11.9697C9.25831 10.9452 9.8387 10.0042 10.6909 9.26559C11.5432 8.527 12.629 8.02401 13.8111 7.82023C14.9932 7.61645 16.2185 7.72104 17.332 8.12076C18.4456 8.52049 19.3973 9.1974 20.0669 10.0659C20.7365 10.9344 21.0939 11.9555 21.0939 13C21.0914 14.4 20.4486 15.7421 19.3063 16.732C18.164 17.722 16.6154 18.2791 15 18.2812V18.2812Z" class=" fill-white"/>
                                    </svg>
                                </span>
                            </a>
                            <!-- end button component with eye -->

                        </footer>
                    </div>`;

        // console.log(tabCards);
        
        recommendedSectionCards.insertAdjacentHTML('beforeend', card);
        addProductStars(Math.round(product.stars),`#recommended-section-stars-${number}`);

    }
    function insertRecommendedSectionDataAfterFetched(status, productsArray, startFrom){
        if(status == 200){
            // console.log('executed after status 200 true...');
            productsArray.forEach(function(product,index){
                createRecommendedSectionCards(product,index+startFrom);
            });
        }
        else{
            alert(`status code : ${status},(cannot get data)`);
        }
    }

    function hasRecommendedDataWithPagination(status, responseData){
        let loadMoreButton = document.querySelector('#recommended-section #recommended-load-more-button');
        let loadMoreButtonText = document.querySelector('#recommended-section #recommended-load-more-button span');
        loadMoreButton.setAttribute('nextRecommendPage',responseData.current_page+1);
        // console.log(loadMoreButton);
        // console.log(loadMoreButtonText);
        if(!responseData.next_page_url){
            loadMoreButtonText.innerHTML = "Results Ended";
        }

        // console.log('current page',responseData.current_page);
        // console.log('responseData.from',responseData.from);
        let startFrom = parseInt(responseData.from);
        insertRecommendedSectionDataAfterFetched(status,responseData.data,startFrom);

    }
    // fetch recommed section data with APIs
    function fetchRecommendedSectionData(pageNumber=1){
        // axios.get('https://jsonplaceholder.typicode.com/users')
        axios.get(`${website_domain_name}/api/home/recommended?page=${pageNumber}`)
            .then(function (response) {
                // handle success

                // showLoader('#recommended-section-loader');
                // console.log('[recommended]',response.status);
                // console.log('[recommended]', response.data);
                hasRecommendedDataWithPagination(response.status, response.data);
                                // hideLoader('#recommended-section-loader');
            })
            .catch(function (error) {
                // handle error
                alert('recommended axios feched errors.')
                // console.log(error);
            });
    }

    function onClickLoadMoreRecommeded(event){
        // console.log(event.getAttribute('nextrecommendpage'));
        nextPageNumber = parseInt(event.getAttribute('nextrecommendpage'));
        fetchRecommendedSectionData(nextPageNumber);
    }

/*///////////// this code has been placed to (homePage.bladephp)*/

    // // insert cards after window fully loaded
    // window.addEventListener('load',function(){
    //     fetchRecommendedSectionData(1);
    //     hideLoader('#recommended-loader');
    // })
    // for(let i = 1; i <= 8; i++){
    //     createRecommendedSectionCards(i);
    // }

// for recommed section products cards end

