<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class MainTest extends TestCase{
	/**
	* @dataProvider constantsProvider
	*/
	public function testTheConstantsAreDefined($constant){
		$declaredConstants = get_defined_constants(true)['user'];
		$this->assertTrue(in_array($constant,$declaredConstants));
	}




	public function constantsProvider(){
		return [
			["PROJECTPATH"],
			["APPPATH"],
			["CONTROLLER_NAMESPACE"],
			["DEBUG"]
		];
	}

}
