
// redirect to product page after register
(function(){
    let redirectProductIdforBuyerAfterLogin = document.querySelector('#redirectProductIdforBuyerAfterLogin');
   let product_id = window.sessionStorage.getItem('redirectProductIdforBuyerAfterLogin');

   redirectProductIdforBuyerAfterLogin.setAttribute('value',product_id);

}());



 ///////////////// STATE AND CITIES AUTOCOMPLETE SUGESSION ///////////////////
/*******************************************/
function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
              b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
      x[i].parentNode.removeChild(x[i]);
    }
  }
}
/*execute a function when someone clicks in the document:*/
document.addEventListener("click", function (e) {
    closeAllLists(e.target);
});
}



const registerPageStates = ['Balochistan','Khyber Pakhtunkhwa','Punjab', 'Sindh'];
const registerPageCities = [
    // =========== Balochistan ==================
    'Quetta',
    'Khuzdar',
    'Turbat',
    'Chaman',
    'Hub'	,
    'Sibi',
    'Zhob',
    'Gwadar',
    'Dera Murad Jamali'	,	
    'Dera Allah Yar'	,	
    'Usta Mohammad',
    'Loralai',
    'Pasni',
    'Kharan',
    'Mastung',
    'Nushki',
    'Kalat',

    // ============ Khyber Pakhtunkhwa =============
    'Abbottabad',
    'Adezai',
    'Alpuri',
    'Akora Khattak',
    'Ayubia',
    'Banda Daud Shah',
    'Bannu',
    'Batkhela',
    'Battagram',
    'Birote',
    'Chakdara',
    'Charsadda',
    'Chitral',
    'Daggar',
    'Dargai',
    'Darya Khan',
    'Dera Ismail Khan',
    'Doaba',
    'Dir',
    'Drosh',
    'Hangu',
    'Haripur',
    'Karak',
    'Kohat',
    'Kulachi',
    'Lakki Marwat',
    'Latamber',
    'Madyan',
    'Mansehra',
    'Mardan',
    'Mastuj',
    'Mingora',
    'Nowshera',
    'Paharpur',
    'Pabbi',
    'Peshawar',
    'Saidu Sharif',
    'Shorkot',
    'Shewa Adda',
    'Swabi',
    'Swat',
    'Tangi',
    'Tank',
    'Thall',
    'Timergara',
    'Tordher',

    // ========== Punjab =========
    'Ahmadpur East',
    'Ahmed Nager Chatha',
    'Ali Khan Abad',
    'Alipur',
    'Arifwala',
    'Attock',
    'Bhera',
    'Bhalwal',
    'Bahawalnagar',
    'Bahawalpur',
    'Bhakkar',
    'Burewala',
    'Chillianwala',
    'Chakwal',
    'Chichawatni',
    'Chiniot',
    'Chishtian',
    'Daska',
    'Darya Khan',
    'Dera Ghazi Khan',
    'Dhaular',
    'Dina',
    'Dinga',
    'Dipalpur',
    'Faisalabad',
    'Fateh Jang',
    'Ghakhar Mandi',
    'Gojra',
    'Gujranwala',
    'Gujrat',
    'Gujar Khan',
    'Hafizabad',
    'Haroonabad',
    'Hasilpur',
    'Haveli Lakha',
    'Jalalpur Jattan',
    'Jampur',
    'Jaranwala',
    'Jhang',
    'Jhelum',
    'Kalabagh',
    'Karor Lal Esan',
    'Kasur',
    'Kamalia',
    'Kamoke',
    'Khanewal',
    'Khanpur',
    'Kharian',
    'Khushab',
    'Kot Adu',
    'Jauharabad',
    'Lahore',
    'Lalamusa',
    'Layyah',
    'Liaquat Pur',
    'Lodhran',
    'Malakwal',
    'Mamoori',
    'Mailsi',
    'Mandi Bahauddin',
    'Mian Channu',
    'Mianwali',
    'Multan',
    'Murree',
    'Muridke',
    'Mianwali Bangla',
    'Muzaffargarh',
    'Narowal',
    'Okara',
    'Renala Khurd',
    'Pakpattan',
    'Pattoki',
    'Pir Mahal',
    'Qaimpur',
    'Qila Didar Singh',
    'Rabwah',
    'Raiwind',
    'Rajanpur',
    'Rahim Yar Khan',
    'Rawalpindi',
    'Sadiqabad',
    'Safdarabad',
    'Sahiwal',
    'Sangla Hill',
    'Sarai Alamgir',
    'Sargodha',
    'Shakargarh',
    'Sheikhupura',
    'Sialkot',
    'Sohawa',
    'Soianwala',
    'Siranwali',
    'Talagang',
    'Taxila',
    'Toba Tek Singh',
    'Vehari',
    'Wah Cantonment',
    'Wazirabad',


    // ============ Sindh =============
    'Badin',
    'Bhirkan',
    'Rajo Khanani',
    'Chak',
    'Dadu',
    'Digri',
    'Diplo',
    'Dokri',
    'Ghotki',
    'Haala',
    'Hyderabad',
    'Islamkot',
    'Jacobabad',
    'Jamshoro',
    'Jungshahi',
    'Kandhkot',
    'Kandiaro',
    'Karachi',
    'Kashmore',
    'Keti Bandar',
    'Khairpur',
    'Kotri',
    'Larkana',
    'Matiari',
    'Mehar',
    'Mirpur Khas',
    'Mithani',
    'Mithi',
    'Mehrabpur',
    'Moro',
    'Nagarparkar',
    'Naudero',
    'Naushahro Feroze',
    'Naushara',
    'Nawabshah',
    'Nazimabad',
    'Qambar',
    'Qasimabad',
    'Ranipur',
    'Ratodero',
    'Rohri',
    'Sakrand',
    'Sanghar',
    'Shahbandar',
    'Shahdadkot',
    'Shahdadpur',
    'Shahpur Chakar',
    'Shikarpaur',
    'Sukkur',
    'Tangwani',
    'Tando Adam Khan',
    'Tando Allahyar',
    'Tando Muhammad Khan',
    'Thatta',
    'Umerkot',
    'Warah'

];


