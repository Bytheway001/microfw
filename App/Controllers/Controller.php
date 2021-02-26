<?php 
/**
* This is the main controller class, The controllers should inherit from this class (for custom views) or from \Core\Crud (for simple crud scaffolds)
*/
namespace App\Controllers;
class Controller{
	public function __construct(){
		$this->msg=new \Plasticbrain\FlashMessages\FlashMessages();
		$this->payload = json_decode(file_get_contents("php://input"),TRUE);
	}

	protected function response(array $response,$code=200){
		http_response_code($code);
		echo json_encode($response);
		die();
	}


	
}

?>