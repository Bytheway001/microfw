<?php 
require '../core/init.php';
require "../vendor/autoload.php";

use PHPRouter\RouteCollection;
use PHPRouter\Router;
use PHPRouter\Route;
use PHPRouter\Config;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable("../");
$dotenv->load();
$config = Config::loadFromFile(PROJECTPATH.'/config/routes.yaml');
$router = Router::parseConfig($config);

ActiveRecord\Config::initialize(function($cfg)
{
	$cfg->set_model_directory(PROJECTPATH.'/App/Models');
	$cfg->set_connections(array(
	'development' => 'mysql://'.$_ENV['DATABASE_USER'].':'.$_ENV['DATABASE_PASSWORD'].'@'.$_ENV['DATABASE_HOST'].'/'.$_ENV['DATABASE_NAME'].';charset=utf8'));
});


if(DEBUG==false){
	try{
		$router->matchCurrentRequest();
	}
	catch(Exception $e){
		die($e->getMessage());
	}
}
else{
	$whoops = new \Whoops\Run;
	$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
	$whoops->register();
	$router->matchCurrentRequest();
}


