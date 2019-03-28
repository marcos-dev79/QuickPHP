<?php
/**
 * User: root
 * Date: 15/04/16
 * Time: 10:12
 */
namespace Controllers\Pages;
use Library\Security\Protector;
use Library\DAO\Tables;
use Respect\Rest\Routable;
use eTraits;

class Admin implements Routable {
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
        $user = Protector::getUser();

       $tblObj = Tables::sortTablesByRows($this->dbname);

        echo $this->blade->view()->make('Admin/dashboard')->with('tblobj', $tblObj)->with('user', $user)->render();
    }

    public function post( ) {
        $u = ['status' => 'there is nothing here'];
        $this->json($u);
    }

    public function put ( ) {

    }
}