<?php

namespace core\engine;

use app\core\Tygh;
use app\core\Redirect;
use core\engine\Session;

require_once APP . 'traits/DirectoryTrait.php';
require_once APP . 'controllers/functions/functions.php';
require_once(APP.'core/DataGrid/src/Http/helpers.php');


use app\traits\DirectoryTrait;

/**
 * startup
 */
class startup
{
    use DirectoryTrait;
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

        // Session::start();     
        Session::init();
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
            $routeData = str_replace('.', '/', $pramater[0]);

            $urlExplode = preg_replace('/[^a-zA-Z0-9_\/]/', '', (string)$routeData);
            $urlExplodeArray = explode('/', $urlExplode);

            // Capitalize the first character of each element in the exploded array
            foreach ($urlExplodeArray as &$element) {
                $element = ucfirst($element);
            }

            // Break apart the route
            while ($urlExplodeArray) {

                if ($this->fileExists(APP . 'controllers/' . $this->type . '/', implode('/', $urlExplodeArray), '.php')) {

                    $this->myController = implode('/', $urlExplodeArray);
                    break;
                } else {
                    $this->myMethod = array_pop($urlExplodeArray);
                }
            }
        } else {

            Redirect::url('admin.php?dispatch=auth.login');
        }
    }

    /**
     * route
     *
     * @return void
     */
    public function route()
    {
        $path = APP . 'controllers/' . $this->type . '/';
        $controllerPath = $this->fileExists($path, $this->myController, '.php');

        if (!$controllerPath) {
            $this->flag++;
        }

        if ($this->flag == 0) {
            // Include the controller file
            include($controllerPath);
            // $this->myController = explode('.php',explode($path,$controllerPath)[1] ?? $controllerPath)[0] ?? $controllerPath;
            // Create an instance of the controller
            $this->myController = str_replace('/', '\\', $this->myController);

            // Create an instance of the controller
            $controllerClass = '\\app\\controllers\\' . $this->type . '\\' . $this->myController;

            $CallingtheController = new $controllerClass();

            // Call the specified method
            if (method_exists($CallingtheController, $this->myMethod)) {
                call_user_func_array([$CallingtheController, $this->myMethod], [$this->pramater]);
            } else {
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
