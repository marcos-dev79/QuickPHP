/**
 * Created by @mriso_dev 12/04/2019
 */
(function(){

    "use strict";
    
    function GetLanguage($http) {
        
        var language = {}; 

        language.getdata = function(lang) {
            return $http.get('/public/lang/' + lang + '.json');
        }
    
        return language;
       
    }

    angular
        .module('app')
        .factory('getLanguage', GetLanguage);

})();