<?php 
class ModelGenerator{

	public function __construct($modelName){
		$this->modelName = $modelName;
		$this->file = fopen(MODEL_FOLDER."/$this->modelName.php","w");
		fwrite($this->file,$this->text());
		fclose($this->file);
	}



	public function text(){
		$text = 
		<<<HEREDOC
		<?php 
			namespace App\Models;
			class $this->modelName extends Model{
			}
		?>
		HEREDOC
		;
		return $text;
	}
}

 ?>