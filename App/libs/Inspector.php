<?php 
namespace App\Libs;

class Inspector{

	static $rclass;
	static $rmethods;

	static function inspect($className){
		static::$rclass = new \ReflectionClass($className);
		static::$rmethods = static::$rclass->getMethods();

		print_r(static::$rmethods);
	}
}

 ?>