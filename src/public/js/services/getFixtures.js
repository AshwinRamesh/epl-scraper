app.factory('getFixtures', function($http) {
    return {
        fixtures: function() {
            return $http.get('ajax/getFixtures.php').then(function(result) {
                    return result.data;
            });
        }
    }
});
