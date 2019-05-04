/*jslint white:true*/
/*jslint evil:true*/
/*global angular*/


var app = angular.module('myApp', []);

app.controller('myCtrl', function ($scope) {
    "use strict";

    $scope.mainProduct1 = [{
        Pic: 'images/main1.png',
        Type: 'Kairos Series',
        Price: '$149',
        Colour: 23
        }, {
        Pic: 'images/main2.png',
        Type: 'Bellwater Chrono',
        Price: '$199',
        Colour: 14
        },
                         {
        Pic: 'images/main3.png',
        Type: 'Marble Series',
        Price: '$179',
        Colour: 7
        }];
    
    $scope.mainProduct2 = [{
        Pic: 'images/main4.png',
        Type: 'Kairos Series',
        Price: '$149',
        Colour: 23
        },
                         {
        Pic: 'images/main5.png',
        Type: 'Kairos Series',
        Price: '$149',
        Colour: 23
        },
                         {
        Pic: 'images/main6.png',
        Type: 'Kairos Series',
        Price: '$149',
        Colour: 23
        }];
    
    $scope.mainProduct3 = [{
        Pic: 'images/main6.png',
        Type: 'Kairos Series',
        Price: '$149',
        Colour: 23
        },
                         {
        Pic: 'images/main4.png',
        Type: 'Kairos Series',
        Price: '$149',
        Colour: 23
        },
                         {
        Pic: 'images/main3.png',
        Type: 'Kairos Series',
        Price: '$149',
        Colour: 23
        }];


});

app.directive('mainProduct1', function () {
    "use strict";
    var direc = {}, // Create an empty object
        linkFunction = function (scope, element, attributes) {
            scope.pic = attributes.pic;
            scope.type = attributes.type;
            scope.price = attributes.price;
            scope.colour = attributes.colour;// or attributes.ngDemo1;
        };

    direc.restrict = 'EA';
    //E - Element, A - Attribute, C - Class, M - Comment
    direc.link = linkFunction;
    direc.template = '<div class="col-xs-12 col-md-4"><center><a href="#"><img data-ng-src={{pic}} class="img-responsive"></a><br/><h4>{{type}}</h4>{{price}} | {{colur}} Color<br/><br/><button class="btn btn-light">View Collection</button></div></center>'; // text bind to the scope.text in linkFunction
    direc.scope = {}; //Special Setting to avoid instance's scope overring.

    return direc;
});

app.directive('mainProduct2', function () {
    "use strict";
    var direc = {}, // Create an empty object
        linkFunction = function (scope, element, attributes) {
            scope.pic = attributes.pic;
            scope.type = attributes.type;
            scope.price = attributes.price;
            scope.colour = attributes.colour;// or attributes.ngDemo1;
        };

    direc.restrict = 'EA';
    //E - Element, A - Attribute, C - Class, M - Comment
    direc.link = linkFunction;
    direc.template = '<div class="col-xs-12 col-md-4"><center><a href="#"><img data-ng-src={{pic}} class="img-responsive" ></a><br/><h4>{{type}}</h4>{{price}} | {{colur}} Color<br/><br/><button class="btn btn-light">View Collection</button></div></center>'; // text bind to the scope.text in linkFunction
    direc.scope = {}; //Special Setting to avoid instance's scope overring.

    return direc;
});

app.directive('mainProduct3', function () {
    "use strict";
    var direc = {}, // Create an empty object
        linkFunction = function (scope, element, attributes) {
            scope.pic = attributes.pic;
            scope.type = attributes.type;
            scope.price = attributes.price;
            scope.colour = attributes.colour;// or attributes.ngDemo1;
        };

    direc.restrict = 'EA';
    //E - Element, A - Attribute, C - Class, M - Comment
    direc.link = linkFunction;
    direc.template = '<div class="col-xs-12 col-md-4"><center><a href="#"><img data-ng-src={{pic}} class="img-responsive"></a><br/><h4>{{type}}</h4>{{price}} | {{colur}} Color<br/><br/><button class="btn btn-light">View Collection</button></div></center>'; // text bind to the scope.text in linkFunction
    direc.scope = {}; //Special Setting to avoid instance's scope overring.

    return direc;
});
