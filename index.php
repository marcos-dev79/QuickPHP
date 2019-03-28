<?php
/**
 * QuickPHP by @mriso_dev
 */
session_start();

include('App/Config/AppConf.php');

use Respect\Rest\Router;
use Library\Security\Protector;

$r3 = new Router;
$r3->isAutoDispatched = false;


if($status) {
    $r3->get($config['url'], 'Controllers\Pages\Maintenance', $config);
    $r3->run();
    exit;
}


if(!Protector::isAllowedOrLogged($config['url'], $protectedList)) {
    $r3->any($config['url'], 'Controllers\Pages\Errors\NoAccess', $config);
}

// Static Pages
    $r3->get('/', 'Controllers\Pages\Home', $config);
    $r3->get('/404', 'Controllers\Pages\P404', $config);
    $r3->any('/login', 'Controllers\Pages\Login', $config);
    $r3->get('/admin', 'Controllers\Pages\Admin', $config);
    $r3->get('/img_type_error', 'Controllers\Pages\Errors\ImgTypeError', $config);
    $r3->get('/logout', 'Controllers\Pages\Logout', $config);
    $r3->post('/executeLoginWithSession', 'Controllers\Pages\PostLogin', $config);
    $r3->any('/perfil', 'Controllers\Pages\Perfil', $config);
    $r3->get('/getusersession', 'Controllers\Pages\UserSessionData', $config);
    $r3->get('/bemvindo', 'Controllers\Pages\Bemvindo', $config);
    $r3->any('/recuperaSenha', 'Controllers\Pages\Senha', $config);

// CRUD Routes
if(!in_array($config['url'], $static)) {
    if(strpos($config['url'], 'insert')){
        // Forms Insert
        $r3->any($config['url'], 'Controllers\Crud\Insert', $config);
    }
    elseif(strpos($config['url'], 'admsearch')){
        // Forms Insert
        $r3->any($config['url'], 'Controllers\Crud\AdmSearch', $config);
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