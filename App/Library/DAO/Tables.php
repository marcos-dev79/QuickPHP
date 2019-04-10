<?php
/**
 * User: root
 * Date: 15/04/16
 * Time: 10:43
 */

namespace Library\DAO;
use Illuminate\Database\Capsule\Manager as DB;
use Models\GenericModel;
use Predis\Client;

use Library\Security\Protector;

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

        /**
     * @method describeTable
     * @author mriso_dev
     * This method returns a descritive object from the given table, also all the DB information needed.
     */
    public static function describeTable($table, $database = 'quickphp'){
        $table_fields = self::getTableFields($table);
        $table_fks = DB::select('SHOW INDEXES IN '.$table);
        $table_details = DB::select("select * from information_schema.tables where table_schema = '".$database."'");
        $table_obj = ['fields' => $table_fields, 'indexes' => $table_fks, 'table_details' => $table_details];

        return $table_obj;
    }

    /**
     * @method CleanTableObj
     * @author mriso_dev
     * This method returns a descritive object from the given table, with the comments decoded.
     */ 
    public static function CleanTableObj($table, $database = 'quickphp') {
        $table_fields = self::getTableFields($table);
        $json = '';
        $newArr = [];
        foreach($table_fields as $tbl) {
            $json = json_decode($tbl->Comment);
            $tbl->Comment = $json;
            $newArr[] = $tbl;
        }

        return $newArr;
    }

    
    /**
     * @method TableFieldsForSelect2
     * @author mriso_dev
     * This method returns a descritive object from the given table for the SELECT 2 component
     */ 
    public static function TableFieldsForSelect2($table, $database = 'quickphp') {
        $table_fields = self::getTableFields($table);
        $json = '';
        $newArr = [];
        foreach($table_fields as $tbl) {
            $json = json_decode($tbl->Comment);
            $tbl->Comment = $json;
            $newArr[] = ['id'=>$tbl->Field, 'text'=>$tbl->Comment->display_name];
        }

        return array_values($newArr);
    }

    private static function getTableFields($table){
        return DB::select('SHOW FULL COLUMNS IN '.$table);
    }

    /**
     * @method getAllTablesInfo
     * @author mriso_dev
     * This method returns all the tables info
     */
    public static function getAllTablesInfo($database = 'quickphp'){
        $tables_details = DB::select("select * from information_schema.tables where table_schema = '".$database."'");
        return $tables_details;
    }

    public static function sortTablesByRows($dbname) {
        $tableObj = Tables::getAllTablesInfo($dbname);
        

        $arr = [];
        $i = 0;
        foreach($tableObj as $tbl) {
            if($tbl->TABLE_NAME != 'type' && $tbl->TABLE_NAME != 'menu'  && $tbl->TABLE_NAME != 'log') {
                $tbl->TABLE_COMMENT = json_decode($tbl->TABLE_COMMENT);

                $count = DB::select("select count(*) as count from ". $tbl->TABLE_NAME ." where deleted_at is null");
                $tbl->count = $count[0]->count;

                $arr[] = $tbl;
                $i++;
            }
            if($i>3) {
                break;
            }
        }

        usort($arr, "self::compare_func");
        return $arr;
    }

    private static function compare_func($a, $b)
    {
        if ($a->count == $b->count) {
            return 0;
        }
        return ($a->count > $b->count) ? -1 : 1;
        // You can apply your own sorting logic here.
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

    public static function getLinkObjects($link){
        $obj = new GenericModel();
        $obj->setTable($link);
        $query = $obj::all();

        return $query;
    }

    public static function getTableDetails($tableObj, $table){
        $tblDetail = new \stdClass();
        $tblDetail->TABLE_COMMENT = null;
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

    public static function getTablesWithDetail($database = 'quickphp'){
        $tableObj = self::getAllTablesInfo($database);
        $arr = [];
        foreach ($tableObj as $tbl) {
            $tblinfo = json_decode($tbl->TABLE_COMMENT);
            $arr[] = ['tblname'=>$tbl, 'tblinfo'=>$tblinfo];
        }
        return $arr;
    }

    public static function insertLog($operation, $id, $tableObj, $table = null) {
        
        $user = Protector::getUser();
        $msg = $user['name'];

        switch($operation) {
            case 'insert':
                $msg .= ' inserted '. $table->display_name . ' ' . $tableObj->display_name . ' record id('.$id.')';
                break;
            case 'update':
                $msg .= ' updated '. $table->display_name . ' ' . $tableObj->display_name . ' record id('.$id.')';
                break;
            case 'delete':
                $msg .= ' deleted '. $table->display_name . ' ' . $tableObj->display_name . ' record id('.$id.')';
                break;
            default:
                $msg .= ' performed unknown operation.';
                break;
        }


        $obj = new GenericModel();
        $obj->setTable('log');

        $obj->log = $msg;
        $obj->user = $user['id'];
        $obj->table = $table;
        $obj->active = 1;
        $obj->recordid = $id;
        $obj->save();
    }

}