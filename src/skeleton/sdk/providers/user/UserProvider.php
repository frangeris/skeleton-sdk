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
	public function all()
	{
		$response = $this->skeleton->get('/test', ['param' => 'valor']);
		var_dump($response->json());
	}

	public function getById($id)
	{}

	public function create($provider)
	{}

	public function update($provider)
	{}

	public function delete($id)
	{}
}