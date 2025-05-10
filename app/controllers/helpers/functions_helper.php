<?php

use app\controllers\functions\functions;
use app\core\Setting;

if (!function_exists('func')) {
    function func() {
        static $instance = null;

        if ($instance === null) {
            $instance = new functions();
        }

        return $instance;
    }
}

if (!function_exists('settings')) {
    function settings() {
        static $instance = null;

        if ($instance === null) {
            $instance = new Setting();
        }

        return $instance;
    }
}