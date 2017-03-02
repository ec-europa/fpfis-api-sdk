<?php
namespace EC\Fpfis\Api {

    use GuzzleHttp\Exception\BadResponseException;
    use GuzzleHttp\Message\RequestInterface;
    use GuzzleHttp\Psr7\Request;

    /**
     * _Client class for connectiong to any FPFIS API_
     *
     * ## Examples :
     *
     * ### Get a new client
     *
     * ```php
     * $client = new \EC\Fpfis\Api\Client('https://some.api:8443',
     *    'drundedNajRicEwBagBuPyotLifol');
     * ```
     *
     * ### Testing authentication
     *
     * ```php
     * if(!$client->testAuthentication())
     *   throw new \Exception('Authentication failed');
     * ```
     * ___
     *
     * @package EC\Fpfis\Api
     */
    class Client extends \GuzzleHttp\Client
    {

        /**
         * @var string $endpoint
         */
        protected $endpoint;
        /**
         * Creates a new FPFIS client object :
         * ```php
         * $client = new \EC\Fpfis\Api\Client('https://some.api:8443', 'drundedNajRicEwBagBuPyotLifol');
         * ```

         * @param string $endpoint FPFIS API endpoint (with /api)
         * @param string $token    Secret application token
         * @param array  $config   additional guzzle configuration
         */
        public function __construct($endpoint, $token, $config = [])
        {
            $this->endpoint = $endpoint;
            parent::__construct($config);
            $this->setDefaultOption('headers/api-token', $token);
            $this->setDefaultOption('headers/content-type', 'application/json');
            $this->setDefaultOption('headers/Accept', 'application/json');

        }

        /**
         * Overrides guzzle send method to receive json :
         * @param RequestInterface $request
         * @return mixed
         * @throws \Exception
         */
        public function send(RequestInterface $request) {
            $request->setPath($this->endpoint.$request->getPath());
            try {
                $response = json_decode(
                    parent::send($request)->getBody()->getContents()
                );
            } catch (\Exception $e) {
                if(
                    ($e instanceof \GuzzleHttp\Exception\ClientException ||
                        $e instanceof \GuzzleHttp\Exception\ServerException) &&
                    $e->hasResponse()
                ) {
                    $response = json_decode($e->getResponse()->getBody());
                } else {
                    throw $e;
                }
            }
            if(!is_object($response) || empty($response->status) ) {
                throw new \Exception('API error, invalid reponse');
            }
            return $response;
        }


        /**
         * Test authentication against the FPFIS api
         * ```php
         * $client->testAuthentication(); // true or false
         * ```
         *
         * @return bool Authentication is successul or not.
         */
        public function testAuthentication()
        {
            return $this->get('/api/auth/test')->status === 200;
        }

        public function getDrushUliUrl($siteId) {

            $response = $this->get('/api/drush/getUli/'.$siteId);
            if($response->status !== 200) return false;
            return $response->URL;
        }
    }
}
