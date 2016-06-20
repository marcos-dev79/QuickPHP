<?php
/**
 * User: root
 * Date: 15/04/16
 * Time: 10:12
 */
namespace Controllers\Pages;
use Respect\Rest\Routable;

class Contact implements Routable {

    public function __construct($url, $blade){
        $this->blade = $blade;
    }

    public function get( ) {
        echo $this->blade->view()->make('Pages/contact')->render();
    }

    public function post( ) {
        echo 'post';
    }

    public function put ( ) {

    }
}