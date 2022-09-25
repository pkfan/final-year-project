let colorPalletesContainer = document.querySelector('#color-palletes');
let closeButton = document.querySelector('#color-palletes-close-button');
let showThemeSettings = document.querySelector('#theme-settings');

showThemeSettings.addEventListener('click',function(){
    colorPalletesContainer.classList.remove('-bottom-[520px]')
    colorPalletesContainer.classList.add('bottom-0')
});
closeButton.addEventListener('click',function(){
    colorPalletesContainer.classList.remove('bottom-0')
    colorPalletesContainer.classList.add('-bottom-[520px]')

});



let colorPalletes = [
    {
        id: 1,
        name: "LIGHT THEME",
        active: true,
        colors : {
            primary: "#270082",
            secondary: "#7A0BC0",
            secondary2: "#0085FF",
            ternary: "#FFC600",
            
            red: "#EA0000",
            green: "#11D800",
            yellow: "#FFC600",

            white: "#ffffff",
            black: "#000000",
            /* gray-100 */
            gray1: "rgb(243,244,246)", 
            /* gray-200 */
            gray2: "rgb(229,231,235)",
            /* gray-300 */
            gray3:"rgb(209,213,219)",

            /* gray-500 */
            gray5:"rgb(107,114,128)",
        }
    },
    {
        id: 2,
        name: "DARK THEME",
        colors : {
            /* for black screen colors */
            primary: "#3fc1ff",
            primary: "#66ffe3",
            secondary: "#fe9fff",
            secondary2: "#43ff74",
            ternary: "#dd09c3",
            
            red: "#ff9f9f",
            green: "#11D800",
            yellow: "#FFC600",

            black: "#ffffff",
            white: "#000000",
            /* gray-900 */
             gray1: "rgb(17,24,39)", 
            /* gray-800 */
            gray2: "rgb(31,41,55)",
            /* gray-600 */
            gray3: "rgb(75,85,99)",
            /* gray-300 */
            gray5:"rgb(209,213,219)"
        }
    },
    {
        id: 3,
        name: "GOLDEN THEME",
        colors : {
            /* for black screen colors */
            // primary: "#46244C",
            primary: "#712B75",
            secondary: "#dd09c3",
            secondary2: "#874356",
            ternary: "#00f1f3",
            
            red: "#C74B50",
            green: "#11D800",
            yellow: "#FFC600",

            white: "#fff1c1",
            black: "#000000",
            /* gray-100 */
            gray1: "#fff7dd", 
            /* gray-200 */
            gray2: "#fff3cc",
            /* gray-300 */
            gray3:"rgb(209,213,219)",

            /* gray-500 */
            gray5:"rgb(107,114,128)",
        }
    },
    {
        id: 4,
        name: "BLUE THEME",
        colors : {
            /* for black screen colors */
            primary: "#d96900",
            secondary: "#853e78",
            secondary2: "#FC4F4F",
            ternary: "#FFBC80",
	    ternary: "#ffd43e",
            
            red: "#EA0000",
            green: "#11D800",
            yellow: "#FFC600",

            white: "#c6efff",
            black: "#000000",
            /* gray-100 */
            gray1: "#e9f9ff", 
            /* gray-200 */
            gray2: "#daf5ff",
            /* gray-300 */
            gray3:"rgb(209,213,219)",

            /* gray-500 */
            gray5:"rgb(107,114,128)",
        }
    },

    // dublicates again
    {
        id: 5,
        name: "LIGHT THEME",
        active: true,
        colors : {
            primary: "#270082",
            secondary: "#7A0BC0",
            secondary2: "#0085FF",
            ternary: "#FFC600",
            
            red: "#EA0000",
            green: "#11D800",
            yellow: "#FFC600",

            white: "#ffffff",
            black: "#000000",
            /* gray-100 */
            gray1: "rgb(243,244,246)", 
            /* gray-200 */
            gray2: "rgb(229,231,235)",
            /* gray-300 */
            gray3:"rgb(209,213,219)",

            /* gray-500 */
            gray5:"rgb(107,114,128)",
        }
    },
    {
        id: 6,
        name: "DARK THEME",
        colors : {
            /* for black screen colors */
            primary: "#3fc1ff",
            primary: "#66ffe3",
            secondary: "#fe9fff",
            secondary2: "#43ff74",
            ternary: "#dd09c3",
            
            red: "#ff9f9f",
            green: "#11D800",
            yellow: "#FFC600",

            black: "#ffffff",
            white: "#000000",
            /* gray-900 */
             gray1: "rgb(17,24,39)", 
            /* gray-800 */
            gray2: "rgb(31,41,55)",
            /* gray-600 */
            gray3: "rgb(75,85,99)",
            /* gray-300 */
            gray5:"rgb(209,213,219)"
        }
    },
    {
        id: 7,
        name: "GOLDEN THEME",
        colors : {
            /* for black screen colors */
            // primary: "#46244C",
            primary: "#712B75",
            secondary: "#dd09c3",
            secondary2: "#874356",
            ternary: "#00f1f3",
            
            red: "#C74B50",
            green: "#11D800",
            yellow: "#FFC600",

            white: "#fff1c1",
            black: "#000000",
            /* gray-100 */
            gray1: "#fff7dd", 
            /* gray-200 */
            gray2: "#fff3cc",
            /* gray-300 */
            gray3:"rgb(209,213,219)",

            /* gray-500 */
            gray5:"rgb(107,114,128)",
        }
    },
    {
        id: 8,
        name: "BLUE THEME",
        colors : {
            /* for black screen colors */
            primary: "#d96900",
            secondary: "#853e78",
            secondary2: "#FC4F4F",
            ternary: "#FFBC80",
	    ternary: "#ffd43e",
            
            red: "#853e78",
            green: "#11D800",
            yellow: "#FFC600",

            white: "#c6efff",
            black: "#000000",
            /* gray-100 */
            gray1: "#e9f9ff", 
            /* gray-200 */
            gray2: "#daf5ff",
            /* gray-300 */
            gray3:"rgb(209,213,219)",

            /* gray-500 */
            gray5:"rgb(107,114,128)",
        }
    },
];


