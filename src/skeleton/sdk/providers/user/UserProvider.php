<?php namespace Skeleton\SDK\Providers\User;

use Skeleton\SDK\Common\Supplier\ISupplier,
	Skeleton\SDK\Common\Client,
	Skeleton\SDK\Providers\AbstractProvider
	;

/**
 * Provider for user resource
 *
 * @author Frangeris Peguero <frangerisp@mctekk.com>
 */
class UserProvider extends AbstractProvider implements ISupplier
{
	public function all()
	{
		$response = $this->client->get('http://guzzlephp.org');

		echo $response->getHeader('content-type')."\n";

		// $this->send();
	}

	public function getById($id)
	{
		print "getById()\n";

		$response = $this->send();
	}

	public function create($provider)
	{}

	public function update($provider)
	{}

	public function delete($id)
	{}
}