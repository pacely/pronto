<?php namespace Pacely\Pronto;

use InvalidArgumentException;
use Pacely\Pronto\Exception\InvalidTimeException;
use ReflectionClass;

class Pronto {

	/**
	 * @var string
	 */
	private $time;

	/**
	 * @var array
	 */
	protected $patterns = [
		'decimal',
		'range',
		'short',
		'int',
	];

	/**
	 * @param $time
	 */
	public function __construct($time = null)
	{
		$this->time = $time;
	}

	/**
	 * @param null $time
	 * @return mixed
	 */
	public function parse($time = null)
	{
		if ( ! $this->time && ! $time)
		{
			throw new InvalidArgumentException('You need to provide some kind of time');
		}

		if ($time) $this->time = $time;

		return $this->match();
	}

	/**
	 * Run through our pattern and find the correct parser
	 *
	 * @throws InvalidTimeException
	 * @return mixed
	 */
	protected function match()
	{
		foreach($this->patterns as $class)
		{
			$class = $this->getClassName($class);
			$pattern = $class::getPattern();

			if (preg_match($pattern, $this->time, $match))
			{
				$reflector = new ReflectionClass($class);
				$t = $reflector->newInstance($match);

				return $t->parse();
			}
		}

		throw new InvalidTimeException("No parser found for input");
	}

	private function getClassName($class)
	{
		return __NAMESPACE__.'\\Parser\\'.ucfirst($class).'Parser';
	}
}
