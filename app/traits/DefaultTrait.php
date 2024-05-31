<?php

namespace app\traits;

use app\core\Tygh;
use app\controllers\function\functions;
use app\core\Redirect;
use app\core\Setting;

trait DefaultTrait
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
     * @var array|string $_POST data is save under this variable
     */
    protected $post;

    /**
     * @var array|string $_GET data is save under this variable
     */
    protected $get;

    /**
     * @var array|string $_FILES data is save under this variable
     */
    protected $files;

    /**
     * @var array|string $_SERVER data is save under this variable
     */
    protected $server;
    
    /**
     * registry
     *
     * @var object
     */
    protected $registry;

    protected $redirect;
    
    /**
     * setting
     *
     * @var object|array|string|json
     */
    protected $setting;
    
    protected $session;
        
    /**
     * setRequestMethod
     *
     * @return array
     */
    public function setRequestMethod() {
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
    }
    
    /**
     * setRequest
     *
     * @return array
     */
    public function setRequest() {
        $this->requestParam = $_REQUEST;
    }
    
    /**
     * setPost
     *
     * @return array
     */
    public function setPost() {
        $this->post = $_POST;
    }
    
    /**
     * setGet
     *
     * @return array
     */
    public function setGet() {
        $this->get = $_GET;
    }
    
    /**
     * setFiles
     *
     * @return array
     */
    public function setFiles() {
        $this->files = $_FILES;
    }
    
    /**
     * setServer
     *
     * @return array
     */
    public function setServer() {
        $this->server = $_SERVER;
    }
    
    /**
     * setRedirect
     *
     * @return object|array
     */
    public function setRedirect() {
        $this->redirect = new Redirect();
    }
    
    /**
     * functions
     *
     * @return object|array
     */
    public function functions() {
        Tygh::assign('func',new functions);
        Tygh::assign('session',$_SESSION);
        Tygh::assign('config',new Setting);
    }



}