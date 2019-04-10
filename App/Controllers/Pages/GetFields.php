<?php
/**
 * User: root
 * Date: 15/04/16
 * Time: 10:12
 */
namespace Controllers\Pages;
use Library\Security\Protector;
use Illuminate\Database\Capsule\Manager as DB;
use Library\DAO\Tables;
use Models\GenericModel;
use Respect\Rest\Routable;
use eTraits;

class GetFields implements Routable {
    use eTraits\Response;

    public function __construct($url, $blade, $request, $options, $id = null){
        $this->blade = $blade;
        $this->url = $url;
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
        
        $tables = Tables::TableFieldsForSelect2($data['table'], $this->dbname);

        $t = array_values($tables);
        $this->jsonNoEnforce($t);
    }

    public function put ( ) {

    }
}