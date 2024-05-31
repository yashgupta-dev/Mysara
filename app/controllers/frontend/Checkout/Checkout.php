<?php

namespace app\controllers\frontend\checkout;

use app\controllers\BaseController;
use app\core\Tygh;

class Checkout extends BaseController
{    
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
       
        Tygh::display('frontend/checkout/checkout');
        
    }

}