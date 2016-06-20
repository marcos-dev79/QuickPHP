<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19/04/16
 * Time: 16:02
 */

namespace Library\FormGenerator;
use Library\DAO\Tables;
use Models\GenericModel;
use Library\Security\Protector;
use eTraits;

class Maker
{
    use eTraits\Response;
    /**
     * MySQL Field Comment CONFIG JSON EXAMPLE
     * {
     *  "display_name":"Criado em",
     *  "required":"false",
     *  "mask":"false",
     *  "class":"datepicker",
     *  "DOM":"input",
     *  "readonly":"true",
     *  "link_fk":"type"
     *  }
     */
    public function generateInsertForm($table, $tableObj, $blade, $dbname){
        $html = [];
        $info = new \stdClass();
        $fk = [];
        $tableObj['action'] = 'insert';
        foreach($tableObj['fields'] as $field){
            $info = json_decode($field->Comment);
            if($info == null){
                $msg = 'Malformed mysql json comment or it is missing.';
                echo $blade->view()->make('Pages/error')->with('table', $table)->with('msg', $msg)->render();
                exit;
            }

            if($field->Field == 'id' || $field->Field == 'created_at' || $field->Field == 'updated_at' || $field->Field == 'deleted_at'){
                continue;
            }

            if(!isset($info->class)){
                $info->class = '';
            }
            if(!isset($info->readonly) or $info->readonly == 'false'){
                $info->readonly = false;
            }
            if(!isset($info->mask)){
                $info->mask = '';
            }
            if(!isset($info->required) or $info->required == 'false'){
                $info->required = false;
            }

            if(isset($info->link_fk) && $info->link_fk != ''){
                $link = new GenericModel();
                $link->setTable($info->link_fk);
                $fk = $link::all();
                $fk->details = Tables::getTableDetails($tableObj, $info->link_fk);
            }

            $html[] = $blade->view()->make('Components/'.$info->DOM)->with('tableObj',$tableObj)->with('info',$info)->with('link',$fk)->with('field',$field)->render();
        }
        $user = Protector::getUser();
        $tableObj['table_detail'] = Tables::getTableDetails($tableObj, $table);
        return $blade->view()->make('Crud/form')->with('html', $html)->with('user', $user)->with('tableObj',$tableObj)->with('table', $table)->render();
    }

    /**
     *
     */
    public function generateEditionForm($table, $tableObj, $blade, $dbname, $id){
        $html = [];
        $info = new \stdClass();
        $fk = [];

        $dataObj = new GenericModel();
        $dataObj->setTable($table);
        $queryObj = $dataObj::find($id);
        $tableObj['action'] = 'editing';

        foreach($tableObj['fields'] as $field){
            $info = json_decode($field->Comment);
            if($info == null){
                $msg = 'Malformed mysql json comment or it is missing.';
                echo $blade->view()->make('Pages/error')->with('table', $table)->with('msg', $msg)->render();
                exit;
            }

            if($field->Field == 'id' || $field->Field == 'created_at' || $field->Field == 'updated_at' || $field->Field == 'deleted_at'){
                continue;
            }

            if(!isset($info->class)){
                $info->class = '';
            }
            if(!isset($info->readonly) or $info->readonly == 'false'){
                $info->readonly = false;
            }
            if(!isset($info->mask)){
                $info->mask = '';
            }
            if(!isset($info->required) or $info->required == 'false'){
                $info->required = false;
            }

            if(isset($info->link_fk) && $info->link_fk != ''){
                $link = new GenericModel();
                $link->setTable($info->link_fk);
                $fk = $link::all();
                $fk->details = Tables::getTableDetails($tableObj, $info->link_fk);
            }

            $html[] = $blade->view()->make('Components/'.$info->DOM)->with('tableObj',$tableObj)->with('info',$info)->with('queryObj',$queryObj)->with('link',$fk)->with('field',$field)->render();
        }

        $tableObj['id'] = $id;
        $tableObj['table_detail'] = Tables::getTableDetails($tableObj, $table);
        $user = Protector::getUser();
        return $blade->view()->make('Crud/form')->with('html', $html)->with('user', $user)->with('tableObj',$tableObj)->with('table', $table)->render();
    }
}