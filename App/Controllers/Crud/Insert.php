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
use Library\Dates\Dates;
use Library\Security\Protector;
use eTraits;

class Insert implements Routable {
    use eTraits\Response;

    private $blade;
    private $url;

    public function __construct($url, $blade, $request, $options, $id = null){
        $this->blade = $blade;
        $this->url = $url;
        $this->dbname = $options['dbname'];
        $this->installtype = $options['installtype'];
        $this->crud = $options['crud'];
        $this->id = $id;
    }

    public function get( ) {
        try {
            if(!$table = Tables::checkIsTable($this->url)){
                throw new \Exception("404");
            }
            $tableObj = Tables::describeTable($table, $this->dbname);
            $make = new Maker();
            $form = $make->generateInsertForm($table, $tableObj, $this->blade, $this->dbname);
            echo $form;
        }catch(\Exception $e){
            $this->r404();
        }
    }

    public function post(){
        $data = $_POST;
        if(!$table = Tables::checkIsTable($this->url)){
            throw new \Exception("404");
        }
        $tableObj = Tables::describeTable($table, $this->dbname);
        $model = new GenericModel();
        $model->setTable($table);
        foreach($tableObj['fields'] as $field){
            if(isset($data[$field->Field]) || isset($_FILES[$field->Field])){
                $info = json_decode($field->Comment);

                // IF UPLOAD
                if($info->DOM == 'upload'){
                    foreach($_FILES as $file){
                        if($file['name'] != '') {
                            if (isset($info->upload_type) && $info->upload_type == $file['type']) {
                                $filename = substr($file['name'], 0, -4);
                                $newfilename = substr(base64_encode(str_shuffle($filename)), 0, 16);
                                //$extension = substr($file['name'], -3,3);
                                switch ($info->upload_type) {
                                    case 'image/jpeg':
                                        $newfilename = $newfilename . '.jpg';
                                        
                                        $uploaddir = 'Uploads/' . $table . '/';
                                        if($this->installtype = 'rootindex') {
                                            $uploaddir = 'public/Uploads/' . $table . '/';
                                        }

                                        try {
                                            if (move_uploaded_file($file['tmp_name'], $uploaddir . $newfilename)) {
                                                $model->{$field->Field} = $uploaddir . $newfilename;
                                            }
                                        }catch(Exception $e) {
                                            $err[] = $e->getMessage();
                                        }
                                        break;
                                    default:
                                        $this->redirect('img_type_error');
                                        break;
                                }
                            }else{
                                $this->redirect('img_type_error');
                            }
                        }
                    }
                }else if($info->DOM == 'password'){
                    $model->{$field->Field} = Protector::genhash($data[$field->Field]);
                }
                else if(isset($info->class) && $info->class == 'datepicker'){
                    $model->{$field->Field} = Dates::unDateBR($data[$field->Field]);
                }else {
                    $model->{$field->Field} = $data[$field->Field];
                }
            }
        }

        $model->save();
        $tablel = Tables::getTableDetails($tableObj, $table);
        Tables::insertLog('insert', $model->id, $tablel, $table);

        $this->redirect('listing/'.$table);
    }

}