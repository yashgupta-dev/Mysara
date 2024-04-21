<?php

namespace app\controllers\backend;

use app\core\Tygh;
use app\controllers\BaseController;

class Profile extends BaseController
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
     * account
     *
     * @return void
     */
    public function account()
    {
        Tygh::display('backend/profile/account');
    }
}
