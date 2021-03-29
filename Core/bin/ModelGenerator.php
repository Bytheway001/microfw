<?php 
use \ActiveRecord\Config;
use \ActiveRecord\Connection;
use \ActiveRecord\Inflector;
class ModelGenerator{

	public function __construct($modelName){
		$this->modelName = ucwords($modelName);
		$cfg = Config::instance();
		$cfg->set_model_directory(PROJECTPATH.'/App/Models');
		$cfg->set_connections(['development' => 'mysql://'.$_ENV['DATABASE_USER'].':'.$_ENV['DATABASE_PASSWORD'].'@'.$_ENV['DATABASE_HOST'].'/'.$_ENV['DATABASE_NAME'].';charset=utf8']);
		$cfg->dbname=$_ENV['DATABASE_NAME'];
		$this->getAssociations();
		$this->file = fopen(MODEL_FOLDER."/$this->modelName.php","w");
		fwrite($this->file,$this->text());
		fclose($this->file);
		
	}

	public function getAssociations(){
		$text = '';
		$conn = Connection::instance();
		$cfg = Config::instance();
		
		$tablename = Inflector::instance()->tableize($this->modelName);
		$columns = $conn->columns($tablename);
		$query = "SELECT TABLE_NAME,COLUMN_NAME,CONSTRAINT_NAME, REFERENCED_TABLE_NAME,REFERENCED_COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE REFERENCED_TABLE_SCHEMA = '$cfg->dbname' AND REFERENCED_TABLE_NAME ='$tablename'";
		$fks = [];
		$conn->query_and_fetch($query,function($row) use (&$fks){$fks[]=$row;} );
		
		if(count($fks)>0){

			$text.= 'static $belongs_to = [';
			foreach($fks as $fk){

				$text.="['".$fk['referenced_table_name']."']";
				$text.=']';
			}	
		}


		$this->associationText = $text;

	}



	public function text(){
		$text = 
		<<<HEREDOC
		<?php 
		namespace App\Models;
		class $this->modelName extends Model{
			$this->associationText
		}
		?>
		HEREDOC
		;
		return $text;
	}
}

?>