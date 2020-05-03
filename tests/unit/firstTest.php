<?php 

use PHPUnit\Framework\TestCase;

/**
 * 
 */
class firstTest extends Testcase{

	public function testAddition(){
		
		$a=10; $b=5;
		$c=$a+$b;

		$this->assertEquals($c,20);
	}
}
