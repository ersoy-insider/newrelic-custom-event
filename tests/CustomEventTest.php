<?php

namespace ErsoyInsider\NewRelicCustomEvent\Tests;

use ErsoyInsider\NewrelicCustomEvent\Events\CustomEvent;
use PHPUnit\Framework\TestCase;

class CustomEventTest extends TestCase
{
    /**
     * @test
     */
    public function creates_new_custom_event()
    {
        $customEvent = new CustomEvent([]);

        $this->assertInstanceOf(CustomEvent::class, $customEvent);
    }

    /**
     * @test
     */
    public function creates_new_custom_event_with_properties()
    {
        $customEvent = new CustomEvent(['foo' => 'bar']);

        $this->assertEquals($customEvent->getProperties()['foo'], 'bar');
    }

    /**
     * @test
     */
    public function custom_event_properties_should_have_default_event()
    {
        $customEvent = new CustomEvent([]);
        $properties = $customEvent->getProperties();

        $this->assertArrayHasKey('eventType', $properties);
    }

    /**
     * @test
     */
    public function custom_event_has_preset_event_type()
    {
        $customEvent = new CustomEvent(['eventType' => 'bar']);
        $properties = $customEvent->getProperties();

        $this->assertEquals($properties['eventType'], 'bar');
    }
}
