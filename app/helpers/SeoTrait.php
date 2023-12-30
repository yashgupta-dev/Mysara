<?php

namespace app\helpers;

use app\core\DB;
use app\core\Tygh;

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
     * parseRequest
     *
     * @return void
     */
    private function parseRequest()
    {
        $this->reWriteUrl();
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

        if (!file_exists(APP . 'controllers/' . $this->type . '/' . $this->myController . '.php')) {
            $this->flag++;
        }

        if ($this->flag == 0) {
            // Include the controller file

            include(APP . 'controllers/' . $this->type . '/' . $this->myController . ".php");

            // Create an instance of the controller
            $this->myController = str_replace('/', '\\', $this->myController);

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
        $seoURL = explode('/', $this->urlExplode, 2)[1] ?? $this->urlExplode;

        // Now, you can use $conn to execute SQL queries and interact with the database
        $res = DB::get()->get->query("SELECT `seo_origin` FROM `seo` WHERE `seo_url` = '" . (string)$seoURL . "' AND `status` = 1")->fetch_assoc();

        $this->urlExplode = $res['seo_origin'] ?? $seoURL;
    }
}
