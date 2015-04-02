<?php namespace Skeleton\SDK\Comun\Supplier;

/**
 * Interface commun for all proviers
 *
 * @author Frangeris Peguero <frangerisp@mctekk.com>
 */
interface ISupplier
{
	/**
	 * Get all the resources
	 */
	public function all();

	/**
	 * Get the resource by id
	 * 
	 * @param string $id Identifier
	 * @return IModel
	 */
	public function getById($id);

	/**
	 * Create a resource
	 * 
	 * @param IModel $proveedor Nuevo proveedor a crear
	 * @return boolean Estado de la transaccion
	 */
	public function create(IModel $proveedor);

	/**
	 * Update a resouce
	 * 
	 * @param IModel $proveedor Nuevo proveedor a crear
	 * @return boolean Estado de la transaccion
	 */	
	public function update(IModel $proveedor);

	/**
	 * Delete a resource
	 * 
	 * @param IModel|string $proveedor Instancia del proveedor a eliminar o uuid que lo identifique
	 * @return boolean Estado de la transaccion
	 */	
	public function delete($proveedor);	
}