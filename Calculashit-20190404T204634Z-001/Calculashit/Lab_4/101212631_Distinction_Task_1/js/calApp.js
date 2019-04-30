/*jslint white:true*/
/*jslint evil:true*/
/*global angular*/


var app = angular.module("myApp", []);
app.controller("myCtrl",
    function myCtrl($scope) {
        "use strict";

        $scope.result = "0";//Displays and store the forumula
        $scope.mem = "0";//Stores the memory of the result
        $scope.displayAns = "0";//Displays the answer to the formula
        $scope.temp = "0";//Temporarily stores the result so that the formula can be first evaluated eg. 17-8+9 is wrong. This allows 17-(8+9)
        
        //appending the numbers 
        $scope.number = function (num) {

            
            if ($scope.result === "0" ) {
                $scope.result = num.toString();
            } else {
                $scope.result += num.toString();
            }
        };
        
        //operator function to append and to ensure no multiple operator is used in succession 
        $scope.operator = function (operator) {
            if (operator === 'CE') {
                $scope.result = "0";
                $scope.displayAns = "0";
            } else if ($scope.result === "0" && operator === '-') {
                
                //to enable user to type in negative sign first eg. -6 instead of it giving out 0-6
                $scope.result = operator;
                
            }else {
                
                //matching using regex and preventing multiple usage of operator in succession
                if (!$scope.result[$scope.result.length - 1].match(/[\-+*\/.]/)) {
                    $scope.result += operator;
                }
            }
            
        };
    
        //allows for deletion of string one word at a time
        $scope.deletion = function () {
            if($scope.result.length === 1)
			{
                //If the deletion occurs until only one number remain, deleting it again will revert it into zero
				$scope.result = $scope.result.substring(0, $scope.result.length - 1);
				$scope.result = "0";
                
			} else {
                //Deleting one word at a time until only one number remain
				$scope.result = $scope.result.substring(0, $scope.result.length - 1);
			}
        };

        $scope.calculating = function () {
            $scope.displayAns = eval($scope.result).toString();
        };


        $scope.memRecall = function () {
            $scope.displayAns = $scope.mem;
            
            if ($scope.result === "0") {
                $scope.result = $scope.mem;
            } else {
                $scope.result += $scope.mem;
            }
        };

        $scope.memClear = function () {
            $scope.mem = "0";
            $scope.result = "0";
            $scope.displayAns = "0";
        };

        $scope.memPlus = function () {
            $scope.temp = $scope.result;//temporarily stores the formula
            $scope.temp = eval($scope.temp);//evaluates the formula first before being stored in memory
            $scope.mem += "+" + $scope.temp;//adding existing memory value to the new addition in the form of string
            $scope.mem = eval($scope.mem).toString();//evaluating the new memory value and storing it
            $scope.displayAns = $scope.mem;//display the new memory value
        };

        $scope.memMinus = function () {
            $scope.temp = $scope.result;//temporarily stores the formula
            $scope.temp = eval($scope.temp);//evaluates the formula first before being stored in memory
            $scope.mem += "-(" + ($scope.temp) +")";//minus existing memory value to the new minus value in the form of string and added bracket in case of negative sign
            $scope.mem = eval($scope.mem).toString();//evaluating the new memory value and storing it
            $scope.displayAns = $scope.mem;//display the new memory value
        };

    }
);
