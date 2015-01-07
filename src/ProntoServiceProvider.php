<?php namespace Pacely\Pronto;

use Illuminate\Support\ServiceProvider;

class ProntoServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	public function boot()
	{
		//$this->package('pacely/pronto');
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('pronto', 'Pacely\Pronto\Pronto');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('pronto');
	}

}