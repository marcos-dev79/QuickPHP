<?php
/**
 * User: root
 * Date: 15/04/16
 * Time: 11:01
 */

namespace Controllers\Crud;
use Respect\Rest\Routable;
use Models\GenericModel;
use Library\DAO\Tables;
use eTraits;
use Illuminate\Database\Query\Expression as rawExpression;
use \Illuminate\Pagination;
use Illuminate\Database\Capsule\Manager as DB;

class GenericController implements Routable {
    use eTraits\Response;

    private $blade;
    private $url;

    public function __construct($url, $blade, $request, $options, $id = null){
        $this->blade = $blade;
        $this->url = $url;
        $this->dbname = $options['dbname'];
        $this->crud = $options['crud'];
        $this->id = $id;
    }

    public function get( ) {
        try {
            if(!$table = Tables::checkIsTable($this->url)){
                throw new \Exception("404");
            }

            $tableObj = Tables::describeTable($table, $this->dbname);

            $select = [];
            $fk = [];
            $u = [];
            $h = [];
            $ah = [];

            foreach($tableObj['fields'] as $field){
                $info = json_decode($field->Comment);

                if(isset($info->list) && $info->list == 'true'){
                    if(isset($info->link_fk)){
                        $tbl_link = Tables::getTableDetails($tableObj, $info->link_fk);
                        $select[] = $info->link_fk . '.' . $tbl_link->display_fk . ' as '.$info->link_fk.'_'.$tbl_link->display_fk;
                    }else {
                        $select[] = $table . '.' . $field->Field;
                    }
                    $h[] = $info->display_name;
                }
                if(isset($info->link_fk)){
                    $fk[] = $info->link_fk;
                }
                $ah[] = $info->display_name;
            }

            if(count($select)==0){
                $select[] = '*';
            }

            $modelObj = new GenericModel();
            $modelObj->setTable($table);
            $query = $modelObj::orderby($table.'.id', 'desc');

            foreach($fk as $f){
                $query->leftJoin($f, $table.'.'.$f, '=', $f.'.id');
            }

            $page = (isset($_GET['page']) ? $this->sanitize($_GET['page'], 'int') : 1);
            Pagination\LengthAwarePaginator::currentPathResolver(function() use($page, $table) { return "/".$table; });
            Pagination\LengthAwarePaginator::currentPageResolver(function() use($page) { return $page; });

            $u_ob = $query->paginate(15, $select);
            $u['collection'] = $u_ob->getCollection();
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

            $this->json($u);
        }catch(\Exception $e){
            $this->r404();
        }
    }

    public function post( ) {

    }
}