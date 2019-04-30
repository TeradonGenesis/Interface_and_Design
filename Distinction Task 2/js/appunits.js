/*jslint white:true*/
/*global angular*/

var app = angular.module("myApp", ["ngRoute"]);

app.controller('myCtrl',
    function ($scope, $routeParams) {
        "use strict";

        $scope.Course = [{
                Code: 'ICT10001',
                Description: 'Problem Solving with ICT',
                Credit_points: 12.5,
                Type: 'Core'
        }, {
                Code: 'COS10005',
                Description: 'Web Development',
                Credit_points: 12.5,
                Type: 'Core'
        }, {
                Code: 'INF10003',
                Description: 'Introduction to Business Information Systems',
                Credit_points: 12.5,
                Type: 'Core'
        }, {
                Code: 'INF10002',
                Description: 'Database Analysis and Design',
                Credit_points: 12.5,
                Type: 'Core'
        }, {
                Code: 'COS10009',
                Description: 'Introduction to Programming',
                Credit_points: 12.5,
                Type: 'Core'
        }, {
                Code: 'INF30029',
                Description: 'Information Technology Project Management',
                Credit_points: 12.5,
                Type: 'Core'
        }, {
                Code: 'ICT30005',
                Description: 'Professional Issues in Information Technology',
                Credit_points: 12.5,
                Type: 'Core'
        }, {
                Code: 'ICT30001',
                Description: 'Information Technology Project',
                Credit_points: 12.5,
                Type: 'Core'
        }, {
                Code: 'COS20001',
                Description: 'User-Centred Design',
                Credit_points: 12.5,
                Type: 'Software Development'
            },
            {
                Code: 'TNE10005',
                Description: 'Network Administration',
                Credit_points: 12.5,
                Type: 'Software Development'
            },
            {
                Code: 'COS20016',
                Description: 'Operating System Configuration',
                Credit_points: 12.5,
                Type: 'Software Development'
            },
            {
                Code: 'SWE20001',
                Description: 'Development Project 1 - Tools and Practices',
                Credit_points: 12.5,
                Type: 'Software Development'
            },
            {
                Code: 'COS20007',
                Description: 'Object Oriented Programming',
                Credit_points: 12.5,
                Type: 'Software Development'
            },
            {
                Code: 'COS30015',
                Description: 'IT Security',
                Credit_points: 12.5,
                Type: 'Software Development'
            },
            {
                Code: 'COS30043',
                Description: 'Interface Design and Development',
                Credit_points: 12.5,
                Type: 'Software Development'
            },
            {
                Code: 'COS30017',
                Description: 'Software Development for Mobile Devices',
                Credit_points: 12.5,
                Type: 'Software Development'
            },
            {
                Code: 'INF20012',
                Description: 'Enterprise Systems',
                Credit_points: 12.5,
                Type: 'System Analysis'
            },
            {
                Code: 'ACC10007',
                Description: 'Financial Information For Decison Making',
                Credit_points: 12.5,
                Type: 'System Analysis'
            },
            {
                Code: 'INF20003',
                Description: 'Requirements Analysis and Modelling',
                Credit_points: 12.5,
                Type: 'System Analysis'
            },
            {
                Code: 'ACC20014',
                Description: 'Management Decision Making',
                Credit_points: 12.5,
                Type: 'System Analysis'
            },
            {
                Code: 'INF30005',
                Description: 'Business Process Management',
                Credit_points: 12.5,
                Type: 'System Analysis'
            },
            {
                Code: 'INF30003',
                Description: 'Business Information System Analysis',
                Credit_points: 12.5,
                Type: 'System Analysis'
            },
            {
                Code: 'INF30020',
                Description: 'Information System Risk and Security',
                Credit_points: 12.5,
                Type: 'System Analysis'
            },
            {
                Code: 'INF30001',
                Description: 'System Acquisition & Implementation Management',
                Credit_points: 12.5,
                Type: 'System Analysis'
            }
                        ];


        $scope.Code = $routeParams.courseCode;


    });

app.config(function ($routeProvider) {

    "use strict";

    $routeProvider
        .when("/moreDetail/:courseCode", {
            templateUrl: "detail/moreDetail.html",
            controller: "myCtrl"
        })
        .otherwise({
            redirectTo: ""
        });
});
