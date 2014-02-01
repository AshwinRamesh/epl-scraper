app.controller('FixtureController', function($scope, getFixtures) {
    $scope.fixtureData = getFixtures.fixtures().then(function(fixtureData) {
        for (var fixture in fixtureData.fixtures) {
            var obj = fixtureData.fixtures[fixture];
            console.log(obj);
            if (obj.home_goals == null || obj.away_goals == null) {
                fixtureData.fixtures[fixture].result = "T.B.D.";
            } else {
                fixtureData.fixtures[fixture].result = fixtureData.fixtures[fixture].home_goals + "-" + fixtureData.fixtures[fixture].away_goals;
            }
        }
        $scope.fixtureData = fixtureData;
        console.log($scope.fixtureData);
    });
});
