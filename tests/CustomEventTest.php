<?php

namespace ErsoyInsider\NewRelicCustomEvent\Tests;

use ErsoyInsider\NewrelicCustomEvent\Events\CustomEvent;
use PHPUnit\Framework\TestCase;

/**
 * Class CustomEventTest
 * @package ErsoyInsider\NewRelicCustomEvent\Tests
 */
class CustomEventTest extends TestCase
{
    /** @test */
    public function it_creates_new_empty_custom_event()
    {
        $customEvent = new CustomEvent(['a' => 'b'], 'something', 'another');
        $this->assertInstanceOf(CustomEvent::class, $customEvent);
    }

    /** @test */
    public function it_creates_new_custom_event_with_properties()
    {
        $customEvent = new CustomEvent(['foo' => 'bar'], 'something', 'another');
        $this->assertEquals($customEvent->getProperties()['foo'], 'bar');
    }

    /** @test */
    public function it_custom_event_properties_may_have_default_event()
    {
        $customEvent = new CustomEvent([], 'something', 'another');
        $this->assertArrayHasKey('eventType', $customEvent->getProperties());
    }

    /** @test */
    public function it_custom_event_has_preset_event_type()
    {
        $customEvent = new CustomEvent(['eventType' => 'bar'], 'something', 'another');
        $this->assertEquals($customEvent->getProperties()['eventType'], 'bar');
    }

    /** @test */
    public function it_custom_event_does_not_contain_users_array()
    {
        $customEvent = new CustomEvent(['users' => [['id' => 2, 'mail' => 'bar']]], 'something', 'another');
        $this->assertArrayNotHasKey('users', $customEvent->getProperties());
    }

    /** @test */
    public function it_discards_array_values_except_users()
    {
        $customEvent = new CustomEvent(['users' => ['id' => 2], 'foo' => ['test']], 'something', 'another');
        $this->assertArrayNotHasKey('foo', $customEvent->getProperties());
    }
}
