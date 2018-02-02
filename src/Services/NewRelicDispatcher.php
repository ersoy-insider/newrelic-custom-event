<?php

namespace ErsoyInsider\NewrelicCustomEvent\Services;

use ErsoyInsider\NewrelicCustomEvent\Events\CustomEvent;
use Illuminate\Config\Repository as Config;
use Illuminate\Events\Dispatcher;

class NewRelicDispatcher
{
    /**
     * @var Config
     */
    private $config;
    /**
     * @var Dispatcher
     */
    private $dispatcher;

    /**
     * Foobar constructor.
     * @param Config $config
     * @param Dispatcher $dispatcher
     */
    public function __construct(Config $config, Dispatcher $dispatcher)
    {
        $this->config = $config;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param array $properties
     */
    public function fire(array $properties)
    {
        $this->dispatcher->dispatch(
            new CustomEvent(
                $properties,
                $this->config->get('new-relic-custom-event.event_type'),
                $this->config->get('new-relic-custom-event.app_name')
            )
        );
    }
}
