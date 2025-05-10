<?php

/**
 * @package		Webkul Cs-Cart Data Grid
 * @author		Webkul Software Pvt. Ltd.
 * @copyright	Copyright (c) 2024, Webkul Software Pvt. Ltd. (https://www.webkul.in/)
 * @license		webkul
 * @link		https://www.webkul.in
 */

namespace WkdatagridController;

use Tygh\Tygh;
use Tygh\Registry;
use WkdatagridModels\WkdatagridModel;

class BaseController
{
    /**
     * @var string mode is the method of the class.
     */
    protected $mode;

    /**
     * @var object mode is the method of the class.
     */
    protected $view;

    /**
     * @var array mode is the method of the class.
     */
    protected $auth;

    /**
     * @var string mode is the method of the class.
     */

    /**
     * @var string Server Request method like GET,POST is save under this variable
     */
    protected $requestMethod;

    /**
     * @var array|string $_REQUEST data is save under this variable
     */
    protected $requestParam;

    /**
     * @var array this variable stores all the mode which will be able to run under this class
     */
    protected $runMode = array();

    /**
     * @var object this variable is used to return the response.
     */
    public $response;

    protected $loadModel;

    /**
     * BaseController constructor.
     *
     * @param string $mode
     */
    public function __construct($mode = '')
    {
        $this->mode = $mode;
        $this->loadModel = new WkdatagridModel();
        $this->view = Tygh::$app['view'];
        $this->auth = Tygh::$app['session']['auth'];
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
        $this->requestParam = $_REQUEST;
    }

    /**
     * @param array $runMode
     * 
     * @return void
     */
    protected function setRunMode($runMode = array())
    {
        if (is_array($runMode)) {
            $this->runMode = array_unique($runMode);
        } else {
            array_push($this->runMode, $runMode);
            $this->runMode = array_unique($this->runMode);
        }
    }

    /**
     * @param array $runMode
     * 
     * @return void
     */
    protected function setNoPage()
    {
        $url = fn_url('_no_page?' . http_build_query(array('page' => $_SERVER['REQUEST_URI'])), AREA, 'rel');
        $_REQUEST['redirect_url'] = $url;
    }

    /**
     * Name:- paginationMethod
     * Description:- This method will use for all the pages for creating pagination;
     * 
     * @param int
     * @return array
     */
    public function paginationMethod($totalItems)
    {
        $offset = 0;
        if (isset($this->requestParam['items_per_page'])) {
            $itemsPerPage = $this->requestParam['items_per_page'];
        } else {
            $itemsPerPage = trim(Registry::get('settings.Appearance.admin_elements_per_page'));
        }
        $page = 1;
        if (isset($this->requestParam['is_ajax'])) {
            if (isset($this->requestParam['page'])) {
                $page = $this->requestParam['page'];
                if (($page - 1) * $itemsPerPage >= $totalItems) {

                    $page = ceil($totalItems / $itemsPerPage);
                }
                $offset = (($page - 1) * $itemsPerPage);
            }
        }
        $params['items_per_page'] = $itemsPerPage;
        $params['page'] = $page;
        $params['total_items'] = $totalItems;
        $params['offset'] = $offset;
        return $params;
    }
}
