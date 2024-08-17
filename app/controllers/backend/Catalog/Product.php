<?php

namespace app\controllers\backend\Catalog;

use app\controllers\BaseController;

class Product extends BaseController
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