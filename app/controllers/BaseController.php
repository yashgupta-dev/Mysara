<?php

namespace app\controllers;

// use core\View;
use app\model\MyModel;
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
     * @var object this variable is used to run the model method in class.
     */
    protected $loadModel;

    /**
     * BaseController constructor.
     *
     * @param string $mode
     */
    public function __construct()
    {
        $this->loadModel = new MyModel(); // model
    
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];

        $this->requestParam = $_REQUEST;
    }
}
