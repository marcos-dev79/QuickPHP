<?php
/**
 * User: root
 * Date: 15/04/16
 * Time: 10:12
 */
namespace Controllers\Pages;
use Library\Security\Protector;
use Illuminate\Database\Capsule\Manager as DB;
use Library\Dates\Dates;
use Library\DAO\Tables;
use Models\GenericModel;
use Controllers\Crud\GenericController;
use Respect\Rest\Routable;
use eTraits;

class ProcessReport implements Routable {
    use eTraits\Response;

    public function __construct($url, $blade, $request, $options, $id = null){
        $this->blade = $blade;
        $this->url = $url;
        $this->request = $request;
        $this->options = $options;
        $this->dbname = $options['dbname'];
        $this->installtype = $options['installtype'];
        $this->crud = $options['crud'];
        $this->id = $id;
    }

    public function get( ) {
        $u = ['status' => 'there is nothing here'];
        $this->json($u);
    }

    public function post( ) {
        $data = $_POST;

        $user = Protector::getUser();
        $url = '/'.$data['tableslc'];
        $c = new GenericController($url, $this->blade, $this->request, $this->options);
        $ret = $c->get($data['startdate'], $data['enddate'], $data['fieldsslc'], true);
        
        $tableObj = Tables::CleanTableObj($data['tableslc'], $this->dbname);


        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=data.csv');
        echo "\xEF\xBB\xBF"; 

        $output = fopen('php://output', 'w');
        fputcsv($output, $ret['headers']);



        foreach($ret['collection'] as $i => $r) {
            $arr = [];
            $tval = null;
            foreach($data['fieldsslc'] as $d) {
                $tval = $r->{$d};
                foreach($tableObj as $tb){
                    if($tb->Field == $d && $tb->Type == 'timestamp') {
                        $tval = Dates::DateBR($tval);
                    }
                }
                $arr[] = trim((string)$tval);
            }
            fputcsv($output, $arr);
        }

        

    }

    public function put ( ) {

    }
}