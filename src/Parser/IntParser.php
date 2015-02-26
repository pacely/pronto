<?php namespace Pacely\Pronto\Parser;

class IntParser implements ParserInterface {

	use FormatTrait;

	/**
	 * Decimal pattern
	 *
	 * @var string
	 */
	protected static $pattern = '/^(\d)+$/m';

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
		$this->setTime(array_shift($this->match));

		return $this;
	}

	/**
	 * Set our time property to x seconds
	 *
	 * @param $int
	 */
	private function setTime($int)
	{
		$this->time = ($int > 9) ? $int*60 : $int*3600;
	}
}
