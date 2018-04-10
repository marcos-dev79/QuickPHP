/**
 * Created by @mriso_dev 10/04/2018
 */
(function(){

    "use strict";
    
    function getList ($scope, $http) {

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

    }


    angular
        .module('app', [])
        .controller('getList', getList);


})();