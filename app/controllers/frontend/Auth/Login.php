<?php

namespace app\controllers\frontend\Auth;

use app\controllers\BaseController;
use app\core\Tygh;

class Login extends BaseController
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
        if($this->requestMethod == 'POST') {
                
        }

        Tygh::display('frontend/auth/sign-in');
    }
}