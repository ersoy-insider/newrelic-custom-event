<?php

return [
    'api_key' => env('NEW_RELIC_API_KEY', 'new-relic-api-key'),
    'account_id' => env('NEW_RELIC_ACCOUNT_ID', 123456),
    'app_name' => env('NEW_RELIC_APP_NAME', 'new-relic-app-name'),
    'event_type' => env('NEW_RELIC_EVENT_TYPE', 'Journey')
];
