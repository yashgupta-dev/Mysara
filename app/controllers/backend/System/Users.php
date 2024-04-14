<?php

namespace app\controllers\backend\System;

use app\core\Tygh;
use app\controllers\BaseController;

class Users extends BaseController
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
    public function index() {
        // var_dump(['as']);
        Tygh::display('backend/system/users');
    }
}