<?php

namespace app\controllers\backend\Catalog;

use app\controllers\BaseController;
use app\core\Tygh;

class Attribute extends BaseController
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

        $this->executeMiddleware($this->requestParam, ['AuthMiddleware','PermissionMiddleware','NotificationMiddleware']);

    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        
        Tygh::assign('search',[]);
        Tygh::display('backend/catalog/attribute/attribute.tpl');
        
    }
    
    /**
     * group_list
     *
     * @return void
     */
    public function group_list() {
        Tygh::assign('search',[]);
        Tygh::display('backend/catalog/attribute/attribute_group/attribute_groups.tpl');
    }

}