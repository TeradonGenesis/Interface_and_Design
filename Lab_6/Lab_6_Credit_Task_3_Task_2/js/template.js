/*jslint white:true*/
/*jslint evil:true*/
/*global angular*/


var app = angular.module('myApp', []);

app.controller('myCtrl', function ($scope) {
    "use strict";

    $scope.logo = [{
        pic: 'images/logo1.png'
    }, {
        pic: 'images/logo2.png'
    }, {
        pic: 'images/logo3.png'
    }, {
        pic: 'images/logo4.png'
    }, {
        pic: 'images/logo5.png'
    }, {
        pic: 'images/logo6.png'
    }];
    
    $scope.extra = [{pic: 'images/extra1.png', description: 'Free Worldwide Shipping'
    }, {
        pic: 'images/extra2.png', description: '30 Days Return'
    }, {
        pic: 'images/extra3.png', description: '24 Months Warranty'
    }, {
        pic: 'images/extra4.png', description: '100% Safe & Secure Checkout'
    }];
    
    $scope.instagram = [{
        pic: 'images/other5.jpg'
    }, {
        pic: 'images/other2.jpg'
    }, {
        pic: 'images/other3.jpg'
    }, {
        pic: 'images/other4.jpg'
    }];

});

app.directive('mainProduct1', function () {
    "use strict";
    var direc = {}, // Create an empty object
        linkFunction = function (scope, element, attributes) {
            scope.pic = attributes.pic;
            scope.type = attributes.type;
            scope.price = attributes.price;
            scope.colour = attributes.colour; // or attributes.ngDemo1;
        };

    direc.restrict = 'EA';
    //E - Element, A - Attribute, C - Class, M - Comment
    direc.link = linkFunction;
    direc.template = '<div class="col-xs-12 col-md-4"><center><a href="#"><img data-ng-src={{pic}} class="img-responsive"></a><br/><h4>{{type}}</h4>{{price}} | {{colour}} Color<br/><br/><button class="btn btn-light jumBut3">View Collection</button></div></center>'; // text bind to the scope.text in linkFunction
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
            scope.colour = attributes.colour; // or attributes.ngDemo1;
        };

    direc.restrict = 'EA';
    //E - Element, A - Attribute, C - Class, M - Comment
    direc.link = linkFunction;
    direc.template = ' <div class="hidden-xs hidden-sm col-md-4"><center><a href="#"><img data-ng-src={{pic}} class="img-responsive"></a><br/><h4>{{type}}</h4>{{price}} | {{colour}} Color<br/><br/><button class="btn btn-light jumBut3">View Collection</button></div></center>'; // text bind to the scope.text in linkFunction
    direc.scope = {}; //Special Setting to avoid instance's scope overring.

    return direc;
});

app.directive('review1', function () {
    "use strict";
    var direc = {}, // Create an empty object
        linkFunction = function (scope, element, attributes) {
            scope.pic = attributes.pic;
            scope.rating = attributes.rating;
            scope.purchase = attributes.purchase;
            scope.comment = attributes.comment;
            scope.reviewer = attributes.reviewer;
        };

    direc.restrict = 'EA';
    //E - Element, A - Attribute, C - Class, M - Comment
    direc.link = linkFunction;
    direc.template = '<div class="col-xs-12 col-md-4 box"><div class="inner-box"><center><img data-ng-src={{pic}} class="watch-bought" /><br /><img src={{rating}} class="rating" /><br /><p>Purchased <a href=#>{{purchase}}</a></p><p>{{comment}}</p><br /><a href=#>Read More</a><br /><br /><p>-{{reviewer}}</p></center></div></div>'; // text bind to the scope.text in linkFunction
    direc.scope = {}; //Special Setting to avoid instance's scope overring.

    return direc;
});

app.directive('review2', function () {
    "use strict";
    var direc = {}, // Create an empty object
        linkFunction = function (scope, element, attributes) {
            scope.pic = attributes.pic;
            scope.rating = attributes.rating;
            scope.purchase = attributes.purchase;
            scope.comment = attributes.comment;
            scope.reviewer = attributes.reviewer;
        };

    direc.restrict = 'EA';
    //E - Element, A - Attribute, C - Class, M - Comment
    direc.link = linkFunction;
    direc.template = '<div class="hidden-xs hidden-sm col-md-4 box"><div class="inner-box"><center><img data-ng-src={{pic}} class="watch-bought" /><br /><img src={{rating}} class="rating" /><br /><p>Purchased <a href=#>{{purchase}}</a></p><p>{{comment}}</p><br /><a href=#>Read More</a><br /><br /><p>-{{reviewer}}</p></center></div></div>'; // text bind to the scope.text in linkFunction
    direc.scope = {}; //Special Setting to avoid instance's scope overring.

    return direc;
});

app.directive('companyLogo', function () {
    "use strict";
    var direc = {}, // Create an empty object
        linkFunction = function (scope, element, attributes) {
            scope.pic = attributes.pic;
        };

    direc.restrict = 'EA';
    //E - Element, A - Attribute, C - Class, M - Comment
    direc.link = linkFunction;
    direc.template = '<div class="col-xs-4 col-md-2 com"><img data-ng-src={{pic}} class="img-responsive" alt="logo" class="logo" /></div>'; // text bind to the scope.text in linkFunction
    direc.scope = {}; //Special Setting to avoid instance's scope overring.

    return direc;
});

app.directive('extraStuff', function () {
    "use strict";
    var direc = {}, // Create an empty object
        linkFunction = function (scope, element, attributes) {
            scope.pic = attributes.pic;
            scope.description = attributes.description;
        };

    direc.restrict = 'EA';
    //E - Element, A - Attribute, C - Class, M - Comment
    direc.link = linkFunction;
    direc.template = '<div class="col-xs-6 col-md-3 extracol"><div class="extracolin"><img src={{pic}} class="extra" alt="extra" /><p>{{description}}</p></div></div>'; // text bind to the scope.text in linkFunction
    direc.scope = {}; //Special Setting to avoid instance's scope overring.

    return direc;
});

app.directive('extraInstagram', function () {
    "use strict";
    var direc = {}, // Create an empty object
        linkFunction = function (scope, element, attributes) {
            scope.pic = attributes.pic;
        };

    direc.restrict = 'EA';
    //E - Element, A - Attribute, C - Class, M - Comment
    direc.link = linkFunction;
    direc.template = '<div class="col-xs-6 col-md-3 othercol"><img src={{pic}} class="img-responsive" alt="other" /></div>'; // text bind to the scope.text in linkFunction
    direc.scope = {}; //Special Setting to avoid instance's scope overring.

    return direc;
});

