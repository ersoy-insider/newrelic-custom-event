<?php

namespace ErsoyInsider\NewrelicCustomEvent\Events;

/**
 * Class CustomEvent
 * @package NewRelicCustomEvent
 */
class CustomEvent extends Event
{
    const RESERVED_ARRAY_KEY = 'users';

    /**
     * @var array
     */
    private $properties;

    /**
     * @return string
     */
    public function getEvenType(): string
    {
        return $this->evenType;
    }

    /**
     * @return string
     */
    public function getAppName(): string
    {
        return $this->appName;
    }
    /**
     * @var string
     */
    private $evenType;
    /**
     * @var string
     */
    private $appName;

    /**
     * CustomEvent constructor.
     * @param array $properties
     * @param string $evenType
     * @param string $appName
     */
    public function __construct(array $properties, string $evenType, string $appName)
    {
        $this->evenType = $evenType;
        $this->appName = $appName;
        $this->setProperties($properties);
    }

    /**
     * @param array $properties
     */
    private function setProperties(array $properties)
    {
        if (!array_key_exists('eventType', $properties)) {
            $properties['eventType'] = $this->getEvenType();
        }

        $properties['appName'] = $this->getAppName();
        $properties = $this->discardArraysExceptReserved($properties);
        $properties = $this->handleReservedKey($properties);

        $this->properties = $properties;
    }

    /**
     * Discards keys of which has arrays except reserved one
     *
     * @param array $properties
     * @return array
     */
    private function discardArraysExceptReserved(array $properties)
    {
        foreach ($properties as $key => $property) {
            if (is_array($property) && $key !== self::RESERVED_ARRAY_KEY) {
                unset($properties[$key]);
            }
        }

        return $properties;
    }

    /**
     * @param array $properties
     * @return array
     */
    private function handleReservedKey(array $properties)
    {
        $reservedKey = self::RESERVED_ARRAY_KEY;

        if (array_key_exists($reservedKey, $properties)) {
            $users = $properties[$reservedKey];
            unset($properties[$reservedKey]);
            $properties = array_map(function ($user) use ($properties) {
                if (is_array($user)) {
                    return $user + $properties;
                }

                return $properties;
            }, $users);
        }

        return $properties;
    }

    /**
     * @return array
     */
    public function getProperties(): array
    {
        return $this->properties;
    }
}
