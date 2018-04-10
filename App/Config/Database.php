<?php
/**
 * Database Config
 */

use Illuminate\Database\Capsule\Manager as Capsule;


$capsule = new Capsule;
$env = 'dev';

if($env == 'dev') {
    $capsule->addConnection(array(
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'database'  => 'agriaofilmes',
        'username'  => 'root',
        'password'  => 'zimbros',
        'charset'   => 'utf8',
        'collation' => 'utf8_bin',
        'prefix'    => ''
    ));
}
elseif($env == 'prod'){
    $capsule->addConnection(array(
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'database'  => 'nolx',
        'username'  => '',
        'password'  => '',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => ''
    ));
}

$capsule->setAsGlobal();
$capsule->bootEloquent();