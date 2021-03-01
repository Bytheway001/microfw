<?php 
namespace App\Libs;
use \DateTime;
class Moment{
	private $time;
	private $format;

	public function __set($k,$v){
		$this->$k = $v;
	}

	public function __get($k){
		return $this->$k;
	}

	public function __construct($time='1990-01-01',$format="Y-m-d"){
		$this->format = $format;
		$this->time = DateTime::createFromFormat($format, $time);
	}

	public function isLaterThan(Moment $time){
		$interval = $this->time > $time->time;
		return $interval;
	}

	public function format($newFormat){
		$this->__construct($this,$newFormat);
	}

	public function until(Moment $time2):\DateInterval{
		return $this->time->diff($time2->time);
	}

	public function __toString(){
		return $this->time->format($this->format);
	}

}

 ?>