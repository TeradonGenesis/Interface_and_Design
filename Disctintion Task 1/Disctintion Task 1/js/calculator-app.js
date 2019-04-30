/*jslint white:true */
/*global angular */

var app = angular.module("calculatorApp", []);
app.controller("myCalculator", function ($scope) {
    "use strict";

    $scope.memory = "0";
    $scope.output = "0";
    $scope.result = "0";
    $scope.initialValue = 0;
    $scope.operatorClicked = false;

    $scope.aOperations = false;

    $scope.updateOutput = function (btn) {
        if ($scope.aOperations) {
            $scope.output = 0;
            $scope.aOperations = false;
        } else if ($scope.output == "0") {
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
        $scope.result = $scope.memory
    };

    $scope.mAdding = function () {
        $scope.memory +=(parseInt($scope.output));
        $scope.result = $scope.memory;
    };
    
     $scope.mSubtracting = function () {
        $scope.memory = parseInt($scope.memory) - parseInt($scope.output);
        $scope.result = $scope.memory;
    };



});
