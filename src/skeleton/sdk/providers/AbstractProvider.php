<?php namespace Skeleton\SDK\Providers;

use Skeleton\SDK\Common\Signature\Method\Hmac;

/**
 * Common class for all providers
 */
abstract class AbstractProvider
{
	/**
	 * Instance of current provider
	 * 
	 * @var Skeleton\SDK\Providers\AbstractProvider
	 */
	protected $skeleton;

	/**
	 * __construct
	 * 
	 * @param \Skeleton\SDK\Common\Client $client
	 * @return void
	 */
	public function __construct(\Skeleton\SDK\Common\Client $client)
	{
		$this->client = $client;
		$this->skeleton = $this;
	}

	/**
	 * Send the request using configuration
	 *
	 * @return void
	 * @todo
	 		- Verify if the resource string have http://, if have, do not concatenate with base_url
	 */
	protected function get($resource, array $fields = null)
	{		
		$config = $this->client->getConfig();
		$request = $this->client->createRequest('get', $config['base_url']);
		$request->setPath($resource);

		// If exists query fields, append it
		if (is_array($fields)) 
		{
			$query = $request->getQuery();
			foreach ($fields as $param => $value) 
				$query[$param] = $value;
		}

		// Proceed with the signature
		switch ($config['method']) 
		{
			case 'hmac':
				Hmac::init($this->client, $request);
				break;
		}

		// Make the request using guzzle
		$response = $this->client->send($request);

		return $response;
	}
}
