<?php 
define("MODEL_FOLDER",__DIR__.'/../../App/Models');
switch($argv[2]){
	case "model":

		echo "Generating $argv[3] Model...\n";
		require 'ModelGenerator.php';
		$generator = new ModelGenerator($argv[3]);
	break;
}


 ?>