//app.factory('getPlayerSearch', function($http) {
//    return {
//        players: function(query) {
//            return $http.get(
//                'ajax/getPlayers.php',
//                {
//                    data: {query: query} // the query string as param
//                }).then(function(result) {
//                    return result.data;
//            });
//        }
//    }
//});

app.factory('getPlayerSearch', function($http) {
    return {
        players: function(query) {
            return $http.get(
                'ajax/getPlayers.php',
                {
                    params: {query: query} // the query string as param
                }).success(function(data, status, headers, config) {
                    return data;
                }).error(function(data, status, headers, config){
                    return data; // dunno why this doesn't work...
                });
        }
    }
});
