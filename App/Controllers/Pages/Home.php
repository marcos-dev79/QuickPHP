<?php
/**
 * User: root
 * Date: 15/04/16
 * Time: 10:12
 */
namespace Controllers\Pages;
use Respect\Rest\Routable;

class Home implements Routable {

    public function __construct($url, $blade, $request, $options){
        $this->blade = $blade;
        $this->home  = $options['home'];
    }

    public function get( ) {
        echo $this->blade->view()->make('Pages/'.$this->home)->render();
    }
}