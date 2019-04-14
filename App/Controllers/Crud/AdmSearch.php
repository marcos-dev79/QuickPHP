<?php
/**
 * User: root
 * Date: 19/04/16
 * Time: 13:58
 */

namespace Controllers\Crud;
use Respect\Rest\Routable;
use Models\GenericModel;
use Library\DAO\Tables;
use eTraits;
use Illuminate\Database\Query\Expression as rawExpression;
use \Illuminate\Pagination;
use Illuminate\Database\Capsule\Manager as DB;
use Library\Dates\Dates;
use Library\Security\Protector;

class AdmSearch implements Routable {
    use eTraits\Response;

    private $blade;
    private $url;

    public function __construct($url, $blade, $request, $options, $id = null){
        $this->blade = $blade;
        $this->url = $url;
        $this->dbname = $options['dbname'];
        $this->crud = $options['crud'];
        $this->id = $id;
        $this->lang = $_SESSION['lang'];
    }


    public function get( ) {
            $this->r404();
    }

    public function post(){
        $table = $this->sanitize($_POST['table']);

        // Limpa os filtros ao mudar de tabela
        if(isset($_SESSION['table'])){
            if($_SESSION['table'] != $table){
                unset($_SESSION['filters']);
            }
        }else{
            $_SESSION['table'] = $table;
        }


        $tableObj = Tables::describeTable($table, $this->dbname);

        $select = [];
        $fk = [];
        $u = [];
        $h = [];
        $ah = [];

        $pagination = true;
        if(isset($_REQUEST['pagination'])) {
            $pagination = ($_REQUEST['pagination'] == 1) ? true : false;
        }

        $iter = 1;
        foreach($tableObj['fields'] as $field){
            $info = json_decode($field->Comment);

            if(isset($info->list) && $info->list == 'true'){
                if(isset($info->link_fk)){
                    $tbl_link = Tables::getTableDetails($tableObj, $info->link_fk);
                    $select[] = $info->link_fk .'_'.$iter . '.' . $tbl_link->display_fk . ' as '.$field->Field;
                    $select[] = $info->link_fk .'_'.$iter . '.id as '.$field->Field.'_id';
                    $iter++;
                }else {
                    $select[] = $table . '.' . $field->Field;
                }
                $h[] = $info->display_name;
            }
            if(isset($info->link_fk)){
                $fk[$field->Field] = $info->link_fk;
            }
            $ah[] = $info->display_name;
        }

        if(count($select)==0){
            $select[] = '*';
        }

        $modelObj = new GenericModel();
        $modelObj->setTable($table);
        $query = $modelObj::orderby($table.'.id', 'desc');

        $iter = 1;
        foreach($fk as $key => $f){
            $query->leftJoin($f.' as '.$f.'_'.$iter, $table.'.'.$key, '=', $f.'_'.$iter.'.id');
            $iter++;
        }

        $filter = [];

        if(isset($_SESSION['filters']) && $_SESSION['filters'] != null){
            foreach($_SESSION['filters'] as $key => $filt){
                if(isset($_POST[$key])){
                    $_SESSION['filters'][$key] = $_POST[$key];
                }
                else {
                    $_POST[$key] = $filt;
                }
            }
        }elseif(isset($_SESSION['filters']) && $_SESSION['filters'] == null){
            unset($_SESSION['filters']);
        }

        foreach($_POST as $k => $v) {
            if($k != 'table' && $v != '' && $k != 'pagination' && $k != 'page' && $k != 'search') {
                if($v == 'Nenhum' || $v == ''){
                    continue;
                }

                if($k == 'created_at' || $k == 'updated_at'){
                    $v = Dates::unDateBR($v);
                    $query->whereBetween($table.'.'.$k, array($v.' 00:00:00', $v.' 23:59:59'));
                }elseif($k == 'users'){
                    $query->where($table.'.'.$k, $v);
                }
                else {
                    $query->whereRaw('LOWER('.$table.'.'.$k.') LIKE \'%'.strtolower($v).'%\'');
                }
                $filter[$k] = $v;
            }
        }

        $_SESSION['filters'] = (count($filter)>0)? $filter : null;

        //$pagination = true;
        if($pagination) {
            $page = (isset($_GET['page']) ? $this->sanitize($_GET['page'], 'int') : 1);
            Pagination\LengthAwarePaginator::currentPathResolver(function () use ($page, $table) {
                return "/" . $table;
            });
            Pagination\LengthAwarePaginator::currentPageResolver(function () use ($page) {
                return $page;
            });

            $u_ob = $query->where($table . '.deleted_at', null)->paginate(10, $select);
            $u['collection'] = $u_ob->getCollection();
        }else{
            $u_ob = $query->where($table . '.deleted_at', null)->select($select)->get();
            $u['collection'] = $u_ob;
        }

        $u['fieldsObj'] = Tables::fieldListAdaptor($tableObj['fields']);

        $currTableDetail = Tables::getTableDetails($tableObj, $table);
        if(isset($currTableDetail->link_n) && count($currTableDetail->link_n)>0){

            foreach($currTableDetail->link_n as $link_n){
                $tbl_link_n = Tables::getTableDetails($tableObj, $link_n);
                $h[] = $tbl_link_n->display_name;

                foreach($u['collection'] as $items){
                    $main_id = $items->id;
                    $modelObj = new GenericModel();
                    $modelObj->setTable($table.'_'.$link_n);
                    $query_n = $modelObj::where($table, $main_id)
                        ->orderby($table.'_'.$link_n.'.id', 'asc')
                        ->leftJoin($link_n, $link_n, '=', $link_n.'.id')
                        ->select($link_n.'.id', $tbl_link_n->display_fk . ' as display_field')->get();
                    /*$string = [];
                    foreach($query_n as $q){
                        $string[] = $q->{$tbl_link_n->display_fk} . ' (id: '.$q->id.')';
                    }
                    $string = implode(', ', $string);*/
                    $items->{$link_n} = $query_n;
                }
            }
        }

        $u['links'] = $u_ob;
        $u['headers'] = count($h)>0 ? $h : $ah;
        $u['colspan'] = count($h) +1;

        $result = json_encode($u, JSON_FORCE_OBJECT);
        $user = Protector::getUser();
        $tableObj = Tables::describeTable($table, $this->dbname);
        $tbldetails = Tables::getTableDetails($tableObj, $table);


        echo $this->blade->view()->make('Crud/admsearchresult')
            ->with('table', $table)
            ->with('u', $result)
            ->with('filter', $filter)
            ->with('tableObj', $tableObj)
            ->with('user', $user)
            ->with('tbldetails', $tbldetails)
            ->with('lang', $this->lang)
            ->render();

    }

}