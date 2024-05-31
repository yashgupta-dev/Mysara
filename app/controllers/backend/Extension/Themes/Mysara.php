<?php

namespace app\controllers\backend\Extension\Themes;

use app\core\Tygh;
use app\controllers\BaseController;

class Mysara extends BaseController
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
        
        $this->executeMiddleware($this->requestParam, ['AuthMiddleware','PermissionMiddleware']);
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        
      
    }

}