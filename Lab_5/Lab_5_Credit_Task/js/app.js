/*jslint white:true*/
/*global angular*/

var app = angular.module("myApp", []);
app.controller("myCtrl",
    function myCtrl ($scope) { "use strict";
        $scope.checking = function () {
            $scope.difference = $scope.original - $scope.guessing;
        };

        $scope.givingUp = function () {
            $scope.original = Math.floor(Math.random() * 100 + 1);
            $scope.answer = true;
        };

        $scope.starting = function () {
            $scope.original = Math.floor(Math.random() * 100 + 1);
            $scope.guess = null;
            $scope.difference = null;
            $scope.answer = false;
        };
        $scope.starting();
    }
);
