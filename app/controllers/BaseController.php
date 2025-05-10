<?php

namespace app\controllers;

use app\core\Setting;
use core\engine\Session;
use app\traits\DefaultTrait;
use app\controllers\middleware\MiddlewarePipeline;
use app\model\Common;
use app\traits\LanguageTrait;

class BaseController
{
    use DefaultTrait, LanguageTrait;

    /**
     * model
     *
     * @var mixed
     */
    protected $model;

    protected $common;

    protected $setting;

    /**
     * BaseController constructor.
     *
     */
    public function __construct()
    {
        $this->setRequestMethod();
        $this->setRequest();
        $this->setPost();
        $this->setGet();
        $this->setFiles();
        $this->setServer();
        $this->setRedirect();
        $this->functions();
        $this->loadLanguage();
        $this->setting = new Setting;
        $this->common  = new Common;
    }

    protected function executeMiddleware($request, $middlewares)
    {
        // Create instances of middleware
        $middlewareInstances = [];

        // Create an instance of the controller

        foreach ($middlewares as $middlewareClass) {
            $Class = '\\app\\controllers\\middleware\\' . $middlewareClass;

            $middlewareInstances[] = new $Class;
        }

        // Create a middleware pipeline with the middleware in the desired order
        $pipeline = new MiddlewarePipeline($middlewareInstances);

        // Execute the middleware pipeline
        return $pipeline->handle($request);
    }

    /**
     * @param array $runMode
     *
     * @return void
     */
    protected function setNoPage()
    {
        // $url = fn_url('_no_page?' . http_build_query(array('page' => $_SERVER['REQUEST_URI'])), 'rel');
        // $_REQUEST['redirect_url'] = $url;
    }
}
