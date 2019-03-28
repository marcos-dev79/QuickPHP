<?php
/**
 * Basic Config File
 */

include('vendor/autoload.php');
include_once 'Database.php';

// Set your timezone here
date_default_timezone_set('America/Sao_Paulo');

use Philo\Blade\Blade;

$views = 'App/Views';
$cache = 'App/Cache';

$config = [];
$config['url'] = isset($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] : '/';
$config['blade'] = new Blade($views, $cache);
$config[] = $_REQUEST;

$protectedList = ['/admin', '/listing', '/insert', '/deleting', '/editing'];

$static = ['/', '/logout', '/remove', '/404', 'servicos_pages/*', '/login', '/recuperaSenha', '/admin', '/img_type_error'];

$config['options']['crud'] = ['users'];
$config['options']['dbname'] = 'standardqphp'; // standardqphp
$config['options']['installtype'] = 'rootindex'; // rootindex for index on the root, publicfolder for index.php on the public folder

$status = false;

// Encryptor
$config['options']['encryption'] = 'RqOWSFLRxMgzmK37TbSjTjEUtGfSDN78XAFw9gBgghI=';
$config['options']['macKey'] = 'UomISgztmcuj6BD3jvzbArEPHoNy79qqQPA/DUGuQSo=';