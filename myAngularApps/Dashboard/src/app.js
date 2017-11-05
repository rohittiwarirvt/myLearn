var myDashboard = angular.module('myDashboard', ['ui.router']);


myDashboard.config(function($stateProvider, $urlRouterProvider) {

  $stateProvider
  .state('login', {
    'url': "/",
    'templateUrl': 'views/auth/login.html',
    'controller': 'LoginCtrl'
  });
  $urlRouterProvider.otherwise('/');
});

