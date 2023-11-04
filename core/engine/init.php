<?php

namespace core\engine;

use app\core\DB;
use app\core\Tygh;
use app\functions\lang;

require_once APP.'functions/function.lang.php';

// get language
$language = include_once(RESOURCES.'lang/en-gb/en-gb.php');

/**
 * init
 */
class init
{    
    /**
     * myController
     *
     * @var mixed
     */
    private $myController = Default_controller;
        
    /**
     * myMethod
     *
     * @var mixed
     */
    private $myMethod = Default_method;
        
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
    private $type = FRONTEND;
        
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
        $this->reWriteUrl();
    }

    /**
     * Associative array of routes (the routing table)
     * @var array
     */
    protected static $routes = [];

    /**
     * Parameters from the matched route
     * @var array
     */
    protected static $params = [];

    /**
     * Add a route to the routing table
     *
     * @param string $route  The route URL
     * @param array  $params Parameters (controller, action, etc.)
     *
     * @return void
     */
    public static function add($route, $params = [])
    {
        // Convert the route to a regular expression: escape forward slashes
        $route = preg_replace('/\//', '\\/', $route);

        // Convert variables e.g. {controller}
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

        // Convert variables with custom regular expressions e.g. {id:\d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        // Add start and end delimiters, and case insensitive flag
        $route = '/^' . $route . '$/i';

        self::$routes[$route] = $params;
    }

    /**
     * Get all the routes from the routing table
     *
     * @return array
     */
    public static function getRoutes()
    {
        return self::$routes;
    }

    /**
     * Match the route to the routes in the routing table, setting the $params
     * property if a route is found.
     *
     * @param string $url The route URL
     *
     * @return boolean  true if a match found, false otherwise
     */
    public static function match($url)
    {
        foreach (self::$routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                // Get named capture group values
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }

                self::$params = $params;
                return true;
            }
        }

        return false;
    }

    /**
     * Get the currently matched parameters
     *
     * @return array
     */
    public static function getParams()
    {
        return self::$params;
    }

    /**
     * Dispatch the route, creating the controller object and running the
     * action method
     *
     * @param string $url The route URL
     *
     * @return void
     */
    public static function dispatch($url = '')
    {
        $url = $_SERVER['QUERY_STRING'];
        $url = self::removeQueryStringVariables($url);

        if (self::match($url)) {
            $controller = self::$params['controller'];
            $controller = self::convertToStudlyCaps($controller);
            $controller = self::getNamespace() . $controller;

            echo $controller;
            
            if (class_exists($controller)) {
                $controller_object = new $controller(self::$params);

                $action = self::$params['action'];
                $action = self::convertToCamelCase($action);

                if (preg_match('/action$/i', $action) == 0) {
                    $controller_object->$action();
                } else {
                    throw new \Exception("Method $action in controller $controller cannot be called directly - remove the Action suffix to call this method");
                }
            } else {
                throw new \Exception("Controller class $controller not found");
            }
        } else {
            throw new \Exception('No route matched.', 404);
        }
    }

    /**
     * Convert the string with hyphens to StudlyCaps,
     * e.g. post-authors => PostAuthors
     *
     * @param string $string The string to convert
     *
     * @return string
     */
    protected static function convertToStudlyCaps($string)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    /**
     * Convert the string with hyphens to camelCase,
     * e.g. add-new => addNew
     *
     * @param string $string The string to convert
     *
     * @return string
     */
    protected static function convertToCamelCase($string)
    {
        return lcfirst(self::convertToStudlyCaps($string));
    }

    /**
     * Remove the query string variables from the URL (if any).
     *
     * @param string $url The full URL
     *
     * @return string The URL with the query string variables removed
     */
    protected static function removeQueryStringVariables($url)
    {
        if ($url != '') {
            $parts = explode('&', $url, 2);

            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }

        return $url;
    }

    /**
     * Get the namespace for the controller class. The namespace defined in the
     * route parameters is added if present.
     *
     * @return string The request URL
     */
    protected static function getNamespace()
    {
        $namespace = 'app\controllers\\';

        if (array_key_exists('namespace', self::$params)) {
            $namespace .= self::$params['namespace'] . '\\';
        }

        return $namespace;
    }

    /**
     * withoutHtaccess
     *
     * @return void
     */
    protected function reWriteUrl()
    {
        $url = $_SERVER['REQUEST_URI'];

        // Parse the URL to separate the query parameters
        $urlParts = parse_url($url);

        $classUrl = str_replace('index.php/','',$urlParts['path']);
        
        $urlExplode = (strpos('index.php',$classUrl) === true) ? explode('index.php/', $classUrl) : explode(Parent_folder, $classUrl);
        
        $this->urlExplode = !empty($urlExplode[1]) ? $urlExplode[1] : '';
        
        // seo urls
        $this->seoUrls();
        
        $routeData = explode('/', $this->urlExplode);

        if (count($routeData) > 2) {

            // Get the last element
            $lastElement = array_pop($routeData);

            // Implode the remaining elements
            $implodedString = implode('/', $routeData);

            if (!empty($implodedString)) {
                $this->myController = $implodedString;
            }
    
            if (!empty($lastElement) && $lastElement != '') {
                $this->myMethod = $lastElement;
            }
            if (!empty($urlParts['query']) && $urlParts['query'] != '') {
                $this->pramater = $urlParts['query'];
            }
        } else {
            if (!empty($routeData[0])) {
                $this->myController = $routeData[0];
            }
    
            if (!empty($routeData[1]) && $routeData[1] != '') {
                $this->myMethod = $routeData[1];
            }
            if (!empty($urlParts['query']) && $urlParts['query'] != '') {
                $this->pramater = $urlParts['query'];
            }
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
        
        if (!file_exists(APP . 'controllers/' . $this->type . '/'. $this->myController . '.php')) {
            $this->flag++;
        }

        if ($this->flag == 0) {
            // Include the controller file
            include(APP . 'controllers/' . $this->type . '/'. $this->myController . ".php");

            // Create an instance of the controller
            $this->myController = str_replace('/','\\',$this->myController);

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
     * seoUrls
     *
     * @return void
     */
    protected function seoUrls()
    {
        // Now, you can use $conn to execute SQL queries and interact with the database
        $res = DB::get()->get->query("SELECT `seo_origin` FROM `seo` WHERE `seo_url` = '" . (string)$this->urlExplode . "' AND `status` = 1")->fetch_assoc();

        $this->urlExplode = $res['seo_origin'] ?? $this->urlExplode;
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
