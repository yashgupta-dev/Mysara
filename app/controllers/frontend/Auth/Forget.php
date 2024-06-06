<?php

namespace app\controllers\frontend\Auth;

use app\core\Json;
use app\core\Tygh;
use app\core\Email;
use app\core\Redirect;
use app\core\Response;
use app\model\AuthModel;
use core\engine\Session;
use app\controllers\BaseController;
use app\core\validation\Validation;

class Forget extends BaseController
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
        $this->model = new AuthModel();
    }

    public function index()
    {
        Tygh::display('frontend/auth/forget');
    }

    /**
     * forget
     *
     * @return json
     */
    public function forget()
    {
        if ($this->requestMethod == 'POST') {
            Validation::validate([
                'email'     =>  'required|email|in:users.email',

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
                // create recovery key
                $res = $this->model->generateRecoveryKey($this->requestParam['email']);
                if ($res) {
                    // email send
                    Tygh::assign('link', $this->redirect->link('auth/forget/update?code=' . $res . '', ['email' => $this->requestParam['email']]));
                    $template = Tygh::fetch('frontend/auth/mail/forget');

                    Email::to($this->requestParam['email']);
                    Email::subject('Mysara:: Forget password mail');
                    Email::message($template);
                    Email::sendEmail();


                    $response = ['success' => true, 'message' => $this->language['text_mail_send']];
                } else {
                    $response = ['errors' => $this->language['text_error']];
                }
            }

            Response::json(Json::encode($response));
        }
    }

    /**
     * update
     *
     * @return void
     */
    public function update()
    {
        if ($this->requestMethod == 'GET' && !empty($this->requestParam)) {
            Validation::validate([
                'email'             =>  'required|email|in:users.email',
                'code'              =>  'required|in:users.recovery_key'
            ], $this->requestParam);

            // get errors
            if (Validation::getErrors() !== true) {

                foreach (Validation::getErrors() as $key => $value) {
                    $this->error[$key] = $value;
                }

                $this->redirect->url('auth/forget');
            } else {
                Tygh::assign('code', $this->requestParam['code']);
                Tygh::assign('email', $this->requestParam['email']);
                Tygh::display('frontend/auth/change_password');
            }
        } else {
            $this->redirect->url('auth/forget');
        }

    }

    /**
     * password_change
     *
     * @return json
     */
    public function password_change()
    {
        if ($this->requestMethod == 'POST') {
            Validation::validate([
                'email'             =>  'required|email|in:users.email',
                'code'              =>  'required|in:users.recovery_key',
                'password'          =>  'required',
                'confirm_password'  =>  'required|equals:' . $this->requestParam['password']
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
                // create recovery key
                $res = $this->model->changePassword($this->requestParam);
                if ($res) {
                    // email send
                    $template = Tygh::fetch('frontend/auth/mail/password_update');

                    Email::to($this->requestParam['email']);
                    Email::subject('Mysara:: Password update');
                    Email::message($template);
                    Email::sendEmail();

                    $response = ['success' => true, 'message' => $this->language['text_success'], 'redirect_url' => $this->redirect->link('auth/login')];
                } else {
                    $response = ['errors' => $this->language['text_password_update_error']];
                }
            }

            Response::json(Json::encode($response));
        }
    }
}
