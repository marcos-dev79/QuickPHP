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
use Library\Security\Protector;
use eTraits;

class Listing implements Routable {
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
        $user = Protector::getUser();
        try {
            if(!$table = Tables::checkIsTable($this->url)){
                throw new \Exception("404");
            }

            $tableObj = Tables::describeTable($table, $this->dbname);
            $tbldetails = Tables::getTableDetails($tableObj, $table);
            echo $this->blade->view()->make('Crud/listing')
                ->with('table', $table)
                ->with('tableObj', $tableObj)
                ->with('user', $user)
                ->with('lang', $this->lang)
                ->with('tbldetails', $tbldetails)
                ->render();
        }catch(\Exception $e){
            $this->r404();
        }

    }

    public function post(){

    }

}