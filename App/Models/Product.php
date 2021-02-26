<?php 
namespace App\Models;

class Product extends Model{
	public function serialize(){
		return $this->to_array();
	}
}	

 ?>