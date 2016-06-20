<?php
/**
 * User: root
 * Date: 15/04/16
 * Time: 11:43
 */

namespace eTraits;

trait Response {

    public function json($var){
        header('Content-type: application/json');
        echo json_encode($var, JSON_FORCE_OBJECT);
    }

    public function r404(){
        header('Location: /404');
    }

    public function redirect($url){
        header('Location: /'.$url);
        exit;
    }

    public function delResult($bool){
        header('Content-type: application/json');
        if($bool){
            echo json_encode(['result'=>'success']);
        }else{
            echo json_encode(['result'=>'failed']);
        }
    }

    public function sanitize($var, $type = 'string')
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
            case 'html':
                return $var;
                break;
            case 'int':
                $var = (int) $var * 1;
                return $var;
                break;
            case 'float':
                $var = str_replace('R$ ', '', $var);
                $var = str_replace('.', '', $var);
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