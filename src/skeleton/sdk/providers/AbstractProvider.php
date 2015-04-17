<?php namespace Skeleton\SDK\Providers;

use Skeleton\SDK\Common\Signature\Method\Hmac,
	Skeleton\SDK\Common\Exception\InvalidFragmentsParameter
	;

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
	 * Build url using parameters as fragments
	 * 
	 * @param array $fragments Assosiative array of parameters to make the replacement
	 * @return string Final url formed
	 * @throws InvalidFragmentsParameter Invalid parameters as fragments
	 */
	protected final function buildUrl($fragments)
	{
		// Verify url path
		if (!isset($fragments[0])) 
			throw new InvalidFragmentsParameter("Invalid base url structure, http:// path must exists at position [0]", 1);
		
		// Cleaning up	
		$url = $fragments[0];
		unset($fragments[0]);

		// Begin process for make replacements
		if (isset($fragments[1]) && is_array($fragments[1]))
		{
			$replacements = [];
			$params = $fragments[1];

			// Add { } to each element of the array
			array_walk($params, function(&$item, $key) use (&$replacements){
				$replacements['{'.$key.'}'] = $item;
				// $item = '{'.$key.'}';
			});
		}

		return str_replace(array_keys($replacements), array_values($replacements), $url);
	}

	/**
	 * {@inheritance}
	 * 
	 * @todo
	 		- Verify if the resource string have http://, if have, do not concatenate with base_url
	 */
	protected final function get($resource, array $fields = null)
	{		
		$config = $this->client->getConfig();
		$request = $this->client->createRequest('get', $this->buildUrl($config['base_url']));
		
		// Appending the resource to base url
		$request->setUrl($request->getUrl() . $resource);
		
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

	protected final function post()
	{}
}
