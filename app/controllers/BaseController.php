<?php

namespace app\controllers;

use app\core\Setting;
use core\engine\Session;
use app\traits\DefaultTrait;
// use app\controllers\middleware\traits\AuthMiddleware;
use app\controllers\middleware\MiddlewarePipeline;

class BaseController
{
    use DefaultTrait;

    /**
     * error
     *
     * @var mixed
     */
    protected $error;

    protected $model;
    
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
        $this->setting = new Setting;
    }

    protected function executeMiddleware($request, $middlewares) {
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


}
