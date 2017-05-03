# FPFIS API SDK

Used to create requests against FPFIS API(s)

## Test auth

### Example 

```php
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

```

### Response ( see examples/connection-test.php)

```
* Connected to localhost (127.0.0.1) port 8883 (#0)
> POST /api/auth/test HTTP/1.1
Host: localhost:8883
User-Agent: FPFIS-API-PHP-SDK/0.1
Accept: */*
x-fpfis-app-id:2689e13b719752ddb3a7c2c3de3f87eba6e5c2f2
x-fpfis-signature:58a2d5f6820e5d7413db1467dc70b34c8de002c63613ebbbad9061f6ed2b04d5
Content-Length: 2
Content-Type: application/x-www-form-urlencoded

* upload completely sent off: 2 out of 2 bytes
< HTTP/1.1 200 OK
< Set-Cookie: PHPSESSID=7q9huji98oc6b4u2m9he1ftln1; path=/
< Expires: Thu, 19 Nov 1981 08:52:00 GMT
< Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0
< Pragma: no-cache
< Content-Type: application/json;charset=utf-8
< Content-Length: 66
< Date: Fri, 28 Apr 2017 14:51:14 GMT
< Server: lighttpd/1.4.45
< 
* Curl_http_done: called premature == 0
* Connection #0 to host localhost left intact
bool(true)
```

## Get ULI link

### Example 

```php
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
    $client->getSubsiteAdminUli()
);

```

### Response ( see examples/getuli.php)

```
Trying 127.0.0.1...
* TCP_NODELAY set
* Connected to localhost (127.0.0.1) port 8883 (#0)
> POST /api/drush/getUli HTTP/1.1
Host: localhost:8883
User-Agent: FPFIS-API-PHP-SDK/0.1
Accept:application/json
x-fpfis-app-id:6d645fdd973e75db17d6bd22df50c4689aca4bf1
x-fpfis-signature:5e55e4d1ad4150e2477e4dc6c9e05c3b9b3998d77356b24d8cc269624ca245ae
Content-Length: 18
Content-Type: application/x-www-form-urlencoded

* upload completely sent off: 18 out of 18 bytes
< HTTP/1.1 200
< Set-Cookie: PHPSESSID=mpv2org6viq612t8her96j7sh1; path=/
< Expires: Thu, 19 Nov 1981 08:52:00 GMT
< Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0
< Pragma: no-cache
< Content-Type: application/json;charset=utf-8
< Content-Length: 3994
< Date: Wed, 03 May 2017 14:23:22 GMT
< Server: lighttpd/1.4.45
< 
* Curl_http_done: called premature == 0
* Connection #0 to host localhost left intact
string(200) "https://webgate.ec.europa.eu/multisite/user/reset/xxxxxxxxxxxxxxxxxxxxxx"
```