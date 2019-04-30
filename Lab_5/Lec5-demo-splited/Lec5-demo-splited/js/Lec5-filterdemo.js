var app = angular.module('myApp', []);

//Custom Filter Implementation
app.filter("num2words", function() {
    return function (inputNum) {
        
        var numArray = [1, 4, 5, 9, 10, 40, 50, 90, 100],
            romArray = ["I", "IV", "V", "IX", "X", "XL", "L", "XC", "C"],
            converted = "",
            i;
        
        
        for(i = 0; i<numArray.length; i += 1) {
            
            while (inputNum%numArray[i] < inputNum){
                converted += romArray[i];
                inputNum -= numArray[i];
            }
            
        }
    
    return converted;
    };
});

