app.controller('TableController', function($scope, getTable) {
    $scope.table = getTable.table().then(function(tableData) {
        $scope.table = tableData;
        $scope.predicate = "-points"; // filter by points for now
    });
});
