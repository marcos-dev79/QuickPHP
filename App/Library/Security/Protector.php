<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 28/04/16
 * Time: 15:59
 */

namespace Library\Security;


class Protector
{
    public static function genhash($string){
        $hash = password_hash($string, PASSWORD_DEFAULT);
        return $hash;
    }

    public static function verifyhash($pass, $hash){
        return password_verify($pass, $hash);
    }

    public static function isLogged(){
        if(isset($_SESSION['is_logged']) && $_SESSION['is_logged'] == 1){
            return true;
        }
        return false;
    }

    public static function getUser(){
        return $_SESSION['user'];
    }

    public static function isAllowedOrLogged($url, $list){
        if(strpos($url, '/insert') === 0){
            if(in_array('/insert', $list)){
                if(!(isset($_SESSION['is_logged']) && $_SESSION['is_logged'] == 1)){
                    return false;
                }
            }
            return true;
        }elseif(strpos($url, '/editing') === 0){
            if(in_array('/editing', $list)){
                if(!(isset($_SESSION['is_logged']) && $_SESSION['is_logged'] == 1)){
                    return false;
                }
            }
            return true;
        }elseif(strpos($url, '/deleting') === 0){
            if(in_array('/deleting', $list)){
                if(!(isset($_SESSION['is_logged']) && $_SESSION['is_logged'] == 1)){
                    return false;
                }
            }
            return true;
        }elseif(strpos($url, '/listing') === 0){
            if(in_array('/listing', $list)){
                if(!(isset($_SESSION['is_logged']) && $_SESSION['is_logged'] == 1)){
                    return false;
                }
            }
            return true;
        }else{
            if(in_array($url, $list)){
                if(!(isset($_SESSION['is_logged']) && $_SESSION['is_logged'] == 1)){
                    return false;
                }
            }
            return true;
        }
    }
}