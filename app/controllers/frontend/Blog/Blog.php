<?php

namespace app\controllers\frontend\blog;

use app\controllers\BaseController;
use app\core\Tygh;

class Blog extends BaseController
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
       
        Tygh::display('frontend/blogs/blog');
        
    }

    public function view() {
        Tygh::display('frontend/blogs/blog-detail');

    }

}