<?php
require(__DIR__.'/../vendor/autoload.php');
/**
 * Invoke the client
 */
$client = new \EC\Fpfis\Sdk\ApiClient(
    'http://localhost:8883/api',
    '2689e13b719752ddb3a7c2c3de3f87eba6e5c2f2',
    '8c60abb26d30f29519ee298686dff0e1b5d3b511f9ae727010564a0841c9dd01'
);
$client->httpClient->options['curl_options'][CURLOPT_VERBOSE] = true;

var_dump(
    $client->testAuthentication()
);
