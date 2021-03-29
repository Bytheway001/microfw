<?php 
require "./vendor/autoload.php";
require "./Core/init.php";
require './Config/web.php';
use \ActiveRecord\Config;

define("MODEL_FOLDER",__DIR__.'/../../App/Models');

$cfg = Config::instance();
$cfg->set_model_directory(PROJECTPATH.'/App/Models');
$cfg->set_connections([	'development' => 'mysql://'.$database['user'].':'.$database['password'].'@'.$database['host'].'/'.$database['name'].';charset=utf8']);

switch($argv[2]){
	case "model":
	echo "Generating $argv[3] Model...\n";
	require 'ModelGenerator.php';
	$generator = new ModelGenerator($argv[3]);
	break;
}


?>