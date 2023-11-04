<?php

namespace app\controllers;

// use core\View;
use app\model\MyModel;
use app\core\validation\Validation;

class BaseController
{
    /**
     * @var string mode is the method of the class.
     */
    protected $mode;

    /**
     * @var string Server Request method like GET,POST is save under this variable
     */
    protected $requestMethod;

    /**
     * @var array|string $_REQUEST data is save under this variable
     */
    protected $requestParam;

    /**
     * @var array this variable stores all the mode which will be able to run under this class
     */
    protected $runMode = array();

    /**
     * @var object this variable is used to return the response.
     */
    public $response;

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
