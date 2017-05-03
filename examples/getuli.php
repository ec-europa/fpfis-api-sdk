<?php
require(__DIR__.'/../vendor/autoload.php');
/**
 * Invoke the client
 */
$client = new \EC\Fpfis\Sdk\ApiClient(
    'http://localhost:8883/api',
    '6d645fdd973e75db17d6bd22df50c4689aca4bf1',
    '722af89ab907e1ce44f6a7d37d09927b00725cf335993e3a915001a38c0ac270'
);
$client->httpClient->options['curl_options'][CURLOPT_VERBOSE] = true;

/**
 * Get an uli for site xxxxxx
 */
var_dump(
    $client->getSubsiteAdminUli(652)
);
