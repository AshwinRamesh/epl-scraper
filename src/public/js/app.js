var app = angular.module("app", ['ngRoute', 'ui.bootstrap']); // define the app

/* Defining the routes for the app */
app.config(function($routeProvider) {

    $routeProvider.when('/', {
        templateUrl: 'views/index.html',
        controller: 'FixtureController'
    });

    $routeProvider.when('/club', { // todo
        templateUrl: 'views/topXI.html',
        controller: 'MyController'
    });

    $routeProvider.when('/club/:name', { // todo
        templateUrl: 'views/topXI.html',
        controller: 'MyController'
    });

    $routeProvider.when('/recommended', { // todo
        templateUrl: 'views/topXI.html',
        controller: 'MyController'
    });

    $routeProvider.when('/table', {
        templateUrl: 'views/table.html',
        controller: 'TableController'
    });

    $routeProvider.when('/player/id/:id', { // todo
        templateUrl: 'views/topXI.html',
        controller: 'MyController'
    });

    $routeProvider.when('/player/compare/:playerA/:playerB', { // todo
        templateUrl: 'views/topXI.html',
        controller: 'MyController'
    });

    $routeProvider.when('/player/compare', { // todo
        templateUrl: 'views/topXI.html',
        controller: 'MyController'
    });

    $routeProvider.when('/player', {
        templateUrl: 'views/player.html',
        controller: 'PlayerController'
    });

    $routeProvider.otherwise({
        redirectTo: '/'
    });
});


