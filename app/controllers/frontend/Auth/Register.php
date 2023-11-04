<?php

namespace app\controllers\frontend\Auth;

use app\controllers\BaseController;
use app\core\Tygh;

class Register extends BaseController
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

    public function index() {
        Tygh::display('frontend/auth/sign-up');
    }
}