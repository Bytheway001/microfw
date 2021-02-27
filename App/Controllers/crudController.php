<?php 
/**
* This is the main controller class, The controllers should inherit from this class (for custom views) or from \Core\Crud (for simple crud scaffolds)
*/
namespace App\Controllers;
class crudController extends Controller{
	public function index(){

		$result=[];
		$resources = $this::$model::all();
		print_r($this::$model);
		foreach($resources as $resource){
			$result[]=$resource->serialize();
		}
		$this->response(['errors'=>false,'data'=>$result]);
	}

	public function create(){
		$resource = new $this::$model($this->payload);
		if($resource->save()){
			$this->response(['errors'=>false,'data'=>$resource->serialize()]);
		}
		else{
			$this->response(['errors'=>true,'data'=>"Error Desconocido"]);
		}

	}

	public function update($id){
		$resource = $this::$model::find([$id]);
		if($resource->update_attributes($this->payload)){
			$this->response(['errors'=>false,'data'=>$resource->serialize()]);
		} 
		else{
			$this->response(['errors'=>true,'data'=>"Error Desconocido"]);
		}
	}

	public function delete($id){
		$resource = $this::$model::find([$id]);
		if($resource->delete($this->payload)){
			$this->response(['errors'=>false,'data'=>'Registro Eliminado']);
		} 
		else{
			$this->response(['errors'=>true,'data'=>"Error Desconocido"]);
		}
	}

	public function show($id){

		$resource = $this::$model::find([$id]);
		$this->error($resource->serialize());
	}
	
}

?>