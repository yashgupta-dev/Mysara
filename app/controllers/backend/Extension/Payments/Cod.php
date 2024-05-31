<?php

namespace app\controllers\backend\Extension\Payments;

use app\core\Json;
use app\core\Tygh;
use app\core\Response;
use app\core\Notification;
use app\controllers\BaseController;
use app\core\validation\Validation;
use app\model\Backend\ExtensionModel;

class Cod extends BaseController
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
        $this->model = new ExtensionModel;
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        Tygh::assign('setting',$this->model->getSettings('payments_cod'));
        Tygh::display('backend/extension/payments/cod');
    }
    
    /**
     * save
     *
     * @return void
     */
    public function save()
    {

        if ($this->requestMethod == 'POST') {

            Validation::validate([
                'payment_cod_status'     =>  'required|in_array:A,D',
                'payment_cod_total'      =>  'numeric'

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
                $res = $this->model->editSettings('payments_cod', $this->requestParam);

                Notification::set('O', 'Success', $this->language['text_success']);
                $response = ['success' => true, 'message' => $this->language['text_success'], 'redirect_url' => $this->redirect->link('admin.php?dispatch=system.extensions')];
            }

            Response::json(Json::encode($response));
        }
    }
}
