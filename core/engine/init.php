<?php

namespace core\engine;

require_once APP . 'helpers/SeoTrait.php';
require_once APP . 'functions/function.lang.php';

// get languages
$language = include_once(RESOURCES . 'lang/en-gb/en-gb.php');

use app\helpers\SeoTrait as HelpersSeoTrait;

/**
 * init
 */
class init
{
    use HelpersSeoTrait;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        spl_autoload_register([$this, 'autoload']);

        $this->parseRequest();

        $this->route();
    }

    /**
     * autoload
     *
     * @param  mixed $class
     * @return void
     */
    public function autoload($class)
    {
        $classFile = str_replace('\\', '/', $class) . '.php';
        
        if (file_exists($classFile)) {
            require_once $classFile;
        }
    }
}
