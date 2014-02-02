app.controller("PlayerController", function($scope, $location, getPlayerSearch) {
    $scope.searched = false;
    $scope.players = [];
    $scope.searchPlayer = function() {
        if ($scope.query == "" || !$scope.query) {
            alert("Please enter a search query!");
            return;
        }
        $scope.players = getPlayerSearch.players($scope.query).then(
            function(data){ // on success
                if (data.outcome == false) {
                    $scope.searched = false;
                    return;
                }
                $scope.players = data.data;
                $scope.searched = true;
            },
            function(data){ // on failure
                alert("Server Error!");
            });
    }

    $scope.viewPlayer = function(id) {
        $location.path('player/id/' + id);
    }

    $scope.viewClub = function(name) {
        $location.path('club/' + name);
    }

});
