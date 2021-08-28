<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class RequestTest extends TestCase{

	public function testRequestObjectCanBeInstanciated(){
		$request = \Core\Request::instance();
		$this->assertNotNull($request);
	}

}
