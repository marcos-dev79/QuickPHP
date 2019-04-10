/**
 * Created by @mriso_dev 10/04/2018
 */
(function(){

    "use strict";
    
    function getListController($scope, $http, $sce) {

        $scope.init = function(url) {
            $http.get(url).then(function(data){
                $scope.obj = data.data;
            });
        };

        $scope.search = '';

        $scope.menufilter = function() {
            $http.get('/menu?display_name='+$scope.search).then(function(data){
                $scope.obj = data.data;
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

        $scope.trustme = function(item) {
            return $sce.trustAsHtml(item);
        };

        $scope.showModal = function(id){
            $scope.id = id;
            $('#modal').modal('show');
        }

        $scope.deleteobj = function(table) {
            $http.get('/deleting/'+table+'/'+$scope.id).then(function(data){
                $scope.init('/'+table);
                if(data.result == 'success'){
                    $('#alertd').removeClass('hidden');
                    setTimeout(function(){
                        $("#alertd").addClass('hidden');
                    }, 3000);
                }else{
                    $('#alerts').removeClass('hidden');
                    setTimeout(function(){
                        $('#alerts').addClass('hidden');
                    }, 3000);
                }
                $('#modal').modal('hide');
            });
        };

    }

    angular
        .module('app')
        .controller('getList', getListController);


})();