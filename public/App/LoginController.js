/**
 * Created by @mriso_dev 10/04/2018
 */
(function(){

    "use strict";
    
    function Login($scope, $http) {
        $scope.formData = {};
        $scope.submit = function() {
            $http.post('/login', {pdata: $scope.formData })
                .then(function(data, status, headers, config) {
                    $scope.msg = data.data.msg;

                    if(data.data.error == 0) {
                        window.location = '/admin';
                    }
                })
                .catch(function(data, status, headers, config) {
                    $scope.msg = 'Erro de Sistema! Tente novamente.';
                });
        };
    }

    angular
        .module('app', [])
        .controller('ctrLogin', Login);

})();