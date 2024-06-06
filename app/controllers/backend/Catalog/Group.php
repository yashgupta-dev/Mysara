<?php

namespace app\controllers\backend\Catalog;

use app\core\Json;
use app\core\Tygh;
use app\core\Response;
use app\core\Notification;
use app\controllers\BaseController;
use app\core\validation\Validation;
use app\model\Backend\AttributeModel;

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
        list($lists, $search) = $this->model->getGroups($this->requestParam);

        Tygh::assign('search', $search);
        Tygh::assign('lists', $lists);

        Tygh::display('backend/catalog/attribute/attribute_group/attribute_groups.tpl');
    }

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
                // verify password
                $res = $this->model->addGroup($this->requestParam);
                if ($res) {
                    
                    Notification::set(Notification::TYPE_OK, 'Success', $this->language['text_success']);

                    $response = ['success' => true, 'redirect_url' => $this->redirect->link('admin.php?dispatch=catalog.group')];
                } else {
                    $response = ['errors' => sprintf($this->language['text_invalid_creds'],'create')];
                }
            }

            Response::json(Json::encode($response));
        }


        Tygh::display('backend/catalog/attribute/attribute_group/attribute_group_form.tpl');
    }
}
