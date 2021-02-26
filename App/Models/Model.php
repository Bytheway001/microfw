<?php 
namespace App\Models;

class Model extends \ActiveRecord\Model{
	static function all(){
		$result=[];
		$list=call_user_func_array('parent::all',array_merge(array('all'),func_get_args()));
		foreach($list as $k=>$v){
			$result[]=$v->to_array();
		}
		return $result;
	}


}

 ?>