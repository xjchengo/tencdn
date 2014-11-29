<?php namespace Xjchen\Tencdn;

use Illuminate\Support\ServiceProvider;
use Xjchen\Tencdn\Commands\Publish;

class TencdnServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

    /**
     * Booting
     */
    public function boot()
    {
        $this->package('xjchen/tencdn', null, __DIR__);
        //$this->commands('command.binding');
    }

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app['tencdn.publish'] = $this->app->share(function($app)
        {
            return new Publish();
        });

        $this->commands('tencdn.publish');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
