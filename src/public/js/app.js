var app = angular.module("app", ['ngRoute', 'ui.bootstrap']); // define the app

/* Defining the routes for the app */
app.config(function($routeProvider) {

    $routeProvider.when('/', {
        templateUrl: 'views/index.html',
        controller: 'MyController'
    });

    $routeProvider.when('/topXI', {
        templateUrl: 'views/topXI.html',
        controller: 'MyController'
    });

    $routeProvider.when('/table', {
        templateUrl: 'views/table.html',
        controller: 'TableController'
    });

    $routeProvider.otherwise({
        redirectTo: '/'
    });
});


