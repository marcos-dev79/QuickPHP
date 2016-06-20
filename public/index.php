<?php
/**
 * NOLX proudly presents ...
 */
session_start();

include('../App/Config/AppConf.php');
use Respect\Rest\Router;
use Library\Security\Protector;

$r3 = new Router;
$r3->isAutoDispatched = false;

//https://www.youtube.com/watch?v=tkTHAy4ufn0
if(!Protector::isAllowedOrLogged($config['url'], $protectedList)) {
    $r3->any($config['url'], 'Controllers\Pages\Errors\NoAccess', $config);
}

// Static Pages
if($config['url'] == '/'){
    $r3->get('/', 'Controllers\Pages\Home', $config);
}elseif($config['url'] == '/contact'){
    $r3->any('/contact', 'Controllers\Pages\Contact', $config);
}elseif($config['url'] == '/404'){
    $r3->get('/404', 'Controllers\Pages\P404', $config);
}elseif($config['url'] == '/login'){
    $r3->any('/login', 'Controllers\Pages\Login', $config);
}elseif($config['url'] == '/admin'){
    $r3->get('/admin', 'Controllers\Pages\Admin', $config);
}elseif($config['url'] == '/img_type_error'){
    $r3->get('/img_type_error', 'Controllers\Pages\Errors\ImgTypeError', $config);
}elseif($config['url'] == '/logout'){
    $r3->get('/logout', 'Controllers\Pages\Logout', $config);
}

// CRUD Routes
if(!in_array($config['url'], $static)) {
    if(strpos($config['url'], 'insert')){
        // Forms Insert
        $r3->any($config['url'], 'Controllers\Crud\Insert', $config);
    }
    elseif(strpos($config['url'], 'listing')){
        // Lists
        $r3->any($config['url'], 'Controllers\Crud\Listing', $config);
    }
    elseif(strpos($config['url'], 'editing')){
        // Editing
        $urlObj = explode("/", $config['url']);
        $config['id'] = $urlObj[3];
        $r3->any('/'.$urlObj[1].'/'.$urlObj[2].'/*', 'Controllers\Crud\Editing', $config);
    }
    elseif(strpos($config['url'], 'deleting')){
        // Editing
        $urlObj = explode("/", $config['url']);
        $config['id'] = $urlObj[3];
        $r3->any('/'.$urlObj[1].'/'.$urlObj[2].'/*', 'Controllers\Crud\Deleting', $config);
    }else {
        // json
        $r3->any($config['url'], 'Controllers\Crud\GenericController', $config);
    }

}

$r3->run();