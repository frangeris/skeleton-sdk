<?php namespace Skeleton\SDK\Providers\User;

use Skeleton\SDK\Common\Supplier\ISupplier,
	Skeleton\SDK\Common\Client,
	Skeleton\SDK\Providers\AbstractProvider;

/**
 * Provider for user resource
 *
 * @author Frangeris Peguero <frangerisp@mctekk.com>
 */
class UserProvider extends AbstractProvider implements ISupplier
{
	public function all()
	{
		print "all()\n";
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