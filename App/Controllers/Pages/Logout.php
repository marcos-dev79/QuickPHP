<?php
/**
 * User: root
 * Date: 15/04/16
 * Time: 10:12
 */
namespace Controllers\Pages;
use eTraits\Response;
use Respect\Rest\Routable;

class Logout implements Routable {
    use Response;

    public function __construct($url, $blade, $request, $options){
        $this->blade = $blade;
    }

    public function get( ) {
        session_destroy();
        $this->redirect('');
    }

    public function post( ) {

    }

}