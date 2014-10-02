<?php namespace Tests\Parser;

use Tests\ProntoTest;

class IntParserTest extends ProntoTest {

	public function testMinutesFormat()
	{
		$this->assertEquals(540, $this->pronto->parse('9')->toMinutes());
		$this->assertEquals(10, $this->pronto->parse('10')->toMinutes());
	}

	public function testMatcher()
	{
		$this->assertEquals(14400, (string) $this->pronto->parse('4'));
		$this->assertEquals(1800, (string) $this->pronto->parse('30'));
	}

	public function testCastingToString()
	{
		$this->assertEquals('1800', (string) $this->pronto->parse('30'));
	}

}