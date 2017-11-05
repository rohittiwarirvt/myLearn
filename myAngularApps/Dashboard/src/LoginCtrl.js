var myDashboard = angular.module('myDashboard');

myDashboard.controller('LoginCtrl', function($scope) {
  $scope.username= "rohit@gmail.com";
  $scope.password ="admin1234";

  $scope.submit = function() {
    console.log($scope.username);
    console.log($scope.password);
  };
});
