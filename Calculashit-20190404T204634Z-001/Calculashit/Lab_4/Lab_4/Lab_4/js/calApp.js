/*jslint white:true*/
/*global angular*/

var app = angular.module("myApp", []);
app.controller("myCtrl",
    function myCtrl($scope) {
        "use strict";

        $scope.process = false;
        $scope.result = "0";
        $scope.mem = "0";
        $scope.displayAns = "0";
        $scope.value = "0";
        $scope.temp = "0";
        
        //appending the numbers 
        $scope.number = function (num) {

            if ($scope.process) {
                $scope.result = num.toString();
                $scope.process = false;
            } else if ($scope.result === "0") {
                $scope.result = num.toString();
            } else {
                $scope.result += num.toString();
            }
        };
        
        //operator function to append and to ensure no multiple operator in use 
        $scope.operator = function (operator) {
            if (operator === 'CE') {
                $scope.result = "0";
                $scope.process = true;
                $scope.displayAns = "0";
            } else {
                if (!$scope.result[$scope.result.length - 1].match(/[\-+*\/.]/)) {
                    $scope.result += operator;
                }
            }
        };

        $scope.calculating = function () {
            $scope.displayAns = eval($scope.result).toString();
        };


        $scope.memRecall = function () {
            $scope.displayAns = $scope.mem;
        };

        $scope.memClear = function () {
            $scope.mem = "0";
            $scope.result = "0";
            $scope.displayAns = "0";
        };

        $scope.memPlus = function () {
            $scope.temp = $scope.result;
            $scope.temp = eval($scope.temp);
            $scope.mem += "+" + $scope.temp;
            $scope.mem = eval($scope.mem).toString();
            $scope.displayAns = $scope.mem;
        };

        $scope.memMinus = function () {
            $scope.temp = $scope.result;
            $scope.temp = eval($scope.temp);
            $scope.mem += "-" + $scope.temp;
            $scope.mem = eval($scope.mem).toString();
            $scope.displayAns = $scope.mem;
        };

    }
);
