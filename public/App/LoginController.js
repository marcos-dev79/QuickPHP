/**
 * Created by @mriso_dev 10/04/2018
 */
(function(){

    "use strict";
    
    function Login($scope, $http, $cookies, getLanguage) {
        var vm = this;

        $scope.selectedLang = 'pt-br';
        $scope.formData = {
            name: '',
            email: '',
            senha: '',
            remember: true,
            lang: {}
        };

        vm.onLoadCookie = function() {
            vm.getLanguage();
            let user = $cookies.getObject('user');
            if(typeof user !== "undefined") {
                $scope.formData.name = user.name;
                $scope.formData.email = user.email;
                $scope.formData.remember = user.remember;
                $scope.selectedLang = user.lang;
                vm.getLanguage();
            }
        }

        vm.getLanguage = function(){
            $scope.lang = getLanguage.getdata($scope.selectedLang).then(function mySuccess(response) {
                $scope.formData.lang = response.data;
            }, function myError(response) {
                abc = "Error Found :" + response.statusText;
            });
        }

        vm.changeLang = function(lang) {
            $scope.selectedLang = lang;
            vm.getLanguage();
        }

        vm.submit = function() {
            $http.post('/login', {pdata: $scope.formData })
                .then(function(data, status, headers, config) {
                    $scope.msg = data.data.msg;
                    data.data.user.lang = $scope.selectedLang;

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

        return vm;
    }

    angular
        .module('app')
        .controller('ctrLogin', Login);

})();