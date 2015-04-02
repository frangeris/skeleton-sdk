<?php namespace Skeleton\SDK\Providers;

use Skeleton\SDK\Common\Signature\Method\Hmac;

/**
 * Common class for all providers
 */
abstract class AbstractProvider
{
	/**
	 * Data for create the signature
	 * 
	 * @var mixed
	 */
	protected $data;

	/**
	 * __construct
	 * 
	 * @param \Skeleton\SDK\Common\Client $client [description]
	 * @return void
	 */
	public function __construct(\Skeleton\SDK\Common\Client $client)
	{
		$this->client = $client;
	}

	/**
	 * __destruct
	 *
	 * @return void
	 */
	public function __destruct()
	{
		$credentials = $this->client->getCredentials();

		// Proceed with the authentication
		switch ($credentials['method']) 
		{
			case 'hmac':
				Hmac::init($this->client);
				break;
		}

		// Make de request using guzzel client
	}
}
