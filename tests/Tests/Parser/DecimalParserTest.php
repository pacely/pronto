<?php namespace Tests\Parser;

use Tests\ProntoTest;

class DecimalParserTest extends ProntoTest {

	public function testMinutesFormat()
	{
		$this->assertEquals(30, $this->pronto->parse(',5')->toMinutes());
	}

	public function testMatcher()
	{
		$this->assertEquals(1800, (string) $this->pronto->parse(',5'));
		$this->assertEquals(1800, (string) $this->pronto->parse('.5'));
		$this->assertEquals(5400, (string) $this->pronto->parse('1.5'));
		$this->assertEquals(5400, (string) $this->pronto->parse('1,5'));
		$this->assertEquals(3600, (string) $this->pronto->parse('1.'));
		$this->assertEquals(3600, (string) $this->pronto->parse('1,'));
	}

	public function testTimeFormatWithoutSeconds()
	{
		$this->assertEquals('00:30', $this->pronto->parse(',5')->toTime(false));
	}

	public function testTimeFormatWithSeconds()
	{
		$this->assertEquals('00:30:00', $this->pronto->parse(',5')->toTime(true));
	}

	public function testDecimalFormat()
	{
		$this->assertEquals('0.5', $this->pronto->parse(',5')->toDecimal());
		$this->assertTrue(is_double($this->pronto->parse(',5')->toDecimal()));
	}

	public function testCastingToString()
	{
		$this->assertEquals('1800', (string) $this->pronto->parse(',5'));
	}

}