const website_domain_name = window.location.origin;


let overlay = document.querySelector('#overlay');

/***************
 * 
 * loader start here 
 * 
 */

// hide loader
function hideLoader(loaderId){
    let tabLoader = this.document.querySelector(loaderId);
    if(tabLoader){
        tabLoader.classList.add('hidden');
    }
}

// show loader
function showLoader(loaderId){
    let tabLoader = this.document.querySelector(loaderId);
    if(tabLoader){
        tabLoader.classList.remove('hidden');
    }
    
}

/***************************
 * 
 * stars function start here 
 * 
 */

// for tab section cards start
function createStarHTML(fillColor){
    let star =  `<!-- start start -->
                <span>
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.58639 15.443C3.20313 15.641 2.76823 15.294 2.84568 14.851L3.66979 10.121L0.171779 6.765C-0.154888 6.451 0.0148994 5.877 0.452772 5.815L5.31603 5.119L7.48454 0.791996C7.68015 0.401996 8.20937 0.401996 8.40497 0.791996L10.5735 5.119L15.4367 5.815C15.8746 5.877 16.0444 6.451 15.7167 6.765L12.2197 10.121L13.0438 14.851C13.1213 15.294 12.6864 15.641 12.3031 15.443L7.94327 13.187L3.5854 15.443H3.58639Z" class="${fillColor}"/>
                    </svg>
                </span>
                <!-- end start -->`;

    return star;
}

function addProductStars(totalStars, starId){
    let starIdSelector = document.querySelector(starId);
    
    
    for(let i = 1; i<=5; i++){
        if(i <= totalStars){
            let star =  createStarHTML('fill-yellow');
            starIdSelector.insertAdjacentHTML('beforeend', star);
        }
        else{
            let star =  createStarHTML('fill-gray-5');
            starIdSelector.insertAdjacentHTML('beforeend', star);
        
        }
    }


}

