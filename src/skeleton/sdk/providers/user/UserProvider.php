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
	{}

	public function getById($id)
	{}

	public function create($proveedor)
	{}

	public function update($proveedor)
	{}

	public function delete($proveedor)
	{}
}