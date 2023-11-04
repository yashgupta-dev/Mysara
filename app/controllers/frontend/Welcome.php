<?php

namespace app\controllers\frontend;

use app\controllers\BaseController;
use app\core\Tygh;

class Welcome extends BaseController
{    
    /**
     * error
     *
     * @var array
     */
    private $error = array();

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
       
        Tygh::display('frontend/index');
        
    }

    /**
     * contact
     *
     * @return void
     */
    public function contact() {

        Tygh::display('frontend/contact');
    }
    
    /**
     * about
     *
     * @return void
     */
    public function about() {

        Tygh::display('frontend/about');
    }
    
    /**
     * why
     *
     * @return void
     */
    public function why() {
        Tygh::display('frontend/why_us');
    }
    
    /**
     * testimonial
     *
     * @return void
     */
    public function testimonial() {
        Tygh::display('frontend/testimonial');
    }

}