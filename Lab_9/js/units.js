/*jslint white:true*/
/*global angular*/
/*global $ */

var app = angular.module("myApp", []);

//directive to produce the bar chart
app.directive('lineHighchart', function () {
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



app.controller("locationController", function ($scope, $http, $interval) {
    "use strict";

    //Ticking clock and date
    var tick = function () {
        $scope.clock = Date.now();
    };
    tick();
    $interval(tick, 1000);

    $http.get("http://dataservice.accuweather.com/locations/v1/cities/search?apikey=2fxKW1INRqvO3Kyf6n0wEDK9wXrdGxRB&q=Kuching%2C%20Sarawak")
        .then(
            function (response) {
                $scope.currentLocation = response.data;


            });

    $http.get("http://dataservice.accuweather.com/currentconditions/v1/230204?apikey=2fxKW1INRqvO3Kyf6n0wEDK9wXrdGxRB&details=true")
        .then(
            function (response) {
                $scope.currentCondition = response.data;


            });

    $http.get("http://dataservice.accuweather.com/forecasts/v1/hourly/12hour/230204?apikey=2fxKW1INRqvO3Kyf6n0wEDK9wXrdGxRB&details=true&metric=true")
        .then(
            function (response) {
                $scope.hourlyForecast = response.data;

                $scope.temperature = [];

                $scope.hour = [];

                var i,
                    j,
                    date,
                    h;
                    


                for (i = 0; i < 12; i += 1) {
                    $scope.temperature.push($scope.hourlyForecast[i].Temperature.Value);
                }

                for (j = 0; j < 12; j += 1) {
                    //date = new Date($scope.hourlyForecast[i].DateTime);
                    
                    //h = date.getUTCHours;
                    
                    //$scope.hour.push($scope.hourlyForecast[i].DateTime);
                }


                $scope.renderChart = {
                    chart: {
                        renderTo: 'myfirstchart',
                        type: 'line'
                    },
                    title: {
                        text: '12 Hours of Hourly Forecast'
                    },

                    subtitle: {
                        text: 'of the Temperature'
                    },

                    xAxis: {
                        //categories: [$scope.hour[0], $scope.hour[1], $scope.hour[2], $scope.hour[3], $scope.hour[4], $scope.hour[5], $scope.hour[6], $scope.hour[7], $scope.hour[8], $scope.hour[9], $scope.hour[10], $scope.hour[11]]
                        
                        categories: ['1am', '2am', '3am', '4am', '5am', '6am', '7am', '8am', '9am', '10am', '11am', '12pm']
                    },
                    yAxis: {
                        title: {
                            text: 'Temperature (Celcius)'
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
                            name: 'Temperature',
                            data: [$scope.temperature[0], $scope.temperature[1], $scope.temperature[2], $scope.temperature[3], $scope.temperature[4], $scope.temperature[5], $scope.temperature[6], $scope.temperature[7], $scope.temperature[8], $scope.temperature[9], $scope.temperature[10], $scope.temperature[11]],
                            color: '#f899ff'
                        }
                        ]
                };

            });
});
