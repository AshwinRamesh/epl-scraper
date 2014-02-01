app.controller("FixtureController", function($scope, $location, getFixtures) {
    $scope.fixtureData = getFixtures.fixtures();
    console.log($scope.fixtureData);
})
