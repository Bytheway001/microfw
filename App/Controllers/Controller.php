<?php 
/**
* This is the main controller class, The controllers should inherit from this class (for custom views) or from \Core\Crud (for simple crud scaffolds)
*/

namespace App\Controllers;
use \Plasticbrain\FlashMessages\FlashMessages;
use Symfony\Component\Yaml\Yaml;
class Controller{
	private $msg;
	private $payload;
	private $action;

	public function __set($name,$value){
		$this->$name = $value;
	}

	public function __get($name){
		return $this->$name;
	}

	public function __construct(){
		header('Content-Type:application/json');header('Content-Type:application/json');
		$this->msg = new FlashMessages();
		$this->payload = json_decode(file_get_contents("php://input"),TRUE);

	}

	protected function response(array $response,$code=200){
		http_response_code($code);
		echo json_encode(['data'=>$response]);
		die();
	}

	protected function error(array $body,$code=500){
		if($code==200){
			throw new \Exception("Cannot call an error with code 200");
		}
		http_response_code($code);
		echo json_encode(['data'=>$body]);
		die();
	}

}

?>