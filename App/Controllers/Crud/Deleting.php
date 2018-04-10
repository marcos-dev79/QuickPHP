<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19/04/16
 * Time: 13:58
 */

namespace Controllers\Crud;
use Library\FormGenerator\Maker;
use Respect\Rest\Routable;
use Models\GenericModel;
use Library\DAO\Tables;
use eTraits;

class Deleting implements Routable {
    use eTraits\Response;

    private $blade;
    private $url;

    public function __construct($url, $blade, $request, $options, $id){
        $url = explode("/", $url);
        $url = '/'.$url[1].'/'.$url[2];

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
            $tableObj = Tables::describeTable($table);
            $model = new GenericModel();
            $model->setTable($table);
            $query = $model->find($this->id);
            if($query->delete()){
                $this->delResult(true);
            }else{
                $this->delResult(false);
            }

        }catch(\Exception $e){
            $this->r404();
        }
    }

    public function post(){
        $data = $_POST;
        if(!$table = Tables::checkIsTable($this->url)){
            throw new \Exception("404");
        }
        $tableObj = Tables::describeTable($table);
        $model = new GenericModel();
        $model->setTable($table);
        $query = $model->find($data['id']);
        foreach($tableObj['fields'] as $field){
            if(isset($data[$field->Field])){
                $query->{$field->Field} = $data[$field->Field];
            }
        }
        $query->save();
        $this->redirect('listing/'.$table);
    }

}