<?php

namespace ErsoyInsider\NewRelicCustomEvent\Tests;

use ErsoyInsider\NewrelicCustomEvent\Events\CustomEvent;
use ErsoyInsider\NewrelicCustomEvent\NewRelicCustomEventServiceProvider;
use Laravel\Lumen\Application;
use PHPUnit\Framework\TestCase;

/**
 * Class PostServiceTest
 * @package ErsoyInsider\NewRelicCustomEvent\Tests
 */
class PostServiceTest extends TestCase
{
    public function test_makes_request_to_new_relic_returns_error()
    {
        $app = new Application();
        $app->register(NewRelicCustomEventServiceProvider::class);
        $newRelicCustomEventService = $app->make('new-relic-custom-event');

        $properties = [
            'jobName' => 'randomJob',
            'users' => [
                ['id' => 1, 'name' => 'testasdada', 'eventType' => 'Journey'],
                ['id' => 41, 'name' => 'test3', 'eventType' => 'Journey'],
                ['id' => 13, 'name' => 'test2', 'eventType' => 'Journey'],
                ['id' => 12, 'name' => 'test4', 'eventType' => 'Journey'],
            ]
        ];

        $customEvent = new CustomEvent(
            $properties,
            $app['config']->get('new-relic-custom-event.event_type'),
            $app['config']->get('new-relic-custom-event.app_name')
        );

        $response = $newRelicCustomEventService->makeRequest($customEvent->getProperties());

        $this->assertObjectHasAttribute('error', $response);
    }
}
