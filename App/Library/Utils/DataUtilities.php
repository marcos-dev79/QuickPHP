<?php

namespace Library\Utils;


class DataUtilities
{
    public static function checkIsSet($var){
        return (isset($var)) ? $var : '';
    }

    public static function checkIsSetIndex($var, $index){
        return (isset($var[$index])) ? $var[$index] : '';
    }

    public static function getUserSession(){
        if(empty($_SESSION['is_logged']) || $_SESSION['is_logged'] == 0){
            return false;
        }

        if(!empty($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        return false;
    }

    public static function deSerializeJson($json){
        return json_decode($json);
    }
}