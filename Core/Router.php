<?php 
namespace Core;
use PHPRouter\Router as MainRouter;
use PHPRouter\RouteCollection;
use \Core\Route;
class Router extends MainRouter{
	public static function parseConfig(array $config)
	{   



		$collection = new RouteCollection();
		/* Rafa edit, here we are going to add the resources */
		if(isset($config['resources'])){
		
			foreach($config['resources'] as $resource){
				$routes = static::createResource($resource);
				foreach($routes as $name=>$route){
					$collection->attachRoute(new Route($route[0], [
						'_controller' => "\App\Controllers\\".str_replace('.', '::', $route[1]),
						'methods' => $route[2],
						'name' => $name
					]));
				}
			}

		}
		

		foreach ($config['routes'] as $name => $route) {
			$collection->attachRoute(new Route($route[0], [
				'_controller' => "\App\Controllers\\".str_replace('.', '::', $route[1]),
				'methods' => $route[2],
				'name' => $name
			]));
		}


		$router = new Router($collection);
		if (isset($config['base_path'])) {
			$router->setBasePath($config['base_path']);
		}

		return $router;
	}

	public function createResource($resourceName){
		return [
			'index'=>['/'.$resourceName,$resourceName.'Controller.index',"GET"],
			'create'=>['/'.$resourceName,$resourceName.'Controller.create',"POST"],
			'update'=>['/'.$resourceName."/:id",$resourceName.'Controller.update',"PUT"],
			'delete'=>['/'.$resourceName."/:id",$resourceName.'Controller.delete','DELETE'],
			'show'=>['/'.$resourceName."/:id",$resourceName.'Controller.show',"GET"],
		];
	}
}

 ?>