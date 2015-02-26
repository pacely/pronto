<?php namespace Pacely\Pronto\Parser;

trait FormatTrait {

	/**
	 * @var int|float
	 */
	protected $hoursInDay = 7.5;

	/**
	 * @var int
	 */
	protected $daysInWeek = 5;

	/**
	 * Return pattern
	 *
	 * @return string
	 */
	public static function getPattern()
	{
		return static::$pattern;
	}

	/**
	 * Return minutes
	 *
	 * @return int
	 */
	public function toMinutes()
	{
		return round($this->time/60);
	}

	/**
	 * Make sure you support time that are greater than one day (86400 seconds)
	 *
	 * @param bool $withSeconds
	 * @return string
	 */
	public function toTime($withSeconds = false)
	{
		$h = floor($this->time / 3600);
		$i = ($this->time / 60) % 60;
		$s = $this->time % 60;

		return sprintf("%02d:%02d".($withSeconds ? ":%02d" : ""), $h, $i, $s);
	}

	/**
	 * Return decimal time
	 *
	 * @return double
	 */
	public function toDecimal()
	{
		return (double) sprintf("%.2F", $this->time/60/60);
	}

	/**
	 * Return time if casted to string
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->time;
	}

	/**
	 * @return float
	 */
	public function getHoursInDay()
	{
		return $this->hoursInDay;
	}

	/**
	 * @param int|float $hoursInDay
	 */
	public function setHoursInDay($hoursInDay)
	{
		$this->hoursInDay = $hoursInDay;
	}

	/**
	 * @return int
	 */
	public function getDaysInWeek()
	{
		return $this->daysInWeek;
	}

	/**
	 * @param int $daysInWeek
	 */
	public function setDaysInWeek($daysInWeek)
	{
		$this->daysInWeek = $daysInWeek;
	}

}
