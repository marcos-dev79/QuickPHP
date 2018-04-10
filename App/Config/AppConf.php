<?php
/**
 * Basic Config File
 */

include('vendor/autoload.php');
include_once 'Database.php';

use Philo\Blade\Blade;

$views = 'App/Views';
$cache = 'App/Cache';

$config = [];
$config['url'] = isset($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] : '/';
$config['blade'] = new Blade($views, $cache);
$config[] = $_REQUEST;

$protectedList = ['/admin', '/listing', '/insert', '/deleting', '/editing'];

$static = ['/', '/logout', '/remove', '/404', 'servicos_pages/*', '/login', '/recuperaSenha', '/admin'];

$config['options']['crud'] = ['users'];
$config['options']['dbname'] = 'quickphp';

$status = false;

// Encryptor
$config['options']['encryption'] = 'RqOWSFLRxMgzmK37TbSjTjEUtGfSDN78XAFw9gBgghI=';
$config['options']['macKey'] = 'UomISgztmcuj6BD3jvzbArEPHoNy79qqQPA/DUGuQSo=';