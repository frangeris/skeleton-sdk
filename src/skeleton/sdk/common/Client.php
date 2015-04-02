<?php namespace Skeleton\SDK\Common;

use Skeleton\SDK\Common\Client\AbstractClient;

/**
 * Client used by providers for request to api
 *
 * @author Frangeris Peguero <frangerisp@mctekk.com>
 */
class Client extends AbstractClient
{
	use \Skeleton\SDK\Common\Factory\Manager;
}