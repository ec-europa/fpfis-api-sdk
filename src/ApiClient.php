<?php
namespace EC\Fpfis\Sdk {

    use Gbo\PSKValidator;

    /**
     * _Client class for connectiong to any FPFIS API_
     *
     * @package EC\Fpfis\Api
     */
    class ApiClient
    {
        /**
         * @var PSKValidator $pskValidator
         */
        private $pskValidator;

        /**
         * @var \RestClient $httpClient
         */
        public $httpClient;

        /**
         * Creates a new FPFIS client object :
         * ```php
         * $client = new \EC\Fpfis\Api\Client(
         *      'https://some.api:8443',
         *      'cf1f17709a597283d64b55bb83888af35f9b287e', // applicationId
         *      'e148346413a07418612c87fcc2d9f1bc91886561d2d129bd462315dc5e124f19' //secret
         * );
         * ```
         * @param string $endpoint FPFIS API endpoint (with /api)
         * @param string $applicationId    Application ID
         * @param string $applicationId    Secret application applicationId
         */
        public function __construct($endpoint, $applicationId, $secret)
        {
            $this->httpClient = new \RestClient();
            $this->httpClient->options['user_agent'] = 'FPFIS-API-PHP-SDK/0.1';
            $this->httpClient->options['curl_options'] = [];
            $this->pskValidator = new PSKValidator($secret, 'sha256');
            $this->setEndpoint($endpoint);
            $this->setApplicationId($applicationId);
        }


        /**
         * Sets the endpoint
         * @param $endpoint
         */
        public function setEndpoint($endpoint)
        {
            $this->httpClient->options['base_url'] = $endpoint;
        }

        /**
         * Sets the application id
         * @param $applicationId
         */
        public function setApplicationId($applicationId)
        {
            $this->httpClient->options['headers']['x-fpfis-app-id'] = $applicationId;
        }

        /**
         * Send an API request
         *
         * @param $path
         * @param array $options
         */
        public function send($path, $options = [])
        {
            $options = json_encode($options);
            /**
             * Set the signature header :
             */
            $this->httpClient->options['headers']['x-fpfis-signature'] =
                $this->pskValidator->sign($this->httpClient->options['base_url'].$path.$options);
            /**
             * Post the request and return results
             */
            return $this->httpClient->post($path, $options);
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
            return $this->send('/auth/test')['status'] === 200;
        }
    }
}
