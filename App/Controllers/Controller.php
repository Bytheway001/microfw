<?php 
namespace App\Controllers;

class Controller{
	protected $request;

	public function __construct(){
		$this->requireSession();
	}

	private function requireSession(){
		if (! preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
			header('HTTP/1.0 400 Bad Request');
			echo 'Token not found in request';
			exit;
		}
	}
	/*
	private function authenticateRequest() {
		$uri = strtok($_SERVER['REQUEST_URI'], '?');
		if ($uri !== '/auth') {
			if (!isset($_SERVER['HTTP_U'])) {
				$this->error('NOT AUTHENTICATED',403);
			} else {
				$this->current_id = $_SERVER['HTTP_U'];
				$this->current_user = \App\Models\User::find([$this->current_id]);
			}
		}
	}
*/
	public function __set($name,$value){
		$this->$name = $value;
	}

	public function __get($name){
		return $this->$name;
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