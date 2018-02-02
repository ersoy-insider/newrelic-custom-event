<?php

namespace ErsoyInsider\NewrelicCustomEvent\Models;

class NewRelicConfig
{
    /**
     * @var int
     */
    private $accountId;
    /**
     * @var string
     */
    private $apiKey;

    /**
     * NewRelicConfig constructor.
     * @param $accountId
     * @param $apiKey
     */
    public function __construct(int $accountId, string $apiKey)
    {
        $this->accountId = $accountId;
        $this->apiKey = $apiKey;
    }

    /**
     * @return int
     */
    public function getAccountId(): int
    {
        return $this->accountId;
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }
}
