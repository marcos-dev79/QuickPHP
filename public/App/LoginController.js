/**
 * Created by @mriso_dev 10/04/2018
 */
(function(){

    "use strict";
    
    function Login($scope, $http, $cookies) {

        $scope.formData = {
            name: '',
            email: '',
            senha: '',
            remember: true
        };

        $scope.onLoadCookie = function() {
            let user = $cookies.getObject('user');
            if(typeof user !== "undefined") {
                $scope.formData.name = user.name;
                $scope.formData.email = user.email;
                $scope.formData.remember = user.remember;
            }
        }

        $scope.submit = function() {
            $http.post('/login', {pdata: $scope.formData })
                .then(function(data, status, headers, config) {
                    $scope.msg = data.data.msg;

                    if($scope.formData.remember) {
                        data.data.user.remember = true;
                        $cookies.putObject('user', data.data.user);
                    }else{
                        $cookies.remove('user');
                    }

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
        .module('app')
        .controller('ctrLogin', Login);

})();