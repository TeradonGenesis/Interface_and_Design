var app = angular.module('myApp', ["ngRoute"]);

//Custom Filter Implementation
app.filter("num2words", function() {
    return function (myNum) {
        var ans = "";
        switch (myNum) {
        case 0:
            ans = "Zero";
            break;
        case 1:
            ans = "One";
            break;
        default:
            ans = "Not One or Zero";
            break;
        }
        return ans;
    };
});

//Custom Directive Implementation
//NOTE: the directive name in html was ng-demo1 but in javascript is ngDemo1 (hyphen-case to camelCase)
app.directive('ngDemo1', function () {
    var direc = {};     // Create an empty object
    var linkFunction = function (scope, element, attributes) {
        scope.text = attributes["ngDemo1"];  // or attributes.ngDemo1;
    };

    direc.restrict = 'A'; //E - Element, A - Attribute, C - Class, M - Comment
    direc.link = linkFunction;
    direc.template = '<div><p>{{text}}</p></div>'; // text bind to the scope.text in linkFunction
    direc.scope = {};     //Special Setting to avoid instance's scope overring.

    return direc;
});

/* Simplified Version of above custome directive - Commonly Style
app.directive('ngDemo1', function(){
    return {
        restrict: 'A',
        link: function(scope, element, attributes){
            scope.text = attributes["ngDemo1"];
        },
        template: '<div><p>{{text}}</p></div>',
        scope: {}
    };
});
*/

app.directive('ngDemo2', function () {
    var direc = {};
    var linkFunction = function (scope, element, attributes) {
        /* Evaluates attribute before assigning it into a model */
        scope.items = scope.$eval(attributes.ngDemo2);
    };

    direc.restrict = 'A';
    direc.link = linkFunction;
    direc.template = '<div data-ng-repeat="item in items"><p>{{item}}</p></div>';
    direc.scope = {};

    return direc;
});



//Routing Implementation
app.controller("myCtrl", function($scope){
   $scope.students = [
        {name:'Amy',age:26}, 
        {name:'Dolly',age:18}, 
        {name:'Cat',age:21}, 
        {name:'Ben',age:24}
   ];
});

app.config(function($routeProvider){
    $routeProvider
    .when("/students",{
        templateUrl: "lec5-templates/students.html",
        controller: "myCtrl"
    })
    .when("/studentdetails",{
        templateUrl: "lec5-templates/studentDetails.html",
        controller: "myCtrl"
    })
    .otherwise({
        redirectTo: "/students"
    });
});
            

