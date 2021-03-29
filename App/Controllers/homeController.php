<?php 
namespace App\Controllers;

class homeController extends Controller{
	public function index(){
	}

	public function auth(){
		$session = new \App\Libs\Session();
		print_r($session->createJwtToken());
		die();
	}

	public function login(){
	}
}


?>