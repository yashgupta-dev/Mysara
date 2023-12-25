<?php

namespace app\core;

class Session
{    
    /**
     * start
     *
     * @return void
     */
    public static function start()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    /**
     * set
     *
     * @param  mixed $key
     * @param  mixed $value
     * @return void
     */
    public static function set($key, $value)
    {
        self::start();
        $_SESSION[$key] = $value;
    }
    
    /**
     * get
     *
     * @param  mixed $key
     * @return void
     */
    public static function get($key)
    {
        self::start();
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return null;
    }
    
    /**
     * remove
     *
     * @param  mixed $key
     * @return void
     */
    public static function remove($key)
    {
        self::start();
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
    
    /**
     * destroy
     *
     * @return void
     */
    public static function destroy()
    {
        self::start();
        session_unset();
        session_destroy();
    }
}
