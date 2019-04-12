/**
 * Created by marcos on 21/04/16.
 * Updated on 10/04/2018
 */
(function(){

    "use strict";
    
    angular.module('app', ['ngCookies'])
    
    .filter('isEmpty', function () {
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


})();