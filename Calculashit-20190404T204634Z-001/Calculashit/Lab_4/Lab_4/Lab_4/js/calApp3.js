/*jslint white:true*/
/*global angular*/

var app = angular.module("myApp", []);
app.controller("myCtrl",
    function myCtrl ($scope) { "use strict";
                         
        $scope.process = false;
        $scope.result = 0;
        $scope.mem = 0;
                              
        $scope.number = function(num) {
            
            if($scope.process) {
                $scope.result = parseFloat(num);
                $scope.process = false;
            }
            
            else if($scope.result === "0") {
                $scope.result = parseFloat(num);
            }
            
            else {
                $scope.result += parseFloat(num);
            }
        };
        
        $scope.decimal = function() {
            $scope.result += parseFloat(".");
        };
                              
                              
        $scope.calculating = function() {
            
            switch($scope.operator) {
                case "CE":
                    $scope.result = 0;
                    break;
                    
                case "+":
                    $scope.result += parseFloat($scope.number);
                    break;
                
                case "-":
                    $scope.result -= parseFloat($scope.result);
                    break;
            }
            
        };
      
                              
                              
                              
        //$scope.memClear = function() {
            //$scope.mem = "0";
            //$scope.result = "0";
        //};
        
        //$scope.memRecall = function(value) {
            //$scope.result = value;
        //};
                              
        //$scope.memPlus = function(value) {
            //$scope.mem = eval($scope.mem  value);
            //$scope.result = $scope.mem;
        //};
                              
        //$scope.memMinus = function(value) {
            //$scope.mem =  eval($scope.mem - value);
            //$scope.result = $scope.mem;
        //}; 
                              
    }
);