<?php namespace Pacely\Pronto\Facades;

use Illuminate\Support\Facades\Facade;

class Pronto extends Facade
{
	protected static function getFacadeAccessor()
	{
		return 'pronto';
	}
}
