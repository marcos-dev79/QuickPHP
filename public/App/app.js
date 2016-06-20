/**
 * Created by marcos on 21/04/16.
 */
(function(){

    var app = angular.module('Nolx',[]).filter('isEmpty', function () {
        var bar;
        return function (obj) {
            for (bar in obj) {
                if (obj.hasOwnProperty(bar)) {
                    return false;
                }
            }
            return true;
        };
    });

    app.controller('getList', function ($scope, $http) {

        $scope.init = function(url) {
            $http.get(url).success(function(data){
                $scope.obj = data;
            });
        };

        $scope.range = function(n) {
            return new Array(n);
        };

        $scope.getTypeOf = function(value) {
            if(value === null) {
                return "null";
            }
            if(Array.isArray(value)) {
                return "array";
            }
            return typeof value;
        };

        $scope.showModal = function(id){
            $scope.id = id;
            $('#modal').modal('show');
        }

        $scope.deleteobj = function(table) {
            $http.get('/deleting/'+table+'/'+$scope.id).success(function(data){
                $scope.init('/'+table);
                if(data.result == 'success'){
                    $('#alerts').removeClass('hidden');
                    setTimeout(function(){
                        $("#alerts").addClass('hidden');
                    }, 3000);
                }else{
                    $('#alertd').removeClass('hidden');
                    setTimeout(function(){
                        $('#alertd').addClass('hidden');
                    }, 3000);
                }
                $('#modal').modal('hide');
            });
        };

    });

    app.controller('ctrLogin', function ($scope, $http) {
        $scope.formData = {};
        $scope.submit = function() {
            $http.post('/login', {pdata: $scope.formData }).
                success(function(data, status, headers, config) {
                    $scope.msg = data.msg;
                    if(data.error == 0) {
                        window.location = '/admin';
                    }
                }).
                error(function(data, status, headers, config) {
                    $scope.msg = 'Erro de Sistema! Tente novamente.';
                });
        };
    });

})();