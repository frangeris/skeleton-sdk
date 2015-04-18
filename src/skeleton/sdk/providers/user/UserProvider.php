<?php namespace Skeleton\SDK\Providers\User;

use Skeleton\SDK\Common\Supplier\ISupplier,
	Skeleton\SDK\Common\Client,
	Skeleton\SDK\Providers\AbstractProvider
	;

/**
 * Provider for user resource
 */
class UserProvider extends AbstractProvider implements ISupplier
{
	public function create($provider)
	{
		$response = $this->skeleton->post('/users', $this->fragment($provider));
		return $response->getBody();
	}

	public function read()
	{
		$response = $this->skeleton->get('/users');
		return $response->getBody();
	}

	public function update($provider)
	{}

	public function delete($id)
	{}

	public function getById($id)
	{}
}
