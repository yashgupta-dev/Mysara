<?php

namespace core\engine;

use app\core\Tygh;
use core\engine\Database;
use app\core\Redirect;

/**
 * startup
 */
class startup
{
    /**
     * myController
     *
     * @var mixed
     */
    private $myController = Default_controller_admin;

    /**
     * myMethod
     *
     * @var mixed
     */
    private $myMethod = Default_method_admin;

    /**
     * pramater
     *
     * @var array
     */
    private $pramater;

    /**
     * type
     *
     * @var mixed
     */
    private $type = BACKEND;

    /**
     * urlExplode
     *
     * @var string
     */
    private $urlExplode = '';

    /**
     * flag
     *
     * @var int
     */
    protected $flag = 0;

    /**
     * db
     *
     * @var mixed
     */
    private $db;

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
     * parseRequest
     *
     * @return void
     */
    private function parseRequest()
    {
        // Parse the URL to get controller, method, and parameter
        $this->withoutHtaccess();
    }

    /**
     * withoutHtaccess
     *
     * @return void
     */
    protected function withoutHtaccess()
    {
        $url = $_SERVER['REQUEST_URI'];

        // Parse the URL to separate the query parameters
        $urlParts = parse_url($url);

        if (!empty($urlParts['query'])) {
            $urlExplode = (strpos('dispatch=', $urlParts['query']) === true) ? explode('dispatch=', $urlParts['query']) : explode('dispatch=', $urlParts['query']);

            $this->urlExplode = !empty($urlExplode[1]) ? $urlExplode[1] : '';

            // paramater ( & )
            $pramater = explode('&', $this->urlExplode);

            // dispatch
            $routeData = explode('/', $pramater[0]);

            if (!empty($routeData[0])) {
                $this->myController = $routeData[0];
            }
            if (!empty($routeData[1]) && $routeData[1] != '') {
                $this->myMethod = $routeData[1];
            }
            if (!empty($pramater) && $pramater != '') {
                $this->pramater = $pramater;
            }
        } else {
            
            Redirect::url('mvc/admin.php?dispatch=dashboard');
        }
    }

    /**
     * route
     *
     * @return void
     */
    public function route()
    {
        $this->myController = ucfirst($this->myController);

        if (!file_exists(APP . 'controllers/' . $this->type . '/' . $this->myController . '.php')) {
            $this->flag++;
        }

        if ($this->flag == 0) {
            // Include the controller file
            include(APP . 'controllers/' . $this->type . '/' . $this->myController . ".php");

            // Create an instance of the controller
            $controllerClass = '\\app\\controllers\\' . $this->type . '\\' . $this->myController;

            $CallingtheController = new $controllerClass();

            // Call the specified method
            if (method_exists($CallingtheController, $this->myMethod)) {
                call_user_func_array([$CallingtheController, $this->myMethod], [$this->pramater]);
            } else {
                // Handle method not found
                // Handle method not found
                Tygh::assign("title", '500 | Internal server');
                Tygh::assign("code", '500');
                Tygh::assign("btn_text", 'Go to homepage');
                Tygh::assign("msg", 'Method not found: ' . $this->myMethod);

                Tygh::display('errors/500.tpl');
            }
        }

        if ($this->flag >= 1) {
            Tygh::assign("title", '404 | Page not found');
            Tygh::assign("code", '404');
            Tygh::assign("btn_text", 'Go to homepage');
            Tygh::assign("msg", '404 - The Page can\'t be found');
            
            Tygh::display('errors/404.tpl'); 
        }
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