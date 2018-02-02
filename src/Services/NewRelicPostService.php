<?php

namespace ErsoyInsider\NewrelicCustomEvent\Services;

use ErsoyInsider\NewrelicCustomEvent\Models\NewRelicConfig;
use Ixudra\Curl\CurlService;

/**
 * Class NewRelicPostService
 * @package ErsoyInsider\NewrelicCustomEvent\Services
 */
class NewRelicPostService
{
    /**
     * @var CurlService
     */
    private $curlService;
    /**
     * @var NewRelicConfig
     */
    private $newRelicConfig;

    public function __construct(NewRelicConfig $newRelicConfig, CurlService $curlService)
    {
        $this->curlService = $curlService;
        $this->newRelicConfig = $newRelicConfig;
    }

    /**
     * @param array $payload
     * @return mixed
     */
    public function makeRequest(array $payload)
    {
        return $this->curlService
            ->to("https://insights-collector.newrelic.com/v1/accounts/{$this->newRelicConfig->getAccountId()}/events")
            ->withContentType('application/json')
            ->withHeader('X-Insert-Key:' . $this->newRelicConfig->getApiKey())
            ->withData($payload)
            ->asJson()
            ->post();
    }
}
