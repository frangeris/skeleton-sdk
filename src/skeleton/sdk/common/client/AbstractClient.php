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
	 * Get the version
	 * 
	 * @return string Version del api usada
	 */
    public function getApiVersion()
    {
    	return self::API_VERSION;
    }
}