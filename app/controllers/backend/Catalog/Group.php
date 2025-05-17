<?php

namespace app\controllers\backend\Catalog;

use app\core\Json;
use app\core\Tygh;
use app\core\Response;
use app\core\Notification;
use app\controllers\BaseController;
use app\core\validation\Validation;
use app\model\Backend\AttributeModel;
use app\controllers\backend\Datagrid\GroupAttributeDataGrid;

class Group extends BaseController
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

        $this->executeMiddleware($this->requestParam, ['AuthMiddleware', 'PermissionMiddleware', 'NotificationMiddleware']);
        $this->model = new AttributeModel;
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        list($lists, $search) = fn_datagrid(GroupAttributeDataGrid::class)->process();
        Tygh::assign('search', $search);
        Tygh::assign('lists', $lists);

        Tygh::display('backend/catalog/attribute/attribute_group/attribute_groups.tpl');
    }
    
    /**
     * add
     *
     * @return json
     */
    public function add()
    {
        if ($this->requestMethod === 'POST') {
            Validation::validate([
                'name'      =>  'required|string',
                'sort'      =>  'numeric'

            ], $this->requestParam);

            // get errors
            if (Validation::getErrors() !== true) {

                foreach (Validation::getErrors() as $key => $value) {
                    $this->error[$key] = $value;
                }
                if (isset($this->requestParam['is_ajax'])) {
                    $response = ['errors' => $this->error];
                }
            } else {
                $res = $this->model->addGroup($this->requestParam);
                if ($res) {
                    
                    Notification::set(Notification::TYPE_OK, 'Success', $this->language['text_success']);

                    $response = ['success' => true, 'redirect_url' => $this->redirect->link('admin.php?dispatch=catalog.group')];
                } else {
                    $response = ['errors' => sprintf($this->language['text_error'],'create attribute group')];
                }
            }

            Response::json(Json::encode($response));
        }


        Tygh::display('backend/catalog/attribute/attribute_group/attribute_group_form.tpl');
    }
}
