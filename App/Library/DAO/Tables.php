<?php
/**
 * User: root
 * Date: 15/04/16
 * Time: 10:43
 */

namespace Library\DAO;
use Illuminate\Database\Capsule\Manager as DB;
use Predis\Client;

class Tables
{
    public static function getTables(){
        $tables = DB::select('SHOW TABLES');
        $ret = [];
        foreach($tables as $t){
            foreach($t as $k => $v){
                $ret[] = $v;
            }
        }
        return $ret;
    }

    public static function describeTable($table, $database = 'nolx'){
        $table_fields = DB::select('SHOW FULL COLUMNS IN '.$table);
        $table_fks = DB::select('SHOW INDEXES IN '.$table);
        $table_details = DB::select("select * from information_schema.tables where table_schema = '".$database."'");
        $table_obj = ['fields' => $table_fields, 'indexes' => $table_fks, 'table_details' => $table_details];
        return $table_obj;
    }

    public static function checkIsTable($url){
        $tables = self::getTables();
        $table = explode("/", $url);
        $table = $table[count($table) - 1];
        if(in_array($table, $tables)){
            return $table;
        }
        return false;
    }

    public static function fieldListAdaptor($fields){
        $tFields = [];
        foreach($fields as $f){
            $info = json_decode($f->Comment);
            $tFields[$f->Field] = $info;
        }
        return $tFields;
    }

    public static function getTableDetails($tableObj, $table){
        $tblDetail = new \stdClass();
        foreach($tableObj['table_details'] as $tbl){
            if($tbl->TABLE_NAME == $table){
                $tblDetail = $tbl;
            }
        }
        $tblinfo = json_decode($tblDetail->TABLE_COMMENT);
        return $tblinfo;
    }

    public static function getFieldObj($tableObj, $sel_field){
        foreach($tableObj['fields'] as $field) {
            if($field->Field == $sel_field) {
                return json_decode($field->Comment);
            }
        }
    }

}