<?php namespace Skeleton\SDK\Common\Client;

use GuzzleHttp\Client;

/**
 * Abstract client
 *
 * @author Frangeris Peguero <frangerisp@mctekk.com>
 */
abstract class AbstractClient extends Client
{
	/**
	 * Api version used for RESTful
	 */
	const API_VERSION = 'v1';

	/**
	 * API credentials
	 * 
	 * @var array
	 */
	private $credentials;

	/**
	 * Methods allowed for signature
	 * 
	 * @var array
	 */
	private $methods = ['hmac'];

	/**
	 * Get the version
	 * 
	 * @return string Version del api usada
	 */
    public function getApiVersion()
    {
    	return self::API_VERSION;
    }

    /**
     * Set the credencials for authentication
     *
     */
    public function setCredentials(array $credentials)
	{
		print "setCredentials()\n";

		// Verify that method is provided
		if (!isset($credentials['method']))
			throw new InvalidAuthenticateMethod("Invalid authentification method, you must provide one");
		
		// Verify that exists
		if (!in_array($credentials['method'], $this->methods))
			throw new UnknownAuthenticateMethod("Unknown authentification method");

		$this->credentials = $credentials;

		return $this;
	}

	/**
	 * Getter
	 * 
	 * @return array
	 */
	public function getCredentials()
	{
		return $this->credentials;
	}
}