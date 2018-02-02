<?php

namespace ErsoyInsider\NewrelicCustomEvent\Facades;

use Illuminate\Support\Facades\Facade;

class NewRelicDispatcher extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'new-relic-dispatcher';
    }
}
