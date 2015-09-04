<?php

namespace Skeleton\SDK\Common\Client;

use GuzzleHttp\Client;

/**
 * Abstract client.
 *
 * @author Frangeris Peguero <frangerisp@mctekk.com>
 */
abstract class AbstractClient extends Client
{
    /**
     * API credentials.
     *
     * @var array
     */
    private $config;

    /**
     * Methods allowed for signature.
     *
     * @var array
     */
    private $methods = ['hmac'];

    /**
     * Set the configuration for authentication.
     *
     * @todo
     *		- Add exception type for base url undefined
     *		- Validate the base_url[0] is a valid url
     */
    public function setConfig(array $config)
    {
        // Verify that method is provided
        if (!isset($config['method'])) {
            throw new InvalidAuthenticateMethod('Invalid authentification method, you must provide one');
        }

        // Verify that exists
        if (!in_array($config['method'], $this->methods)) {
            throw new UnknownAuthenticateMethod('Unknown authentification method');
        }

        // Create the url to request using base_url parameter
        if (!isset($config['base_url'][0])) {
            throw new \Exception('Error processing, invalid base url provided, it must be the first one parameter without index, at position [0]', 1);
        }

        $this->config = $config;

        return $this;
    }

    /**
     * Getter.
     *
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }
}
