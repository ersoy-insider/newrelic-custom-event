Simple Library to send custom events to NewRelic Insights

[![Coverage Status](https://coveralls.io/repos/github/ersoy-insider/newrelic-custom-event/badge.svg?branch=master)](https://coveralls.io/github/ersoy-insider/newrelic-custom-event?branch=master)
[![Build Status](https://travis-ci.org/ersoy-insider/newrelic-custom-event.svg?branch=master)](https://travis-ci.org/ersoy-insider/newrelic-custom-event)
[![StyleCI](https://styleci.io/repos/119453321/shield?branch=master)](https://styleci.io/repos/119453321)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ersoy-insider/newrelic-custom-event/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/ersoy-insider/newrelic-custom-event/?branch=master)

## Installation For Lumen
Require this package with Composer

```bash
$ composer require ersoy-insider/newrelic-custom-event
```

or composer.json

```json
"require": {
  "ersoy-insider/newrelic-custom-event": "^1.0"
},
```


## Configuration

Add service provider

```php
$app->register(\ErsoyInsider\NewrelicCustomEvent\NewRelicCustomEventServiceProvider::class);
```

If you want to use facade, add following line

```php
$app->withFacades(true, [
    '\ErsoyInsider\NewrelicCustomEvent\Facades\NewRelicDispatcher' => 'NewRelicDispatcher'
]);
```

Copy the `/vendor/ersoy-insider/newrelic-custom-event/config/new-relic-custom-event.php` file to your local config directory. Edit `config/new-relic-custom-event.php` for your NewRelic credentials.

### Basic usage

```php
app('new-relic-dispatcher')->fire($properties);
```

or

```php
\NewRelicDispatcher::fire($properties);
```


```php
$properties = [
    'jobName' => 'test',
    'users' => [
        ['id' => 5, 'name' => 'testasdada'],
        ['id' => 55, 'name' => 'test3'],
        ['id' => 555, 'name' => 'test2'],
        ['id' => 5555, 'name' => 'test4'],
    ],
    'test' => 'another-parameter',
    'yet-another' => 'parameter',
    'will-be' => ['discarded'] // it will be discarded
    'will-not-be' => 'discarded' // it will not be discarded
];
```

* ``$properties`` is basic array consist of key values.
* Only ``users`` key's value is allowed to array, any other key of which value is discarded because of NewRelic's policy.
* Events will be queued for delivery to NewRelic's Insights.
