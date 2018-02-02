<?php

namespace ErsoyInsider\NewrelicCustomEvent;

use ErsoyInsider\NewrelicCustomEvent\Models\NewRelicConfig;
use ErsoyInsider\NewrelicCustomEvent\Services\NewRelicDispatcher;
use ErsoyInsider\NewrelicCustomEvent\Services\NewRelicPostService;
use Illuminate\Support\ServiceProvider;
use Ixudra\Curl\CurlService;

/**
 * Class ServiceProviderTest
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
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $listens = [
        'ErsoyInsider\NewrelicCustomEvent\Events\CustomEvent' => [
            'ErsoyInsider\NewrelicCustomEvent\Listeners\CaptureCustomEvent'
        ]
    ];

    /**
     * @return void
     */
    public function boot()
    {
        $this->setUpListeners();
        $this->setUpConfig();
    }

    public function setUpListeners()
    {
        foreach ($this->listens as $event => $listeners) {
            foreach ($listeners as $listener) {
                $this->app['events']->listen($event, $listener);
            }
        }
    }

    protected function setUpConfig()
    {
        $source = dirname(__DIR__) . '/config/new-relic-custom-event.php';
        $this->app->configure('new-relic-custom-event');
        $this->mergeConfigFrom($source, 'new-relic-custom-event');
    }

    public function register()
    {
        $this->app->singleton('new-relic-custom-event', function ($app) {
            return new NewRelicPostService(
                new NewRelicConfig(
                    $app['config']['new-relic-custom-event.account_id'],
                    $app['config']['new-relic-custom-event.api_key']
                ),
                new CurlService()
            );
        });


        $this->app->singleton('new-relic-dispatcher', function ($app) {
            return new NewRelicDispatcher($app['config'], $app['events']);
        });
    }

    /**
     * @return array
     */
    public function provides()
    {
        return ['new-relic-custom-event', 'new-relic-dispatcher'];
    }
}
