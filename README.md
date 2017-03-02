# FPFIS API SDK

Used to create requests against FPFIS API(s)

## Example

```php
$client = new \EC\Fpfis\Api\Client('http://localhost:8081/', 'b01623674088a');

// Test auth :

$client->testAuthentication(); // returns true/false
$client->getDrushUli($id); // return false/ULI
```