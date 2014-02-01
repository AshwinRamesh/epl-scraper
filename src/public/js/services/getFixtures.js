app.factory('getFixtures', function($http) {
    return {
        fixtures: function() {
            return $http.get('http://localhost/epl/src/public/ajax/getFixtures.php').then(function(result) {
                    return result.data;
            });
        }
    }
});
