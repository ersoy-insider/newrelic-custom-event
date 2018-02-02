<?php

namespace ErsoyInsider\NewrelicCustomEvent\Listeners;

use ErsoyInsider\NewrelicCustomEvent\Events\CustomEvent;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class CaptureCustomEvent
 * @package ErsoyInsider\NewrelicCustomEvent\Listeners
 */
class CaptureCustomEvent implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param CustomEvent $event
     * @return void
     */
    public function handle(CustomEvent $event)
    {
        app('new-relic-custom-event')->makeRequest($event->getProperties());
    }
}
