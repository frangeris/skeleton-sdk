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
	 * @param \Skeleton\SDK\Common\Client $client
	 * @return void
	 */
	public function __construct(\Skeleton\SDK\Common\Client $client)
	{
		$this->client = $client;
	}

	/**
	 * Send the request
	 *
	 * @return void
	 */
	protected function send($method, $url, array $fields = null)
	{
		$request = $this->client->createRequest(strtoupper($method), $url);

		// Proceed with the signature
		$credentials = $this->client->getCredentials();
		switch ($credentials['method']) 
		{
			case 'hmac':
				Hmac::init($this->client, $request);
				break;
		}

		$response = $this->client->send($request);

		var_dump($response->getStatusCode());

		die();

		return $request;

		// Make de request using guzzel client

		// $client->get('http://httpbin.org/get', [
		// 	'headers' => ['X-Foo-Header' => 'value']
		// ]);
	}
}
