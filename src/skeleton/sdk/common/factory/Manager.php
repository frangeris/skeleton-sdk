<?php

namespace Skeleton\SDK\Common\Factory;

/**
 * Manager of unique instances.
 *
 * @author Frangeris Peguero <frangerisp@mctekk.com>
 */
trait Manager
{
    /**
     * Pool for unique instances.
     *
     * @staticvar array
     *
     * @todo
     *		- implement SplObserver
     */
    private static $pool = array();

    /**
     * Allow get just one instance new/exiting saved on the pool.
     *
     * @param string $class_name Name of the class to get the instance
     *
     * @throws InvalidClassException If the constructor is not protected
     *
     * @return mixed
     */
    final public static function getInstance($class_name = null)
    {
        if (is_null($class_name)) {
            $class_name = get_called_class();
        }

        $reflection = new \ReflectionClass($class_name);
        if (!$reflection->isInstantiable()) {
            throw new \Exception("The constructor of the class '$class_name' must be protected", 1);
        }

        if (empty(self::$pool[$class_name])) {
            self::$pool[$class_name] = new $class_name();
        }

        return self::$pool[$class_name];
    }
}
