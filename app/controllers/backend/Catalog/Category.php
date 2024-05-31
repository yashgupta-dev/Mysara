<?php

namespace app\controllers\backend\Catalog;

use app\controllers\BaseController;
use app\model\Backend\CategoryModel;

class Category extends BaseController
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
        
        $this->model = new CategoryModel;

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