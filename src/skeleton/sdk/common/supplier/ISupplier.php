<?php namespace Skeleton\SDK\Common\Supplier;

use Skeleton\SDK\Common\Client;

/**
 * Common interface for all provicers (CRUD)
 */
interface ISupplier
{
	/**
	 * Create a resource
	 *
	 * @param object|array $entity New entity to create
	 * @return boolean State of the transaction
	 */
	public function create($entity);

	/**
	 * Get all the resources
	 *
	 * @param array $filter Array of options to apply to query filter [optional]
	 * @return string json
	 */
	public function read($filter = null);

	/**
	 * Update a resouce
	 *
	 * @param object|array $entity Resource to update
	 * @return boolean State of the transaction
	 */
	public function update($id, $entity);

	/**
	 * Delete a resource
	 *
	 * @param int $id Id of the resource to remove
	 * @return boolean State of the transaction
	 */
	public function delete($id);

	/**
	 * Get the resource by id
	 *
	 * @param string $id Identifier
	 * @return string json
	 */
	public function getById($id);
}