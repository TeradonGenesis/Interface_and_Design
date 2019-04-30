/*jslint white:true*/
/*jslint evil:true*/
/*global angular*/


var app = angular.module("myApp", []);
app.controller("myCtrl",
    function ($scope) {
        "use strict";
        
        $scope.valMessage = [];
    
        $scope.post = function(message) {
            $scope.valMessage.push(message);
        };
    
        $scope.deletion = function(index) {
            $scope.valMessage.splice(index, 1);
        };
    
    }
);
