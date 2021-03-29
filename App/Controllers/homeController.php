<?php 
namespace App\Controllers;

class homeController extends Controller{
	public function index(){
		echo 'a';
	}

	public function auth(){
		$session = new \App\Libs\Session();
		print_r($session->createJwtToken());
		die();
	}
}


?>