// autocomplete(document.getElementById("shopState"), registerPageStates);
// autocomplete(document.getElementById("shopCity"), registerPageCities);



//////////////////////////// Resgister shop form data /////////////////

let shopDetail = document.querySelector('#registerPage-shop-detail');
const SHOP_DETAIL_FORM_FIELDS =  shopDetail.innerHTML;

shopDetail.innerHTML = '';



// label for input radio fields
let buyerRoleLable = document.querySelector("#buyer-label"); 
let supplierRoleLable = document.querySelector("#supplier-label"); 

// input radio fields
let buyerRoleInput = document.querySelector("#buyer"); 
let supplierRoleInput = document.querySelector("#supplier"); 

console.log(buyerRoleLable);

buyerRoleLable.addEventListener('click',function(event){
    console.log('buyer role lable event working...');
    buyerRoleInput.checked = true;
    supplierRoleInput.checked = false;

    buyerRoleLable.classList.add('checked-yellow');
    supplierRoleLable.classList.remove('checked-yellow');
    
    //////// SHOP FORM FIELS ////////////////
    shopDetail.innerHTML = '';
});


supplierRoleLable.addEventListener('click',function(event){
    console.log('supplier role lable event working...');
    
    supplierRoleInput.checked = true;
    buyerRoleInput.checked = false;

    buyerRoleLable.classList.remove('checked-yellow');
    supplierRoleLable.classList.add('checked-yellow');

    //////// SHOP FORM FIELS ////////////////
    shopDetail.innerHTML = SHOP_DETAIL_FORM_FIELDS;
    autocomplete(document.getElementById("shopState"), registerPageStates);
    autocomplete(document.getElementById("shopCity"), registerPageCities);
});

