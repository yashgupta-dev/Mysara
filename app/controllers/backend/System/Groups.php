<?php

namespace app\controllers\backend\System;

use app\core\Tygh;
use app\controllers\BaseController;
use app\model\Backend\SettingModel;

class Groups extends BaseController
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
        $this->model = new SettingModel();
    }
    
    /**
     * index
     *
     * @return void
     */
    public function index() {
        $groups = $this->model->getGroups($this->requestParam);
        
        Tygh::assign('groups',$groups);
        Tygh::display('backend/system/groups');
    }
}