<?php

namespace app\core;

use Smarty;

require_once 'vendor/autoload.php';

/**
 * Tygh
 */
class Tygh
{
    private static $instance;    
    
    /**
     * smarty
     *
     * @var mixed
     */
    private $smarty;
    
    /**
     * __construct
     *
     * @return void
     */
    private function __construct()
    {
        // Initialize Smarty
        $this->smarty = new Smarty;

        // Set template directories and other Smarty configurations
        $this->smarty->setTemplateDir(RESOURCES);
        $this->smarty->setCompileDir(CACHE . 'views/templates_c/');
        $this->smarty->setCacheDir(CACHE . 'views/cache/');
        $this->smarty->addPluginsDir(APP.'functions/');
        $this->smarty->registerPlugin('function', 'fn_link', 'fn_link');
        $this->smarty->registerPlugin('function', 'fn_url', 'fn_url');
        $this->smarty->registerPlugin('function', 'fn_print_r', 'fn_print_r');

    }
    
    /**
     * assign
     *
     * @param  mixed $key
     * @param  mixed $value
     * @return object
     */
    public static function assign($key, $value)
    {
        self::getInstance()->smarty->assign($key, $value);
    }
    
    /**
     * display
     *
     * @param  mixed $file_path
     * @return object
     */
    public static function display($file_path)
    {
        $file_path = (strpos($file_path, '.tpl') === false) ? $file_path . '.tpl' : $file_path;
        self::getInstance()->smarty->display($file_path);
    }

    public static function fetch($file_path) {
        $file_path = (strpos($file_path, '.tpl') === false) ? $file_path . '.tpl' : $file_path;
        return self::getInstance()->smarty->fetch($file_path);
    }
    
    /**
     * getInstance
     *
     * @return object
     */
    private static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Tygh();
        }
        return self::$instance;
    }
}
