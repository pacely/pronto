<?php namespace Tests;

use Pacely\Pronto\Pronto;
use PHPUnit_Framework_TestCase;

class ProntoTest extends PHPUnit_Framework_TestCase {

	public $pronto;

	public function setUp()
	{
		$this->pronto = new Pronto();
	}

	public function testPronto()
	{
		$this->assertEquals(new Pronto(), $this->pronto);
	}

	/**
	 * @expectedException        InvalidArgumentException
	 * @expectedExceptionMessage You need to provide some kind of time
	 */
	public function testProntoFail()
	{
		$this->pronto->parse();
	}

	/**
	 * @expectedException        Exception
	 * @expectedExceptionMessage No parser found for input
	 */
	public function testFormatNotMatched()
	{
		$this->assertNotTrue($this->pronto->parse('not a number'));
	}

	public function testDecimalMatcherInstance()
	{
		$test = [',5', '0,5', '0.5', '5.', '1.5'];

		foreach($test as $str)
		{
			$parser = $this->pronto->parse($str);
			$this->assertInstanceOf('Pacely\Pronto\Parser\DecimalParser', $parser);
		}
	}

	public function testIntMatcherInstance()
	{
		$test = ['5', '05'];

		foreach($test as $str)
		{
			$parser = $this->pronto->parse($str);
			$this->assertInstanceOf('Pacely\Pronto\Parser\IntParser', $parser);
		}
	}

	public function testShortMatcherInstance()
	{
		$test = ['2w 5d 1h 2m', '5d 1h', '1h 3m', '20m 1d', '2t 3d'];

		foreach($test as $str)
		{
			$parser = $this->pronto->parse($str);
			$this->assertInstanceOf('Pacely\Pronto\Parser\ShortParser', $parser);
		}
	}

	public function testRangeMatcherInstance()
	{
		$test = ['9-', '01-', '10:00-', '9-10', '10:00-12:00', '10 - 12'];

		foreach($test as $str)
		{
			$parser = $this->pronto->parse($str);
			$this->assertInstanceOf('Pacely\Pronto\Parser\RangeParser', $parser);
		}
	}

}