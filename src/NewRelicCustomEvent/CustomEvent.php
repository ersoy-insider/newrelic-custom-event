<?php

namespace ErsoyInsider\NewRelicCustomEvent;

/**
 * Class CustomEvent
 * @package NewRelicCustomEvent
 */
class CustomEvent extends Event
{
    const DEFAULT_EVENT = 'defaultEvent';

    /**
     * @var array
     */
    private $properties;

    /**
     * CustomEvent constructor.
     * @param array $properties
     */
    public function __construct(array $properties)
    {
        $this->setProperties($properties);
    }

    private function setProperties(array $properties)
    {
        if (!array_key_exists('eventType', $properties)) {
            $properties['eventType'] = self::DEFAULT_EVENT;
        }

        $this->properties = $properties;
    }

    public function getProperties(): array
    {
        return $this->properties;
    }
}
