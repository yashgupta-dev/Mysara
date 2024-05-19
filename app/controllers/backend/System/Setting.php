<?php

namespace app\controllers\backend\System;

use app\core\Tygh;
use app\controllers\BaseController;

class Setting extends BaseController
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

    public function index() {
        Tygh::display('backend/system/settings');
    }
}