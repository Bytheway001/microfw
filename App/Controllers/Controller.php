<?php 
namespace App\Controllers;
use App\Libs\Session;
class Controller{
	protected $request;

	public function __construct(){
		$this->requireSession();
	}

	private function requireSession(){
		if(!Session::isValid()){
			$this->error("NOT AUTHENTICATED",403);
		}
	}

	protected function response(array $response,$code=200){	
		http_response_code($code);
		echo json_encode(['data'=>$response]);
		exit;
	}

	protected function error($body,$code=500){
		if($code==200){
			throw new \Exception("Cannot call an error with code 200");
		}
		http_response_code($code);
		echo json_encode(['data'=>$body]);
		exit;
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



	

}

?>