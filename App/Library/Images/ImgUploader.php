<?php

namespace Library\Images;
use Library\DAO\Tables;
use Models\GenericModel;
use Library\Security\Protector;
use eTraits;

class ImgUploader
{
    use eTraits\Response;

    /**
     * Uploads the Image
     * @author @mriso_dev
     */
    public function uploadImg($file, &$model, &$err, $installtype, $uploadType, $table, $field) 
    {
        $filename = substr($file['name'], 0, -4);
        $newfilename = substr(base64_encode(str_shuffle($filename)), 0, 16);

        switch ($uploadType) {

            case 'image/jpeg':
                $newfilename = $newfilename . '.jpg';
                
                $uploaddir = 'Uploads/' . $table . '/';
                if($installtype = 'rootindex') {
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

            case 'image/png':
                $newfilename = $newfilename . '.png';
                
                $uploaddir = 'Uploads/' . $table . '/';
                if($installtype = 'rootindex') {
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
    }



}