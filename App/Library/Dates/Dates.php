<?php
/**
 * Created by PhpStorm.
 * User: marcos
 * Date: 02/05/16
 * Time: 20:47
 */

namespace Library\Dates;

class Dates {

    public static function DateBRsm( $date ) {
        if($date != '') {
            return date("j/m/Y", strtotime($date));
        }
        return false;
    }

    public static function DateBR( $date ) {
        if($date != '') {
            return date("d/m/Y", strtotime($date));
        }
        return false;
    }

    public static function TimedDateBR( $date ) {
        if($date != '') {
            $current_date = date("Y-m-d");
            $informed_date =  date("Y-m-d", strtotime($date));

            if($current_date == $informed_date){
                return date("H:i", strtotime($date));
            }else{
                return date("d/m/Y", strtotime($date));
            }

        }
        return false;
    }

    public static function TextTimedDateBR( $date ) {
        if($date != '') {
            $current_date = date("d/m/Y");
            $informed_date =  date("d/m/Y", strtotime($date));

            if($current_date == $informed_date){
                return 'hoje às ' . date("H:i", strtotime($date));
            }else{
                return 'no dia ' . date("d/m/Y", strtotime($date));
            }

        }
        return false;
    }

    public static function unDateBR ( $date ) {
        if($date != '') {
            $date = explode("/", $date);
            $date = $date[2] . '-' . $date[1] . '-' . $date[0];
            return $date;
        }
        return false;
    }

    public static function sumDays($date, $plusdays, $format='db') {
        if($format == 'db')
            return date('Y-m-d', strtotime($date. ' + '.$plusdays.' days'));
        else
            return date('d-m-Y', strtotime($date. ' + '.$plusdays.' days'));
    }

    public static function translateMonth($month){
        $month = ucfirst($month);
        switch($month){
            case 'January':
                return 'Janeiro';
                break;
            case 'February':
                return 'Fevereiro';
                break;
            case 'March':
                return 'Março';
                break;
            case 'April':
                return 'Abril';
                break;
            case 'May':
                return 'Maio';
                break;
            case 'June':
                return 'Junho';
                break;
            case 'July':
                return 'Julho';
                break;
            case 'August':
                return 'Agosto';
                break;
            case 'September':
                return 'Setembro';
                break;
            case 'October':
                return 'Outubro';
                break;
            case 'November':
                return 'Novembro';
                break;
            case 'December':
                return 'Dezembro';
                break;
            default:
                return false;
        }
    }

}