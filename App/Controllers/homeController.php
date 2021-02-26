<?php 
namespace App\Controllers;
use \Core\View;
use \App\Models\Product;


class homeController extends Controller{
	public function index(){
		$product=Product::find([1]);
		$this->response($product->serialize());
	}
}


 ?>