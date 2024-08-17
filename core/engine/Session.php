<?php

namespace core\engine;

use app\core\DatabaseSessionHandler;

class Session
{
    protected static $handler;

    public static function init()
    {
        self::$handler = new DatabaseSessionHandler();
        session_set_save_handler(self::$handler, true);
        self::start();
    }

    public static function start()
    {
        session_start();
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public static function remove($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    public static function getSessionId() {
        return session_id();
    }

    public static function destroy()
    {
        session_destroy();
    }
}
