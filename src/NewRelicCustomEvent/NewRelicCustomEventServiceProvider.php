<?php

namespace ErsoyInsider\NewrelicCustomEvent;

use ErsoyInsider\NewRelicCustomEvent\Services\NewRelicService;
use Illuminate\Support\ServiceProvider;
use Ixudra\Curl\CurlService;

/**
 * Class NewRelicCustomEventServiceProvider
 * @package ErsoyInsider\NewRelicCustomEvent
 */
class NewRelicCustomEventServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * @return void
     */
    public function boot()
    {
        $this->setUpConfig();
    }

    protected function setUpConfig()
    {
        $source = dirname(__DIR__) . '../config/new-relic-custom-event.php';
        $this->app->configure('new-relic-custom-event');
        $this->mergeConfigFrom($source, 'new-relic-custom-event');
    }

    public function register()
    {
        $this->app->singleton('new-relic-custom-event', function ($app) {
            return new NewRelicService($app['config']->get('new-relic-custom-event.api_key'), new CurlService());
        });
    }
}
