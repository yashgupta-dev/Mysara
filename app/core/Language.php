<?php

namespace app\core;

use core\engine\Session;
use app\traits\DirectoryTrait;

class Language
{

    public static function load($controllerName)
    {
        $lang = !empty(Session::get('language')) ? Session::get('language') : 'en-gb'; // Default language

        
        $controllerName = explode("controllers\\",$controllerName)[1] ?? $controllerName;
        
        $languagePath = RESOURCES . 'lang/' . $lang . '/' . strtolower(str_replace('\\','/',$controllerName)) . '.php';
        if (file_exists($languagePath)) {
            
            return include_once($languagePath);
        }


        return [];
    }
}
