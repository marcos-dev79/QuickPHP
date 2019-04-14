<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19/04/16
 * Time: 13:58
 */

namespace Controllers\Crud;
use Library\FormGenerator\Maker;
use Library\Security\Protector;
use Respect\Rest\Routable;
use Models\GenericModel;
use Library\DAO\Tables;
use Library\Dates\Dates;
use eTraits;

class Editing implements Routable {
    use eTraits\Response;

    private $blade;
    private $url;

    public function __construct($url, $blade, $request, $options, $id){
        $url = explode("/", $url);
        $url = '/'.$url[1].'/'.$url[2];

        $this->blade = $blade;
        $this->url = $url;
        $this->dbname = $options['dbname'];
        $this->installtype = $options['installtype'];
        $this->crud = $options['crud'];
        $this->id = $id;
        $this->lang = $_SESSION['lang'];
    }

    public function get( ) {
        try {
            if(!$table = Tables::checkIsTable($this->url)){
                throw new \Exception("404");
            }
            $tableObj = Tables::describeTable($table, $this->dbname);
            $make = new Maker();
            $form = $make->generateEditionForm($table, $tableObj, $this->blade, $this->dbname, $this->id);
            echo $form;
        }catch(\Exception $e){
            $this->r404();
        }
    }

    public function post(){
        $data = $_POST;
        $err = [];
        if(!$table = Tables::checkIsTable($this->url)){
            throw new \Exception("404");
        }
        $tableObj = Tables::describeTable($table, $this->dbname);
        $model = new GenericModel();
        $model->setTable($table);
        $query = $model->find($data['id']);
        foreach($tableObj['fields'] as $field){
            $info = json_decode($field->Comment);
            if(isset($data[$field->Field]) || isset($_FILES[$field->Field])){
                // IF UPLOAD
                if($info->DOM == 'upload'){
                    foreach($_FILES as $file){
                        if($file['name'] != '') {
                            if($query->{$field->Field} != ''){
                                try {
                                    @unlink('./'.$query->{$field->Field});
                                }catch(Exception $e) {
                                    $err[] = $e->getMessage();
                                }
                            }

                            $imgUploader = new \Library\Images\ImgUploader();

                            if (isset($info->upload_type) && $info->upload_type == $file['type']) {
                                $imgUploader->uploadImg($file, $query, $err, $this->installtype, $info->upload_type, $table, $field);
                            }
                            else {
                                $imgUploader->uploadImg($file, $query, $err, $this->installtype, $file['type'], $table, $field);
                            }

                        }
                    }
                }else if($info->DOM == 'password'){
                    if($data[$field->Field] != ''){
                        $query->{$field->Field} = Protector::genhash($data[$field->Field]);
                    }
                }
                else if(isset($info->class) && $info->class == 'datepicker'){
                    $query->{$field->Field} = Dates::unDateBR($data[$field->Field]);
                }
                else {
                    $query->{$field->Field} = $data[$field->Field];
                }
            }else{
                // If data is empty, set the checkbox as false (no checked)
                if($info->DOM == 'checkbox'){
                    $query->{$field->Field} = 0;
                }
            }
        }

        $query->save();
        $tablel = Tables::getTableDetails($tableObj, $table);
        Tables::insertLog('update', $data['id'], $tablel, $table);

        $this->redirect('listing/'.$table);
    }

}