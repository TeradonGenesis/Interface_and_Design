/*jslint white:true*/
/*global angular*/

var app = angular.module("myApp", []);
app.controller("myCtrl",
    function myCtrl ($scope) { "use strict";
       
        $scope.inputNum = 0;                      
        $scope.process = false;
        $scope.result = "0";
                              
        $scope.number = function(num) {
            
            if($scope.result === "0") {
                $scope.result = num;
            }
            
            else {
                $scope.result += String(num);
            }
        };
                              
        $scope.operator = function(operator) {
            
            if($scope.result && !$scope.process) {
                $scope.inputNum = $scope.output;
                $scope.result += operator;
                $scope.process = true;
            }
            
            else if ($scope.result.length > $scope.inputNum.length + 1) {
                $scope.result = eval($scope.result);
                $scope.result += operator;
            }
        };
                              
        $scope.calculating = function() {
            if($scope.result.length > $scope.inputNum.length+1) {
                $scope.result = eval($scope.result);
                $scope.inputNum = $scope.result;
            }
            
            else {
                $scope.result = $scope.inputNum;
            }
        };
        
    }
);