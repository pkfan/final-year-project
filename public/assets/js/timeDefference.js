// function timeDifference(current, previous) {
    
//     var msPerMinute = 60 * 1000;
//     var msPerHour = msPerMinute * 60;
//     var msPerDay = msPerHour * 24;
//     var msPerMonth = msPerDay * 30;
//     var msPerYear = msPerDay * 365;
    
//     var elapsed = current - previous;
    
//     if (elapsed < msPerMinute) {
//          return Math.round(elapsed/1000) + ' seconds ago';   
//     }
    
//     else if (elapsed < msPerHour) {
//          return Math.round(elapsed/msPerMinute) + ' minutes ago';   
//     }
    
//     else if (elapsed < msPerDay ) {
//          return Math.round(elapsed/msPerHour ) + ' hours ago';   
//     }

//     else if (elapsed < msPerMonth) {
//          return 'approximately ' + Math.round(elapsed/msPerDay) + ' days ago';   
//     }
    
//     else if (elapsed < msPerYear) {
//          return 'approximately ' + Math.round(elapsed/msPerMonth) + ' months ago';   
//     }
    
//     else {
//          return 'approximately ' + Math.round(elapsed/msPerYear ) + ' years ago';   
//     }
// }

// // TESTS
// var current= new Date();

// // 2022-03-31 22:18:0

// alert(timeDifference(current, new Date('2022-03-31 22:18:03')));
// alert(timeDifference(current, new Date(2022, 04, 16, 02, 50, 02, 00)));
// alert(timeDifference(current, new Date(2011, 04, 24, 11, 00, 00, 00)));
// alert(timeDifference(current, new Date(2011, 04, 23, 12, 00, 00, 00)));
// alert(timeDifference(current, new Date(2011, 03, 24, 12, 00, 00, 00)));
// alert(timeDifference(current, new Date(2010, 03, 24, 12, 00, 00, 00)));


// changing from me (amir) in this time difference relative time fucntion

function timeDifference(current, previous) {
    
    let msPerMinute = 60 * 1000;
    let msPerHour = msPerMinute * 60;
    let msPerDay = msPerHour * 24;
    let msPerMonth = msPerDay * 30;
    let msPerYear = msPerMonth * 365;
    
    let elapsed = current - previous;
    console.log('[elapsed...]',elapsed);
    console.log('[elapsed now...]',current);
    console.log('[elapsed...previous]',previous);
    
    
    if (elapsed < msPerMinute) {
         return Math.round(elapsed/1000) + ' seconds ago';   
    }
    
    else if (elapsed < msPerHour) {
         return Math.round(elapsed/msPerMinute) + ' minutes ago';   
    }
    
    else if (elapsed < msPerDay ) {
         return Math.round(elapsed/msPerHour ) + ' hours ago';   
    }

    else if (elapsed < msPerMonth) {
         return Math.round(elapsed/msPerDay) + ' days ago';   
    }
    
    else if (elapsed < msPerYear) {
         return Math.round(elapsed/msPerMonth) + ' months ago';   
    }
    
    else {
         return Math.round(elapsed/msPerYear ) + ' years ago';   
    }
}


