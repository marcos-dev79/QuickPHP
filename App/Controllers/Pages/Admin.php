<?php
/**
 * User: root
 * Date: 15/04/16
 * Time: 10:12
 */
namespace Controllers\Pages;
use Library\Security\Protector;
use Respect\Rest\Routable;

class Admin implements Routable {

    public function __construct($url, $blade){
        $this->blade = $blade;
    }

    public function get( ) {
        $user = Protector::getUser();
        echo $this->blade->view()->make('Admin/dashboard')->with('user', $user)->render();
    }

    public function post( ) {
        echo 'post';
    }

    public function put ( ) {

    }
}