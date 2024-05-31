<?php

namespace app\controllers\backend\Errors;

use app\core\Tygh;
use app\controllers\BaseController;

class Access extends BaseController
{
    /**
     * __construct
     *
     * @param  mixed $mode
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->executeMiddleware($this->requestParam, ['AuthMiddleware']);
    }
    
    /**
     * index
     *
     * @return void
     */
    public function index() {
        Tygh::assign("title", '403 Access Denied');
        Tygh::assign("code", '403');
        Tygh::assign("btn_text", 'Go to homepage');
        Tygh::assign("msg", '403 - You don\'t have access to this page.');

        Tygh::display('errors/404.tpl');
    }
}