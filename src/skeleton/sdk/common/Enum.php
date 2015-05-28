<?php namespace Skeleton\SDK\Common;

/**
 * Represent a set of enum values
 *
 * @author Frangeris Peguero <frangerisp@mctekk.com>
 */
abstract class Enum
{
    /**
     * Cache for values, increase performance
     *
     * @var array
     */
    protected static $cache = array();

    /**
     * Get all keys
     *
     * @return array
     */
    public static function keys()
    {
        return array_keys(static::values());
    }

    /**
     * Get all values
     *
     * @return array
     */
    public static function values()
    {
        $class = get_called_class();
        if (!isset(self::$cache[$class]))
        {
            $reflected = new \ReflectionClass($class);
            self::$cache[$class] = $reflected->getConstants();
        }

        return self::$cache[$class];
    }
}