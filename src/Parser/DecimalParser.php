<?php namespace Pacely\Pronto\Parser;

class DecimalParser implements ParserInterface {

	use FormatTrait;

	/**
	 * Decimal pattern
	 *
	 * @var string
	 */
	protected static $pattern = '/(\d*)[\.\,]([\d]+)?/';

	/**
	 * @var string
	 */
	protected $match;

	/**
	 * Our time in seconds for reference
	 *
	 * @var int
	 */
	protected $time;

	/**
	 * @param $match
	 */
	public function __construct($match)
	{
		$this->match = $match;
	}

	/**
	 * Parse and format time
	 *
	 * @return mixed
	 */
	public function parse()
	{
		array_shift($this->match);
		list($hour, $dec) = array_pad($this->match, 2, 0);

		$this->setTime($hour, $dec);

		return $this;
	}

	/**
	 * Set our time property to x seconds
	 *
	 * @param int $hour
	 * @param int $dec
	 */
	private function setTime($hour, $dec)
	{
		$dec = (int) $hour.'.'.$dec;
		$this->time = (int) ($dec*3600);
	}
}