<?php namespace Pacely\Pronto\Parser;

class ShortParser implements ParserInterface {

	use FormatTrait;

	/**
	 * Decimal pattern
	 *
	 * @var string
	 */
	protected static $pattern = '/(?:([\d]+)(?: )?(w|d|h|m|t))(?:(?: )?([\d]+)(?: )?(w|d|h|m|t))?(?:(?: )?([\d]+)(?: )?(w|d|h|m|t))?(?:(?: )?([\d]+)(?: )?(w|d|h|m|t))?/';

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
		$this->setTime($this->match);

		return $this;
	}

	/**
	 * Set our time property to x seconds
	 *
	 * @param array $time
	 */
	private function setTime(array $time)
	{
		$seconds = 0;
		$count = count($time);

		for ($i = 0; $i < $count; $i++)
		{
			if (is_numeric($time[$i]))
			{
				$seconds += $this->timeToSeconds($time[$i], $time[$i+1]);
			}
		}

		$this->time = $seconds;
	}

	/**
	 * Convert time to seconds
	 *
	 * @param $num
	 * @param $unit
	 * @return mixed
	 */
	private function timeToSeconds($num, $unit)
	{
		switch($unit)
		{
			case 'w':
				return $this->weekToSeconds($num);
			case 'd':
				return $this->dayToSeconds($num);
			case 'h':
				return $this->hourToSeconds($num);
			case 'm':
				return $this->minuteToSeconds($num);
			default:
				return $num;
		}
	}

	/**
	 * Convert weeks to seconds
	 *
	 * @param $num
	 * @return mixed
	 */
	private function weekToSeconds($num)
	{
		$week = ($this->getHoursInDay() * 3600) * $this->getDaysInWeek();
		return $num * $week;
	}

	/**
	 * Convert days to seconds
	 *
	 * @param $num
	 * @return mixed
	 */
	private function dayToSeconds($num)
	{
		$day = ($this->getHoursInDay() * 3600);
		return $num * $day;
	}

	/**
	 * Convert hours to seconds
	 *
	 * @param $num
	 * @return mixed
	 */
	private function hourToSeconds($num)
	{
		$hour = 60 * 60;
		return $num * $hour;
	}

	/**
	 * Convert minutes to seconds
	 *
	 * @param $num
	 * @return mixed
	 */
	private function minuteToSeconds($num)
	{
		return $num * 60;
	}
}
