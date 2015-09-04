<?php

namespace Skeleton\SDK\Providers;

use Skeleton\SDK\Common\Signature\Method\Hmac;
use Skeleton\SDK\Common\Exception\InvalidFragmentsParameter;
use GuzzleHttp\Message\Request;
use GuzzleHttp\Stream\Stream;

/**
 * Common class for all providers.
 */
abstract class AbstractProvider
{
    /**
     * Instance of current provider.
     *
     * @var Skeleton\SDK\Providers\AbstractProvider
     */
    protected $skeleton;

    /**
     * @var
     */
    protected $request;

    /**
     * __construct.
     *
     * @param Skeleton\SDK\Common\Client $client
     */
    public function __construct($client)
    {
        $this->client = $client;
        $this->skeleton = $this;
    }

    private function init($method, $resource)
    {
        // Setting up the config
        $config = $this->client->getConfig();
        $this->request = $this->client->createRequest(strtoupper($method), $this->buildUrl($config['base_url']));

        // Appending the resource to base url
        $this->request->setUrl($this->request->getUrl().$resource);
    }

    /**
     * Build url using parameters as fragments.
     *
     * @param array $fragments Assosiative array of parameters to make the replacement
     *
     * @return string Final url formed
     *
     * @throws InvalidFragmentsParameter Invalid parameters as fragments
     */
    final protected function buildUrl($fragments)
    {
        // Verify url path
        if (!isset($fragments[0])) {
            throw new InvalidFragmentsParameter('Invalid base url structure, http:// path must exists at position [0]', 1);
        }

        // Cleaning up
        $url = $fragments[0];
        unset($fragments[0]);

        // Begin process for make replacements
        if (isset($fragments[1]) && is_array($fragments[1])) {
            $replacements = [];
            $params = $fragments[1];

            // Add { } to each element of the array
            array_walk($params, function (&$item, $key) use (&$replacements) {
                $replacements['{'.$key.'}'] = $item;
            });
        }

        return str_replace(array_keys($replacements), array_values($replacements), $url);
    }

    /**
     * Process the signature adding.
     *
     * @param Skeleton\SDK\Common\Client &$client Reference of the client
     */
    private function processSignature(\Skeleton\SDK\Common\Client &$client)
    {
        // Proceed with the signature
        switch ($this->client->getConfig()['method']) {
            case 'hmac':
                Hmac::init($client, $this->request);
                break;
        }
    }

    /**
     * Fragment and object into an array.
     *
     * @param mixed $object Object to fragment
     *
     * @return array Vars inside the object
     */
    protected function fragment($object)
    {
        return get_object_vars($object);
    }

    /**
     * Make the call using guzzle.
     *
     * @return Response of the request
     */
    private function call()
    {
        // Process the signature
        $this->processSignature($this->client);

        try {
            // Make the request using guzzle
            $response = $this->client->send($this->request);
        } catch (\Exception $ex) {
            return $ex->getResponse();
        }

        return $response;
    }

    /**
     * Send GET http request.
     *
     * @param string $resource Resouce to call eg. /users
     * @param array  $fields   Fields to send using query parameters
     *
     * @return Response of the request
     *
     * @todo
     */
    final protected function get($resource, array $fields = null)
    {
        // Initilize the request as post
        $this->init('get', $resource);

        // If exists query fields, append it
        if (is_array($fields)) {
            $query = $this->request->getQuery();
            foreach ($fields as $param => $value) {
                $query->set($param, $value);
            }
        }

        // Make the request using guzzle
        return $this->call();
    }

    /**
     * Send POST http request.
     *
     * @param string $resource Resource to call eg. /users
     * @param mixed  $fields   Fields to send using post paramters
     *
     * @return Response of the request
     */
    final protected function post($resource, $fields)
    {
        // Initilize the request as post
        $this->init('post', $resource);

        // Is an object
        if (!is_array($fields)) {
            $fields = $this->fragment($fields);
        }

        // Setting the fields to request
        $body = $this->request->getBody();
        foreach ($fields as $key => $value) {
            $body->setField($key, (string) $value);
        }

        // Make the request using guzzle
        return $this->call();
    }

    /**
     * Send PUT http request.
     *
     * @param string $resource Resource to call eg. /users/1
     * @param mixed  $data     Fields to send using put paramters
     *
     * @return Response of the request
     */
    final protected function put($resource, $data)
    {
        // Initilize the request as put
        $this->init('put', $resource);

        // Is an object
        if (!is_array($data)) {
            $data = $this->fragment($data);
        }

        // Setting the fields to request
        $data = Stream::factory(json_encode($data));
        $body = $this->request->setBody($data);

        // Make the request using guzzle
        return $this->call();
    }

    /**
     * Send DELETE http request.
     *
     * @param string $resource Resource to call eg. /users/1
     *
     * @return Response of the request
     */
    final protected function remove($resource)
    {
        // Initilize the request as post
        $this->init('delete', $resource);

        // Make the request using guzzle
        return $this->call();
    }
}
