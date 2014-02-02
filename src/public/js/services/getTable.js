app.factory('getTable', function($http) {
    return {
        table: function() {
            return $http.get('ajax/getTable.php').then(function(result) {
                    return result.data;
            });
        }
    }
});
