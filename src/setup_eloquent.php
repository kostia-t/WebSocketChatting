<?php 

use \Illuminate\Database\Capsule\Manager as Capsule;
use \Illuminate\Events\Dispatcher;
use \Illuminate\Container\Container;

$container = new Container;
$capsule = new Capsule;

$capsule->addConnection([
	'driver' => 'mysql',
	'host' => 'localhost',
	'database' => 'php_chat', 
	'username' => 'root', 
	'password' => '', 
	'charset' => 'utf8', 
	'collation' => 'utf8_unicode_ci', 
	'prefix' => '' 
]);

$capsule->setEventDispatcher(new Dispatcher($container));
$capsule->setAsGlobal();
$capsule->bootEloquent();
