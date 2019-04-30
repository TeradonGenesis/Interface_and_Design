/*jslint white:true*/
/*global angular*/

var app = angular.module("myApp", []);
app.controller("myCtrl",
    function myCtrl ($scope) { "use strict";
                         
        $scope.process = false;
        $scope.result = "0";
                              
        $scope.number = function(num) {
            
            if($scope.process) {
                $scope.result = num.toString();
                $scope.process = false;
            }
            
            else if($scope.result === "0") {
                $scope.result = num;
            }
            
            else {
                $scope.result += num;
            }
        };
        
        $scope.decimal = function() {
            $scope.result += ".";
        };
                              
        $scope.operator = function(operator) {
            if(operator === 'CE') {
                $scope.result = "0";
                $scope.process = true;
            }
            
            else {
                if(!$scope.result [$scope.result.length - 1].match(/[\-+*\/]/)) {
                    $scope.result += operator;
                }
            }
        };
                              
        $scope.calculating = function() {
            $scope.result = eval($scope.result).toString();
        };
        
        
    }
);