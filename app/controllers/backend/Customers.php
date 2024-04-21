<?php

namespace app\controllers\backend;

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
        
        $this->executeMiddleware($this->requestParam, ['AuthMiddleware']);

        $this->model = new CustomerModel();
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $customers = $this->model->getCustomers($this->requestParam);
        
        Tygh::assign('customers',$customers);
        Tygh::display('backend/customers/lists');
    }
}