// settings color to root variable
function setColorsWithRootVariables(colorPalleteObject){
    let root = document.querySelector(':root');
    root.style.setProperty('--primary',colorPalleteObject.colors.primary);
    root.style.setProperty('--secondary',colorPalleteObject.colors.secondary);
    root.style.setProperty('--secondary-2',colorPalleteObject.colors.secondary2);
    root.style.setProperty('--ternary',colorPalleteObject.colors.ternary);
    
    root.style.setProperty('--red',colorPalleteObject.colors.red);
    root.style.setProperty('--green',colorPalleteObject.colors.green);
    root.style.setProperty('--yellow',colorPalleteObject.colors.yellow);
    
    root.style.setProperty('--white',colorPalleteObject.colors.white);
    root.style.setProperty('--black',colorPalleteObject.colors.black);
    
    root.style.setProperty('--gray-1',colorPalleteObject.colors.gray1);
    root.style.setProperty('--gray-2',colorPalleteObject.colors.gray2);
    root.style.setProperty('--gray-3',colorPalleteObject.colors.gray3);
    root.style.setProperty('--gray-5',colorPalleteObject.colors.gray5);
}


// setting default colorPallete by using window.localStorage
(function localStorageDefaultColorPalleteSettings(){
    const colorPallete = JSON.parse(window.localStorage.getItem('colorPallete'));
    console.log('colorPalette getItem method before initializing]...',colorPallete );
    
    if(colorPallete){
        setColorsWithRootVariables(colorPallete);
        
        colorPalletes.forEach(function(cp,index){
            if(cp.id === colorPallete.id){
                colorPalletes[index].active = true;
            }
            else{
                colorPalletes[index].active = false;
            }
        });
        
    }
    else{
        const colorPalleteDefault = colorPalletes[1];
        console.log('1 color palatte object',colorPalleteDefault);
    
        window.localStorage.setItem('colorPallete', JSON.stringify(colorPalleteDefault));
        
        setColorsWithRootVariables(colorPalleteDefault);
    }
})();




function getColorPalleteWithTickMark(colorPalleteObject){
   let tickMark = `<div class="cursor-pointer flex items-center space-x-4 p-4 background-white border-4 border-green-500 rounded-full overflow-hidden" style="background-color: ${colorPalleteObject.colors.white};">
                        <div>
                            <?xml version="1.0" encoding="UTF-8"?>
                            <svg class=" fill-green-600" width="40" height="40" enable-background="new 0 0 490 490" version="1.1" viewBox="0 0 490 490" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                <polygon points="452.25 28.326 197.83 394.67 29.044 256.88 0 292.47 207.25 461.67 490 54.528"/>
                            </svg>
                        </div>
                        <div  class=" flex">
                            <!-- primary -->
                            <div class="w-12 h-12 border-4 border-[#fff] rounded-[100%] " style="background-color: ${colorPalleteObject.colors.primary};"></div>
                            <!-- secondary -->
                            <div class="w-12 h-12 border-4 border-[#fff] rounded-[100%] -translate-x-4" style="background-color:  ${colorPalleteObject.colors.secondary};"></div>
                            <!-- secondary 2 -->
                            <div class="w-12 h-12 border-4 border-[#fff] rounded-[100%] -translate-x-8" style="background-color:  ${colorPalleteObject.colors.secondary2};"></div>
                            <!-- ternary -->
                            <div class="w-12 h-12 border-4 border-[#fff] rounded-[100%] -translate-x-12" style="background-color:  ${colorPalleteObject.colors.ternary};"></div>
                        </div>
                        <h3 class="-translate-x-12" style="color: ${colorPalleteObject.colors.black};">
                            ${colorPalleteObject.name}
                        </h3>
                    </div>`;
    return tickMark;
}

