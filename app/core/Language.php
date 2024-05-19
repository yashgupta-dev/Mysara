<?php

namespace app\core;

use core\engine\Session;

class Language
{

    public static function load($controllerName)
    {
        $lang = !empty(Session::get('language')) ? Session::get('language') : 'en-gb'; // Default language

        if (file_exists(RESOURCES . 'lang/' . $lang . '/' . strtolower($controllerName) . '.php')) {
            return include_once(RESOURCES . 'lang/' . $lang . '/' . strtolower($controllerName) . '.php');
        }


        return [];
    }
}
