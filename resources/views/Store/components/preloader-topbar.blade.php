<section id="topbar-preloader">
    <style>
        #preloader-background{
            width: 100%;
            height: 4px;
            z-index: 1000; 
            position: fixed; 
            top: 0;
            background-color: var(--gray-1);
        }
        #preloader{
            /* change color of preloader bar according to your needs */
            /* background-image:linear-gradient(to right,#9CECFB,#65C7F7,#0052D4); */
            background-image:linear-gradient(to right,var(--secondary),var(--ternary),var(--primary));
            height: 4px;
            z-index: 1000; 
            position: fixed; 
            top: 0;        
        }
    </style>
    <div id="preloader-background">
        <div id="preloader">
        </div>
    </div>
    <!-- preload script -->
    <script>
        let preloaderBarBackground = document.querySelector('#preloader-background');
        let preloaderBar = document.querySelector('#preloader');
        let idForIntervalCleaning = setInterval(incrementWidth, 20); //  20*100=2000 mili second or 2 second
        let width = 0;

        // increment function
        function incrementWidth(){
            if (width >= 90) {
                clearInterval(idForIntervalCleaning);
                preloaderBarBackground.style.display = "none";
                preloaderBar.style.display = "none";
            } 
    else {
                width++; 
                preloaderBar.style.width = width+"%";
            }
        }

        // window.addEventListener('load', () => {
        //         preloaderBarBackground.style.display = "none";
        //         preloaderBar.style.display = "none";
        //         clearInterval(idForIntervalCleaning);
        // });
    </script>
</section>