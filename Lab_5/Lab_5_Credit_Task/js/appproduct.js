/*jslint white:true*/
/*jslint evil:true*/
/*global angular*/


var app = angular.module('myApp', []);

app.directive('phoneProduct', function () {
    "use strict";
    var direc = {}, // Create an empty object
        linkFunction = function (scope, element, attributes) {
            scope.model = attributes.model;
            scope.price = attributes.price; // or attributes.ngDemo1;
        };

    direc.restrict = 'EA';
    //E - Element, A - Attribute, C - Class, M - Comment
    direc.link = linkFunction;
    direc.template = '<div class="col-xs-6 col-md-3 border"><h4>{{model}}</h4><p><b>Price:</b> RM {{price}}</p></div>'; // text bind to the scope.text in linkFunction
    direc.scope = {}; //Special Setting to avoid instance's scope overring.

    return direc;
});
