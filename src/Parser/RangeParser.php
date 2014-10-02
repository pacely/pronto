<?php namespace Pacely\Pronto\Parser;

class RangeParser implements ParserInterface {

	use FormatTrait;

	/**
	 * Range pattern
	 *
	 * @var string
	 */
	protected static $pattern = '/([\d:]+)(?:[\s]?)(?:\-|to|til)(?:[ ]*)([\d:]+)?/';

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
		list($from, $to) = array_pad($this->match, 2, null);

		$this->setTime($from, $to);

		return $this;
	}

	/**
	 * Set our time property to x seconds
	 *
	 * @param $from
	 * @param $to
	 */
	private function setTime($from, $to)
	{
		$this->timeToSeconds($from);
		$this->timeToSeconds($to);

		$this->time = $to - $from;
	}

	/**
	 * Convert time to seconds
	 *
	 * @param $time
	 */
	private function timeToSeconds(&$time)
	{
		$time = $time ? $time : date("H:i");
		$minutes = 0;

		if (strpos($time,':') !== false)
		{
			list($time, $minutes) = explode(':', $time);
		}

		$time = ($time * 60 + $minutes)*60;
	}

}