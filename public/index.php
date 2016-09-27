<?php
/**
 * QuickPHP by @mriso_dev
 */
session_start();

include('../App/Config/AppConf.php');

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
if($config['url'] == '/'){
    $r3->get('/', 'Controllers\Pages\Home', $config);
}
elseif($config['url'] == '/contato'){
    $r3->any('/contato', 'Controllers\Pages\Contact', $config);
}
elseif($config['url'] == '/404'){
    $r3->get('/404', 'Controllers\Pages\P404', $config);
}
elseif($config['url'] == '/login'){
    $r3->any('/login', 'Controllers\Pages\Login', $config);
}
elseif($config['url'] == '/admin'){
    $r3->get('/admin', 'Controllers\Pages\Admin', $config);
}
elseif($config['url'] == '/img_type_error'){
    $r3->get('/img_type_error', 'Controllers\Pages\Errors\ImgTypeError', $config);
}
elseif($config['url'] == '/logout'){
    $r3->get('/logout', 'Controllers\Pages\Logout', $config);
}
elseif($config['url'] == '/calcula_hospedagem'){
    $r3->post('/calcula_hospedagem', 'Controllers\Hospedagem\Hospedagem', $config);
}
elseif($config['url'] == '/processa_compra'){
    $r3->post('/processa_compra', 'Controllers\Cart\Cart', $config);
}
elseif($config['url'] == '/processPayPal'){
    $r3->any('/processPayPal', 'Controllers\Cart\processPayPal', $config);
}
elseif($config['url'] == '/sucessocompra'){
    $r3->get('/sucessocompra', 'Controllers\Cart\SucessoCompra', $config);
}
elseif($config['url'] == '/cancel'){
    $r3->any('/cancel', 'Controllers\Cart\CancelaCompra', $config);
}
elseif($config['url'] == '/executeLoginWithSession'){
    $r3->post('/executeLoginWithSession', 'Controllers\Pages\PostLogin', $config);
}
elseif($config['url'] == '/cart'){
    $r3->get('/cart', 'Controllers\Cart\Cart', $config);
}
elseif($config['url'] == '/price_service'){
    $r3->get('/price_service', 'Controllers\Pages\PricesService', $config);
}
elseif($config['url'] == '/registro'){
    $r3->any('/registro', 'Controllers\Pages\Registro', $config);
}
elseif($config['url'] == '/perfil'){
    $r3->any('/perfil', 'Controllers\Pages\Perfil', $config);
}
elseif($config['url'] == '/getusersession'){
    $r3->get('/getusersession', 'Controllers\Pages\UserSessionData', $config);
}
elseif($config['url'] == '/bemvindo'){
    $r3->get('/bemvindo', 'Controllers\Pages\Bemvindo', $config);
}
elseif($config['url'] == '/remove'){
    $r3->get('/remove', 'Controllers\Cart\Remove', $config);
}
elseif($config['url'] == '/imprimeVoucher'){
    $r3->get('/imprimeVoucher', 'Controllers\Cart\imprimeVoucher', $config);
}
elseif($config['url'] == '/downloadPDF'){
    $r3->get('/downloadPDF', 'Controllers\Cart\downloadPDF', $config);
}
elseif($config['url'] == '/recuperaSenha'){
    $r3->any('/recuperaSenha', 'Controllers\Pages\Senha', $config);
}
elseif(strpos($config['url'], 'servicos_pages')){
    // Servicos Pages
    $urlObj = explode("/", $config['url']);
    $config['id'] = $urlObj[2];
    $r3->any('/'.$urlObj[1].'/*', 'Controllers\Pages\ServicosPages', $config);

    $r3->run();
    exit;
}

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