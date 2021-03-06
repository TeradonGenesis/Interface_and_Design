/*jslint white:true*/
/*global angular*/
/*global $ */

var app = angular.module("myApp", []);

//directive to produce the line chart chart for temperature 12 hourly
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


//directive to produce the line chart chart for wind speed 12 hourly
app.directive('speedHighchart', function () {
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



//directive to produce the line chart chart for temperature 24 hourly
app.directive('allhourHighchart', function () {
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

    $http.get("http://dataservice.accuweather.com/locations/v1/cities/search?apikey=bQdVIsYVQdL1dYzZT0bZ8NQID26RZLB7&q=kuching%2C%20sarawak")
        .then(
            function (response) {
                $scope.currentLocation = response.data;


            });

    $http.get("http://dataservice.accuweather.com/currentconditions/v1/230204?apikey=bQdVIsYVQdL1dYzZT0bZ8NQID26RZLB7&details=true")
        .then(
            function (response) {
                $scope.currentCondition = response.data;


            });

    $http.get("http://dataservice.accuweather.com/forecasts/v1/hourly/12hour/230204?apikey=bQdVIsYVQdL1dYzZT0bZ8NQID26RZLB7&details=true&metric=true")
        .then(
            function (response) {
                $scope.hourlyForecast = response.data;

                $scope.temperature = [];

                $scope.hour = [];
                
                $scope.speed = [];

                var i,
                    j,
                    date,
                    h,
                    w,
                value;
                    


                for (i = 0; i < 12; i += 1) {
                    $scope.temperature.push($scope.hourlyForecast[i].Temperature.Value);
                }
                
                for (w = 0; w < 12; w += 1) {
                    $scope.speed.push($scope.hourlyForecast[w].Wind.Speed.Value);
                }


                for (j = 0; j < 12; j += 1) {
                    date = new Date($scope.hourlyForecast[j].EpochDateTime *1000);
                    
                    h = String(date.getUTCHours());
                    
                    
                    
                    value = h.concat(':00');
                                       
                    $scope.hour.push(value);
                }

                $scope.renderChart = {
                    chart: {
                        type: 'line'
                    },
                    title: {
                        text: '12 Hours of Hourly Forecast'
                    },

                    subtitle: {
                        text: 'of the Temperature'
                    },

                    xAxis: {
                        title: {
                            text: 'Time (24 hours system)'
                        },
                        categories: [$scope.hour[0], $scope.hour[1], $scope.hour[2], $scope.hour[3], $scope.hour[4], $scope.hour[5], $scope.hour[6], $scope.hour[7], $scope.hour[8], $scope.hour[9], $scope.hour[10], $scope.hour[11]]
                    },
                    yAxis: {
                        title: {
                            text: 'Temperature °C'
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
                
                $scope.windChart = {
                    chart: {
                        type: 'line'
                    },
                    title: {
                        text: '12 Hours of Hourly Forecast'
                    },

                    subtitle: {
                        text: 'of the Wind Speed'
                    },

                    xAxis: {
                        title: {
                            text: 'Time (24 hours system)'
                        },
                        categories: [$scope.hour[0], $scope.hour[1], $scope.hour[2], $scope.hour[3], $scope.hour[4], $scope.hour[5], $scope.hour[6], $scope.hour[7], $scope.hour[8], $scope.hour[9], $scope.hour[10], $scope.hour[11]]
                    },
                    yAxis: {
                        title: {
                            text: 'Wind Speed (km/h)'
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
                            name: 'Speed',
                            data: [$scope.speed[0], $scope.speed[1], $scope.speed[2], $scope.speed[3], $scope.speed[4], $scope.speed[5], $scope.speed[6], $scope.speed[7], $scope.speed[8], $scope.speed[9], $scope.speed[10], $scope.speed[11]]
                        }
                        ]
                };

            });
    
     $http.get("http://dataservice.accuweather.com/forecasts/v1/daily/5day/230204?apikey=bQdVIsYVQdL1dYzZT0bZ8NQID26RZLB7&details=true&metric=true")
        .then(
            function (response) {
                $scope.dailyForecast = response.data;
                
                $scope.minTemp = [];
                $scope.maxTemp = [];
                $scope.daily = [];
                
                var k,
                    l,
                    m,
                    day,
                    month,
                    year,
                weekDate,
                    theDays,
                    actualDate,
                UTCDate;
                
                for (k = 0; k < 5; k += 1) {
                    $scope.minTemp.push($scope.dailyForecast.DailyForecasts[k].Temperature.Minimum.Value);
                }
                
                for (l = 0; l < 5; l += 1) {
                    $scope.maxTemp.push($scope.dailyForecast.DailyForecasts[l].Temperature.Maximum.Value);
                }
                
                for (m = 0; m < 5; m += 1) {
                    
                    UTCDate = new Date($scope.dailyForecast.DailyForecasts[m].EpochDate *1000);
                    
                    weekDate = UTCDate.getUTCDay();
                    
                    switch (weekDate) {
                        case 1:
                            theDays = "Monday";
                            break;
                            
                        case 2:
                            theDays = "Tuesday";
                            break;
                            
                        case 3:
                            theDays = "Wednesday";
                            break;
                            
                        case 4:
                            theDays = "Thursay";
                            break;
                            
                        case 5:
                            theDays = "Friday";
                            break;
                            
                        case 6:
                            theDays = "Saturday";
                            break;
                        case 7:
                            theDays = "Sunday";
                            break;
                    }
                    
                    day = String(UTCDate.getUTCDate());
                    
                    month = String(UTCDate.getUTCMonth());
                    
                    year = String(UTCDate.getUTCFullYear());
                    
                    actualDate = theDays.concat(","," ",day,"/", month, "/", year);
                    
                    $scope.daily.push(actualDate);
                }
                


            });
    
    $http.get("http://dataservice.accuweather.com/currentconditions/v1/230204/historical/24?apikey=bQdVIsYVQdL1dYzZT0bZ8NQID26RZLB7&details=true")
        .then(
            function (response) {
                $scope.allHourly = response.data;

                $scope.allTemperature = [];

                $scope.allHour = [];

                var p,
                    q,
                    allDate,
                    allH;
                    

                for (p = 0; p < 24; p += 1) {
                    $scope.allTemperature.push($scope.allHourly[p].Temperature.Metric.Value);
                }

                for (q = 0; q < 24; q += 1) {
                    allDate = new Date($scope.allHourly[q].LocalObservationDateTime);
                    
                    allH = String(allDate.getHours());
                                       
                    $scope.allHour.push(allH);
                }
                
                
                $scope.max = Math.max.apply(Math,$scope.allTemperature); 
                $scope.min = Math.min.apply(Math,$scope.allTemperature);
                

                $scope.renderallHourChart = {
                    chart: {
                        type: 'line'
                    },
                    title: {
                        text: ' 24 hours of historical current condition'
                    },

                    subtitle: {
                        text: 'of the Temperature'
                    },

                    xAxis: {
                        title: {
                            text: 'Time (24 hours system)'
                        },
                        categories: [$scope.allHour[0], $scope.allHour[1], $scope.allHour[2], $scope.allHour[3], $scope.allHour[4], $scope.allHour[5], $scope.allHour[6], $scope.allHour[7], $scope.allHour[8], $scope.allHour[9], $scope.allHour[10], $scope.allHour[11], $scope.allHour[12], $scope.allHour[13], $scope.allHour[14], $scope.allHour[15], $scope.allHour[16], $scope.allHour[17], $scope.allHour[18], $scope.allHour[19], $scope.allHour[20], $scope.allHour[21], $scope.allHour[22], $scope.allHour[23]]
                    },
                    yAxis: {
                        title: {
                            text: 'Temperature (°C)'
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
                            data: [$scope.allTemperature[0], $scope.allTemperature[1], $scope.allTemperature[2], $scope.allTemperature[3], $scope.allTemperature[4], $scope.allTemperature[5], $scope.allTemperature[6], $scope.allTemperature[7], $scope.allTemperature[8], $scope.allTemperature[9], $scope.allTemperature[10], $scope.allTemperature[11], $scope.allTemperature[12], $scope.allTemperature[13], $scope.allTemperature[14], $scope.allTemperature[15], $scope.allTemperature[16], $scope.allTemperature[17], $scope.allTemperature[18], $scope.allTemperature[19], $scope.allTemperature[20], $scope.allTemperature[21], $scope.allTemperature[22], $scope.allTemperature[23]],
                            color: '#42f47a'
                        }
                        ]
                };

            });
    

});
