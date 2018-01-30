<?php

namespace ErsoyInsider\NewRelicCustomEvent\Services;

use Ixudra\Curl\CurlService;

class NewRelicService
{
    private $apiKey;
    /**
     * @var CurlService
     */
    private $curlService;

    public function __construct(string $apiKey, CurlService $curlService)
    {
        $this->apiKey = $apiKey;
        $this->curlService = $curlService;
    }

    public function foo()
    {
//        $this->curlService->
    }
}
