<?php

namespace app\controllers\backend;

use app\core\Tygh;
use app\controllers\BaseController;

class Auth extends BaseController
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
    }

    /**
     * index
     *
     * @return void
     */
    public function login()
    {
        Tygh::display('backend/auth/login');
    }

    public function forget() {
        Tygh::display('backend/auth/forget');
    }
}
