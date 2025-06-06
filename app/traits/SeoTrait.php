<?php

namespace app\traits;

use app\core\DB;
use app\core\Tygh;
use app\core\Request;
use app\core\Redirect;
use app\core\Registry;
// use app\core\SessionManager;

trait SeoTrait
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
    private $pramater = [];

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

    public $registry;
    /**
     * parseRequest
     *
     * @return void
     */
    private function parseRequest()
    {
        $this->registry = new Registry();
        $this->registryLoad();
        // $sessionManager = new SessionManager(DB::get());
        // session_start();  
              
        $this->reWriteUrl();
    }
    
    /**
     * registryLoad
     *
     * @return void
     */
    public function registryLoad() {

        // $this->registry->set('redirect', new Redirect());
        // $this->registry->set('request', new Request());
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

        $classUrl = str_replace('index.php/', '', $urlParts['path']);

        $urlExplode = (strpos('index.php', $classUrl) === true) ? explode('index.php/', $classUrl) : explode(Parent_folder, $classUrl);
        
        $this->urlExplode = !empty($urlExplode[1]) ? $urlExplode[1] : $urlExplode[0];

        // seo urls
        $this->seoUrls();

        $urlExplode = preg_replace('/[^a-zA-Z0-9_\/]/', '', (string)$this->urlExplode);
        
        $urlExplodeArray = explode('/', ($urlExplode) ? $urlExplode : Default_controller);

        // Capitalize the first character of each element in the exploded array
        foreach ($urlExplodeArray as &$element) {
            $element = ucfirst($element);
        }

		// Break apart the route
		while ($urlExplodeArray) {
			$file = APP . 'controllers/' . $this->type . '/'  . implode('/', $urlExplodeArray) . '.php';
            
			if (is_file($file)) {
                
				$this->myController = implode('/', $urlExplodeArray);						
				break;
			} else {
				$this->myMethod = array_pop($urlExplodeArray);
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

        if (!file_exists(APP . 'controllers/' . $this->type . '/' . $this->myController . '.php')) {
            $this->flag++;
        }

        if ($this->flag == 0) {
            
            // Include the controller file

            $file = APP . 'controllers/' . $this->type . '/' .  $this->myController . ".php";
            // Create an instance of the controller
            $this->myController = str_replace('/', '\\', $this->myController);
            
            $controllerClass = '\\app\\controllers\\' . $this->type . '\\' . $this->myController;

            // Initialize the class
            if (is_file($file)) {
                include_once($file);
                
                $controller = new $controllerClass();
            } else {
                // Handle method not found
                Tygh::assign("title", '500 | Internal server');
                Tygh::assign("code", '500');
                Tygh::assign("btn_text", 'Go to homepage');
                Tygh::assign("msg", 'Error: Could not call ' . $this->myController . '/' . $this->myMethod . '!');

                Tygh::display('errors/500.tpl');
            }
            
            // $CallingtheController = new $controllerClass($this->registry);
            $reflection = new \ReflectionClass($controller);
            
            if ($reflection->hasMethod($this->myMethod) && $reflection->getMethod($this->myMethod)->getNumberOfRequiredParameters() <= count($this->pramater)) {
                return call_user_func_array(array($controller, $this->myMethod), $this->pramater);
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

        $seoURL = explode('/', $this->urlExplode, 2)[1] ?? $this->urlExplode;

        // Now, you can use $conn to execute SQL queries and interact with the database
        $res = DB::get()->get->query("SELECT `seo_origin` FROM `seo` WHERE `seo_url` = '" . (string)
        $seoURL . "' AND `status` = 1")->fetch_assoc();
        
        if(!empty($res['seo_origin'])){
            
            if(strpos($res['seo_origin'], '=') !== false){
                $parts = explode('=', $res['seo_origin']);
                parse_str($res['seo_origin'], $params); // Convert to array
                // Assign all parameters to $_GET
                foreach ($params as $key => $value) {
                    $_REQUEST[$key] = $value;
                }
                
                if(!empty($parts[0]) && $parts[0] === 'category_id'){
                    $this->urlExplode = 'product/category';                    
                } elseif(!empty($parts[0]) && $parts[0] === 'product_id'){
                    $this->urlExplode = 'product/product';
                } elseif(!empty($parts[0]) && $parts[0] === 'page_id'){
                    $this->urlExplode = 'page/page';
                } elseif(!empty($parts[0]) && $parts[0] === 'blog_id'){
                    $this->urlExplode = 'blog/blog';
                } elseif(!empty($parts[0]) && $parts[0] === 'article_id'){
                    $this->urlExplode = 'article/article';
                } else {
                    $this->urlExplode = $res['seo_origin'];
                }

            }
        } else {
            $this->urlExplode = $seoURL;
        }
    }
}
