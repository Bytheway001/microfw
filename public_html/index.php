<?php 
define("PROJECTPATH", dirname(__DIR__));
define("APPPATH", PROJECTPATH . '/App');
define("DEBUG",true);
require "../vendor/autoload.php";

use PHPRouter\RouteCollection;
use Core\Router;
use PHPRouter\Route;
use PHPRouter\Config;

$config = Config::loadFromFile(PROJECTPATH.'/config/routes.yaml');
$router = Router::parseConfig($config);

if (!session_id()) @session_start();
ActiveRecord\Config::initialize(function($cfg)
{
	include('../config/web.php');
	$cfg->set_model_directory(PROJECTPATH.'/App/Models');
	$cfg->set_connections(array(
	'development' => 'mysql://'.$database['user'].':'.$database['password'].'@'.$database['host'].'/'.$database['name'].';charset=utf8'));
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


