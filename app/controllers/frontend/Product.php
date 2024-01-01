<?php

namespace app\controllers\frontend;

use app\controllers\BaseController;
use app\core\Tygh;

class Product extends BaseController
{    
    /**
     * error
     *
     * @var array
     */
    private $error = array();
    
    /**
     * language
     *
     * @var array
     */
    private $language = [];

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
       
        Tygh::display('frontend/product/product');
        
    }

}