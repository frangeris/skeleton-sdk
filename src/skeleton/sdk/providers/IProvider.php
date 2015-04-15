<?php namespace Skeleton\SDK\Providers;

/**
 * Common interface for all abstract provicers
 */
interface IProvider
{
	/**
	 * Used for make HTTP GET request
	 *
	 * @param string $resource Resource to call eg. /users
	 * @param array $fields Custom fields for query parameters
	 * @return GuzzleHttp\Message\Response Response message from http call using guzzle
	 */
	public function get($resource, array $fields = null);

	

}