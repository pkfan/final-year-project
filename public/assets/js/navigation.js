/***************
 * 
 * navigation start here 
 * 
 */

// for nav category icons and menu
let navCategoryIcon = document.querySelector('#nav-category-icon');
let navMenu = document.querySelector('#nav-menu');
let categoryArrow = document.querySelector('#category-arrow');

// for avater auth user
let navAvatar = document.querySelector('#nav-avatar');
let navAvatarMenu = document.querySelector('#nav-avatar-menu');

overlay.addEventListener('click',function(){
    // navCategoryIcon classes
    navMenu.classList.remove('nav-menu');
    categoryArrow.classList.remove('-rotate-180');
    overlay.classList.remove('overlay');

    // for nav avater menu
    navAvatarMenu.classList.remove('nav-menu');

});

// for nav category icons and menu
navCategoryIcon.addEventListener('click',function(){
    navMenu.classList.toggle('nav-menu');
    categoryArrow.classList.toggle('-rotate-180');
    overlay.classList.toggle('overlay');
});



// for nav avatar auth user
navAvatar.addEventListener('click',function(){
    navAvatarMenu.classList.toggle('nav-menu');
    overlay.classList.toggle('overlay');
});
