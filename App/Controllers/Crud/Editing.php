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
        $this->crud = $options['crud'];
        $this->id = $id;
    }

    public function get( ) {
        try {
            if(!$table = Tables::checkIsTable($this->url)){
                throw new \Exception("404");
            }
            $tableObj = Tables::describeTable($table);
            $make = new Maker();
            $form = $make->generateEditionForm($table, $tableObj, $this->blade, $this->dbname, $this->id);
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
        $tableObj = Tables::describeTable($table);
        $model = new GenericModel();
        $model->setTable($table);
        $query = $model->find($data['id']);
        foreach($tableObj['fields'] as $field){
            if(isset($data[$field->Field]) || isset($_FILES[$field->Field])){

                $info = json_decode($field->Comment);
                // IF UPLOAD
                if($info->DOM == 'upload'){
                    foreach($_FILES as $file){
                        if($file['name'] != '') {
                            if($query->{$field->Field} != ''){
                                unlink('./'.$query->{$field->Field});
                            }
                            if (isset($info->upload_type) && $info->upload_type == $file['type']) {
                                $filename = substr($file['name'], 0, -4);
                                $newfilename = substr(base64_encode(str_shuffle($filename)), 0, 16);
                                //$extension = substr($file['name'], -3,3);
                                switch ($info->upload_type) {
                                    case 'image/jpeg':
                                        $newfilename = $newfilename . '.jpg';
                                        $uploaddir = 'Uploads/' . $table . '/';
                                        if (move_uploaded_file($file['tmp_name'], $uploaddir . $newfilename)) {
                                            $query->{$field->Field} = $uploaddir . $newfilename;
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
                    $query->{$field->Field} = Protector::genhash($data[$field->Field]);
                }
                else {
                    $query->{$field->Field} = $data[$field->Field];
                }
            }
        }
        $query->save();
        $this->redirect('listing/'.$table);
    }

}