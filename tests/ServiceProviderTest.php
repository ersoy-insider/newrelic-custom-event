<?php

namespace ErsoyInsider\NewRelicCustomEvent\Tests;

use ErsoyInsider\NewrelicCustomEvent\NewRelicCustomEventServiceProvider;
use Laravel\Lumen\Application;
use Mockery;
use PHPUnit\Framework\TestCase;

/**
 * Class ServiceProviderTest
 * @package ErsoyInsider\NewRelicCustomEvent\Tests
 */
class ServiceProviderTest extends TestCase
{
    /**
     * @var NewRelicCustomEventServiceProvider
     */
    public $provider;

    public function setUp()
    {
        $app = Mockery::mock(Application::class);
        $this->provider = new NewRelicCustomEventServiceProvider($app);
    }

    public function tearDown()
    {
        parent::tearDown();
        Mockery::close();
    }

    /**
     * @test
     */
    public function it_provides_new_relic_custom_event()
    {
        $this->assertContains('new-relic-custom-event', $this->provider->provides());
    }

    /**
     * @test
     */
    public function it_provides_new_relic_dispatcher()
    {
        $this->assertContains('new-relic-dispatcher', $this->provider->provides());
    }
}