function getColorPalleteWithPlusMark(colorPalleteObject){
    let plusMark = `<div class="cursor-pointer flex items-center space-x-4 p-4 border-4 border-red-500 rounded-full overflow-hidden" style="background-color: ${colorPalleteObject.colors.white};">
                        <div>
                            <?xml version="1.0" encoding="UTF-8"?>
                            <svg class=" fill-red-500" width="40" height="40" enable-background="new 0 0 490 490" version="1.1" viewBox="0 0 490 490" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                <polygon points="222.03 490 267.97 490 267.97 267.97 490 267.97 490 222.03 267.97 222.03 267.97 0 222.03 0 222.03 222.03 0 222.03 0 267.97 222.03 267.97"/>
                            </svg>

                        </div>
                        <div  class=" flex">
                            <!-- primary -->
                            <div class="w-12 h-12 border-4 border-[#fff] rounded-[100%] " style="background-color: ${colorPalleteObject.colors.primary};"></div>
                            <!-- secondary -->
                            <div class="w-12 h-12 border-4 border-[#fff] rounded-[100%] -translate-x-4" style="background-color:  ${colorPalleteObject.colors.secondary};"></div>
                            <!-- secondary 2 -->
                            <div class="w-12 h-12 border-4 border-[#fff] rounded-[100%] -translate-x-8" style="background-color:  ${colorPalleteObject.colors.secondary2};"></div>
                            <!-- ternary -->
                            <div class="w-12 h-12 border-4 border-[#fff] rounded-[100%] -translate-x-12" style="background-color:  ${colorPalleteObject.colors.ternary};"></div>
                        </div>
                        <h3 class="-translate-x-12" style="color: ${colorPalleteObject.colors.black};">
                            ${colorPalleteObject.name}
                        </h3>
                    </div>`;
     return plusMark;
 }


 function createColorPalleteWithTickMarkList(colorPalleteObject){
    let tickMark = `<li id="${colorPalleteObject.id}-color-pallete" onclick="onSetColor(this)">
                        ${getColorPalleteWithTickMark(colorPalleteObject)}
                    </li>`;
    // console.log(tickMark);
     return tickMark;
 }
 function createColorPalleteWithPlusMarkList(colorPalleteObject){
    let tickMark = `<li id="${colorPalleteObject.id}-color-pallete" onclick="onSetColor(this)">
                        ${getColorPalleteWithPlusMark(colorPalleteObject)}
                    </li>`;
     return tickMark;
 }



function insertColorPalleteWithTickMarkList(colorPalleteObject){
    let allColorPalletes = document.querySelector('#color-palletes ul');
    
    let pallete = createColorPalleteWithTickMarkList(colorPalleteObject);
    allColorPalletes.insertAdjacentHTML('beforeend', pallete);
}

function insertColorPalleteWithPlusMarkList(colorPalleteObject){
    let allColorPalletes = document.querySelector('#color-palletes ul');
    
    let pallete = createColorPalleteWithPlusMarkList(colorPalleteObject);
    allColorPalletes.insertAdjacentHTML('beforeend', pallete);
}


window.addEventListener('load',function(){
    // insertColorPalleteWithTickMarkList('black Theme');
    // insertColorPalleteWithPlusMarkList('dark Theme');
    // insertColorPalleteWithPlusMarkList('white Theme');
    // insertColorPalleteWithPlusMarkList('light Theme');
    
    colorPalletes.forEach(function(colorPallete){
        if(colorPallete.active){
            insertColorPalleteWithTickMarkList(colorPallete);
        }else{
            insertColorPalleteWithPlusMarkList(colorPallete);

        }
    });
});

function onSetColor(event){
    let allColorPalletes = document.querySelectorAll('#color-palletes ul li');
 
    allColorPalletes.forEach(colPal => {
         let colorPalleteId = colPal.getAttribute('id');
         colorPalleteId = parseInt(colorPalleteId);

        //  console.log(colorPalleteId);

        colorPalletes.forEach(function(colorPallete){
            if(colorPallete.id == colorPalleteId){
                // console.log('executed ids...')
                // insertColorPalleteWithTickMarkList(colorPallete);
                colPal.innerHTML = '';
                colPal.innerHTML = getColorPalleteWithPlusMark(colorPallete);
            }
        });

    });
   
    // setting and tick selected pallete
    let colorPalleteId = event.getAttribute('id');
    colorPalleteId = parseInt(colorPalleteId);

    console.log(colorPalleteId);

    colorPalletes.forEach(function(colorPallete){
        if(colorPallete.id == colorPalleteId){
            console.log('executed ids...')
            // insertColorPalleteWithTickMarkList(colorPallete);
            event.innerHTML = '';
            event.innerHTML = getColorPalleteWithTickMark(colorPallete);
            setColorsWithRootVariables(colorPallete);
            window.localStorage.setItem('colorPallete', JSON.stringify(colorPallete));

        }
    });
}
