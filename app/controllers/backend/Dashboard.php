<?php

namespace app\controllers\backend;

use app\core\Tygh;
use app\controllers\BaseController;

class Dashboard extends BaseController
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
    public function index()
    {
        Tygh::display('backend/index');
    }
}
