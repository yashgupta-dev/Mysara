<?php

namespace app\controllers\frontend\product;

use app\controllers\BaseController;
use app\core\Tygh;

class Category extends BaseController
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
        Tygh::display('frontend/product/category');
        
    }

}