<?php

namespace app\controllers\backend;

use app\controllers\backend\Datagrid\CustomerDataGrid;
use app\core\Tygh;
use app\controllers\BaseController;
use app\model\Backend\CustomerModel;

class Customers extends BaseController
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

        $this->executeMiddleware($this->requestParam, ['AuthMiddleware', 'PermissionMiddleware']);

        $this->model = new CustomerModel();
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        list($results, $search) = fn_datagrid(CustomerDataGrid::class)->process();

        Tygh::assign('lists', $results);
        Tygh::assign('search', $search);
        Tygh::display('backend/customers/lists');
    }
}
