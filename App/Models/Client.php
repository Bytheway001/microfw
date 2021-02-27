<?php 
namespace App\Models;

class Client extends \ActiveRecord\Model{
	public function serialize(){
		return $this->to_array();
	}
}	

 ?>