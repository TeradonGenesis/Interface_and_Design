/*jslint white:true */
/*global angular */

var app = angular.module("calculatorApp", []);
app.controller("myCalculator", function ($scope) {
    "use strict";

    $scope.memory = "0";
    $scope.temporaryMemory = "0";
    $scope.output = "0";
    $scope.result = "0";
    $scope.initialValue = 0;
    $scope.operatorClicked = false;

    $scope.aOperations = false;

    $scope.updateOutput = function (btn) {
        if ($scope.aOperations) {
            $scope.output = 0;
            $scope.aOperations = false;
        } else if ($scope.output === "0") {
            $scope.output = btn;
        } else {
            $scope.output += btn;
            $scope.operatorClicked = false;

        }
    };

    $scope.aOperators = function (op) {
        if ($scope.output && !$scope.operatorClicked) {
            $scope.output += String(op);
            $scope.operatorClicked = true;
        }
    };

    $scope.calculating = function () {
        $scope.result = eval($scope.output);
    };

    $scope.reset = function () {
        $scope.output = "0";
        $scope.result = "0";
        $scope.operatorClicked = false;
    };

    $scope.mReset = function () {
        $scope.output = "0";
        $scope.result = "0";
        $scope.memory = "0";
    };

    $scope.mRecall = function () {
        $scope.result = $scope.memory;
    };

    $scope.mAdding = function () {
        $scope.memory = $scope.memory + "+" + $scope.output;
        $scope.memory = eval($scope.memory);
        $scope.result = $scope.memory;
    };
    
    /** have to use temporary memory here becuase keeps changing to 1 when i try to subtract the stored memory**/
   
    
    $scope.mSubtracting = function (){
        $scope.temporaryMemory = $scope.output;
        $scope.temporaryMemory = eval($scope.temporaryMemory);
        $scope.memory = $scope.memory + "-" + $scope.temporaryMemory;
        $scope.memory = eval($scope.memory); /** have to use eval again so that it wont show the arithmetic operation when recall is called **/
        $scope.result = $scope.memory;
    };
    
    /*$scope.mAdding = function () {
        $scope.memory = parseFloat($scope.memory, 10) + parseFloat($scope.output, 10);
        $scope.result = $scope.memory;
        
        <!-- Parse doesnt work -->
    
    };
    */
    
     /*$scope.mSubtracting = function () {
        $scope.memory = parseFloat($scope.memory, 10) - parseFloat($scope.output, 10);
        $scope.result = $scope.memory;
        
        <!-- Parse doesnt work -->
    
    };
    */



});
