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

    public static function getUserAndTypeForAdmin(){
        if(isset($_SESSION['user']['type']) && $_SESSION['user']['type']!=2){
            header('Location: /404');
            return false;
        }

        if(isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        return false;
    }

    public static function isAllowedOrLogged($url, $list){
        if(strpos($url, '/insert') === 0){
            if(in_array('/insert', $list)){
                self::getUserAndTypeForAdmin();
                if(!(isset($_SESSION['is_logged']) && $_SESSION['is_logged'] == 1)){
                    return false;
                }
            }
            return true;
        }elseif(strpos($url, '/editing') === 0){
            if(in_array('/editing', $list)){
                self::getUserAndTypeForAdmin();
                if(!(isset($_SESSION['is_logged']) && $_SESSION['is_logged'] == 1)){
                    return false;
                }
            }
            return true;
        }elseif(strpos($url, '/deleting') === 0){
            if(in_array('/deleting', $list)){
                self::getUserAndTypeForAdmin();
                if(!(isset($_SESSION['is_logged']) && $_SESSION['is_logged'] == 1)){
                    return false;
                }
            }
            return true;
        }elseif(strpos($url, '/listing') === 0){
            if(in_array('/listing', $list)){
                self::getUserAndTypeForAdmin();
                if(!(isset($_SESSION['is_logged']) && $_SESSION['is_logged'] == 1)){
                    return false;
                }
            }
            return true;
        }else{
            if(in_array($url, $list)){
                self::getUserAndTypeForAdmin();
                if(!(isset($_SESSION['is_logged']) && $_SESSION['is_logged'] == 1)){
                    return false;
                }
            }
            return true;
        }
    }

    public static function sanitize($var, $type = 'string')
    {
        switch($type) {
            case 'string':
                $var = strip_tags($var);
                $var = trim($var);
                $var = addslashes($var);
                $var = str_replace(";", " ", $var);
                $var = html_entity_decode($var);

                return $var;
                break;
            case 'int':
                $var = (int) $var * 1;
                return $var;
                break;
            case 'float':
                $var = str_replace(',', '.', $var);
                return $var;
                break;
            case 'mix':
                $var = trim(preg_replace( '/[^0-9]/', '', $var ));
                return (int) $var;
                break;
        }

        return null;
    }
}