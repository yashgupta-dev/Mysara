<?php
namespace app\core;

/**
 * Registry
 */
class Registry
{
    private static $registry = [];
    
    /**
     * set
     *
     * @param  mixed $key
     * @param  mixed $value
     * @return void
     */
    public static function set($key, $value)
    {
        self::$registry[$key] = $value;
    }
    
    /**
     * get
     *
     * @param  mixed $key
     * @return void
     */
    public static function get($key)
    {
        return isset(self::$registry[$key]) ? self::$registry[$key] : null;
    }
    
    /**
     * has
     *
     * @param  mixed $key
     * @return void
     */
    public static function has($key)
    {
        return isset(self::$registry[$key]);
    }
    
    /**
     * remove
     *
     * @param  mixed $key
     * @return void
     */
    public static function remove($key)
    {
        if (self::has($key)) {
            unset(self::$registry[$key]);
        }
    }
}
