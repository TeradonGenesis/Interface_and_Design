/*jslint white:true*/
/*global angular*/
/*global $ */

var app = angular.module("myApp", []);

//directive to produce the bar chart
app.directive('barHighchart', function () {
    "use strict";
    return {
        restrict: 'E',
        template: '<div style="height: 500px" ></div>',
        replace: true,

        link: function (scope, element, attrs) {

            scope.$watch(function () {
                return attrs.chart;
            }, function () {


                var charts = JSON.parse(attrs.chart);

                $(element[0]).highcharts(charts);

            });
        }
    };
});


// since the controller already takes in the json file. I reuse the course scope to count the number of json objects filtered by the type and then ouput it using .length. Then, I created renderChart scope to use the expression later in my directive. 
//References: https://stackoverflow.com/questions/35457390/creating-a-pie-highchart-from-data-in-local-object-json-file
app.controller("myCtrl", function ($scope, $http) {
    "use strict";
    $http.get('data/course.json')
        .then(
            function (response) {
                $scope.courses = response.data;


                $scope.countCore = $scope.courses.filter(function (v) {
                    return v.type === 'Core';
                }).length;

                $scope.countSD = $scope.courses.filter(function (v) {
                    return v.type === 'Software Development';
                }).length;

                $scope.countSA = $scope.courses.filter(function (v) {
                    return v.type === 'System Analysis';
                }).length;

                $scope.renderChart = {
                    chart: {
                        renderTo: 'myfirstchart',
                        type: 'column'
                    },
                    title: {
                        text: 'Unit offered for Bachelor of Information and Communication Technology'
                    },
                    
                    subtitle: {
                        text: 'From Swinburne University of Technology'
                    },
                    
                    xAxis: {
                        categories: ['Unit Type']

                    },
                    yAxis: {
                        title: {
                            text: 'Number of Units'
                        }
                    },
                    
                    plotOptions: {
                        series: {
                            dataLabels: {
                                enabled: true
                            }
                        }
                    },
                    series: [
                        {
                            name: 'Core',
                            data: [$scope.countCore], color: '#aaff99'
                        },
                        {
                            name: 'Software Development',
                            data: [$scope.countSD], color: '#999aff'
                        },
                        {
                            name: 'System Analysis',
                            data: [$scope.countSA], color: '#f899ff'
                        }
                        ]
                };

            });
});

/*var text = 'data/course.json';

    var countCore = text.filter(function (v) {return v.type === 'Core';}).length;
    
    var countSD = text.filter(function (v) {return v.type === 'Software Development';}).length;
    
    var countSA = text.filter(function (v) {return v.type === 'System Analysis';}).length;*/

/*document.addEventListener('DOMContentLoaded', function () {
    "use strict";

    var option = {
        chart: {
            renderTo: 'myfirstchart',
            type: 'column'
        },
        title: {
            text: 'Unit offered for Bachelor of Information and Communication Technology'
        },
        xAxis: {
            categories: ['Unit Type']

        },
        yAxis: {
            title: {
                text: 'Number of Units'
            }
        },
        series: [
            {
                name: 'Core',
                data: [5]
        },
            {
                name: 'Software Development',
                data: [5]
        },
            {
                name: 'System Analysis',
                data: [5]
        }
        ]
    };

    var chart = new Highcharts.Chart(option);
});*/
