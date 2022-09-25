@extends('dashboard.app') 

@section('app')
<style>
    #shopStateautocomplete-list{
        background: var(--white)
    }
    #shopCityautocomplete-list{
        background: var(--white)
    }
    .autocomplete-items {
    position: absolute;
    border: 1px solid var(--gray-2);
    border-bottom: none;
    border-top: none;
    z-index: 99;
    /*position the autocomplete items to be the same width as the container:*/
    top: 100%;
    left: 0;
    right: 0;

    height: 300px;
    overflow-y: scroll;

    box-shadow: 0 0 10px 5px var(--gray-3);
    }
    .autocomplete-items div {
    padding: 10px;
    cursor: pointer;
    background-color: var(--white);
    border-bottom: 1px solid var(--gray-3);
    }
    .autocomplete-items div:hover {
    /*when hovering an item:*/
    background-color: var(--gray-1);
    }
    .autocomplete-active {
    /*when navigating through the items using the arrow keys:*/
    background-color: var( --ternary) !important;
    color: var(--black);
    }
</style>

{{-- edit personal information --}}
<div class="container flex flex-col bg-white shadow-lg">
    <h3 class=" text-white bg-black p-2 text-center">Edit your Shop Information</h3>

    <div class=" w-4/5 mx-auto flex flex-col justify-center items-center">
        

        <form autocomplete="off" action="{{route('supplier.shop.updateInformation')}}" method="post" enctype="multipart/form-data" class="w-full px-4 py-2 ">
            @csrf
            <div class=" my-4">
                <h3 class="flex capitalize border-b-4 border-gray-3 opacity-80">
                    Shop Picture
                </h3>
            </div>

            {{-- shop image --}}
            <div class="flex justify-center items-center space-x-4">
                <img class="rounded-lg" src="{{asset($shop->shop_image)}}" alt="" width="200px" height="200px">
                <input type="file" name="shop_image" id="shop_image">
                @error('shop_image')
                    <div class="red">{{ $message }}</div>
                @enderror
            </div>

            <div class=" my-4">
                <h3 class="flex capitalize border-b-4 border-gray-3 opacity-80">
                    Shop Detail
                </h3>
            </div>

           <!-- Shop name input field start -->
           <div id="shopName-feild" class=" flex flex-col w-full px-4 py-2 pl-0 ">
                <label for="shopName" class=" text-sm">Shop Name:</label>
                <input type="text" name="shopName" value="@if(old('shopName')){{old('shopName')}} @else {{$shop->name}} @endif" id="shopName" required placeholder="e.g. online electronic accessories" class=" @error('shopName') !border-red-500 @enderror placeholder:gray-5 w-full rounded-md p-1 pl-4 border-2 border-gray-5 background-gray-1">
                @error('shopName')
                    <div class="red">{{ $message }}</div>
                @enderror
            </div>
            <!-- end Shop name field -->
            <!-- Shop Address input field start -->
            <div id="shopAddress-feild" class=" flex flex-col w-full px-4 py-2 pl-0 ">
                <label for="shopAddress" class=" text-sm">Shop Address:</label>
                <input type="text" name="shopAddress" value="@if(old('shopAddress')){{old('shopAddress')}} @else {{$shop->address}} @endif" id="shopAddress" required placeholder="e.g. shop No.20, Near Icchra Bus stop" class=" @error('shopAddress') !border-red-500 @enderror placeholder:gray-5 w-full rounded-md p-1 pl-4 border-2 border-gray-5 background-gray-1">
                @error('shopAddress')
                    <div class="red">{{ $message }}</div>
                @enderror
            </div>
            <!-- end Shop Address field -->
            <!-- Shop shopState input field start -->
            <div id="shopState-feild" class="autocomplete relative flex flex-col w-full px-4 py-2 pl-0 ">
                <label for="shopState" class=" text-sm">Shop State:</label>
                <input type="text" name="shopState" value="@if(old('shopState')){{old('shopState')}} @else {{$shop->state}} @endif" id="shopState" required placeholder="e.g. Punjab" class=" @error('shopState') !border-red-500 @enderror placeholder:gray-5 w-full rounded-md p-1 pl-4 border-2 border-gray-5 background-gray-1">
                @error('shopState')
                    <div class="red">{{ $message }}</div>
                @enderror
            </div>
            <!-- end Shop shopState field -->
            <!-- Shop shopCity input field start -->
            <div id="shopCity-feild" class="autocomplete relative flex flex-col w-full px-4 py-2 pl-0 ">
                <label for="shopCity" class=" text-sm">Shop City:</label>
                <input type="text" name="shopCity" value="@if(old('shopCity')){{old('shopCity')}} @else {{$shop->city}} @endif" id="shopCity" required placeholder="e.g. Punjab" class=" @error('shopCity') !border-red-500 @enderror placeholder:gray-5 w-full rounded-md p-1 pl-4 border-2 border-gray-5 background-gray-1">
                @error('shopCity')
                    <div class="red">{{ $message }}</div>
                @enderror
            </div>

                <!-- shipping input field start -->
            <div class=" flex flex-col w-full p-4 pl-0 ">
                <label for="shopDescription" class=" text-sm">Shop Description:</label>
                <textarea name="shopDescription" id="shopDescription" cols="30" rows="10" placeholder="please tell us shopDescription your shop." class=" w-full rounded-md p-1 pl-4 border-2 border-gray-5 background-gray-1">@if(old('shopDescription')){{old('shopDescription')}} @else {{$shop->description}} @endif</textarea>
                @error('shopDescription')
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

<script>
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

autocomplete(document.getElementById("shopState"), registerPageStates);
    autocomplete(document.getElementById("shopCity"), registerPageCities);
</script>

@endsection