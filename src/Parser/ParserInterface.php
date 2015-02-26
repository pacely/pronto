<?php namespace Pacely\Pronto\Parser;

interface ParserInterface {

	/**
	 * Parse and format time
	 *
	 * @return mixed
	 */
	public function parse();

	/**
	 * Return pattern
	 *
	 * @return string
	 */
	public static function getPattern();

	/**
	 * Return minutes
	 *
	 * @return int
	 */
	public function toMinutes();

	/**
	 * Make sure you support time that are greater than one day (86400 seconds)
	 *
	 * @param bool $withSeconds
	 * @return string
	 */
	public function toTime($withSeconds = false);

	/**
	 * Return decimal time
	 *
	 * @return double
	 */
	public function toDecimal();

	/**
	 * Return time if casted to string
	 *
	 * @return string
	 */
	public function __toString();
}
