<?php namespace Skeleton\SDK\Providers;

/**
 * Common class for all providers
 */
abstract class AbstractProvider
{
	public function __construct(Client $client)
	{
		$this->client = $client;
	}
}
