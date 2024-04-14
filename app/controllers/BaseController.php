<?php

namespace app\controllers;

// use core\View;

use app\core\Redirect;
use app\core\Setting;
use app\core\validation\Validation;

class BaseController
{
    /**
     * @var string Server Request method like GET,POST is save under this variable
     */
    protected $requestMethod;

    /**
     * @var array|string $_REQUEST data is save under this variable
     */
    protected $requestParam;

    /**
     * @var array|string $_SERVER data is save under this variable
     */
    protected $server;

    protected $registry;

    protected $redirect;

    protected $setting;

    /**
     * BaseController constructor.
     *
     */
    public function __construct()
    {    
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
        $this->requestParam = $_REQUEST;
        $this->server = $_SERVER;
        $this->redirect = new Redirect();
        $this->setting = new Setting();
    }
}
