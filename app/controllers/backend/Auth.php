<?php

namespace app\controllers\backend;

use app\core\Json;
use app\core\Tygh;
use app\core\Email;
use app\core\Response;
use app\controllers\BaseController;
use app\core\Notification;
use app\core\validation\Validation;
use app\model\AuthModel;
use core\engine\Session;

class Auth extends BaseController
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

        $this->executeMiddleware($this->requestParam, ['AuthLoginCheckMiddleware','NotificationMiddleware']);
        $this->model = new AuthModel;

    }

    /**
     * index
     *
     * @return void
     */
    public function login()
    {
        if($this->requestMethod == 'POST') {
            Validation::validate([
                'email'     =>  'required|email|in:users.email',
                'password'  =>  'required'

            ],$this->requestParam);

            // get errors
            if (Validation::getErrors() !== true) {        
                
                foreach (Validation::getErrors() as $key => $value) {
                    $this->error[$key] = $value;
                }
                if(isset($this->requestParam['is_ajax'])) {
                    $response = ['errors' => $this->error];
                }

            } else {
                // verify password
                $res = $this->verifyPassword($this->requestParam);
                if($res) {
                    Session::set('auth',$res);                    
                    Session::set('isAuth',true);    
                                    
                    // email send
                    if(Session::get('auth')['notification']['login'] == 'Y') {

                        $template = Tygh::fetch('frontend/auth/mail/login');

                        Email::to($this->requestParam['email']);
                        Email::subject('Mysara:: Login alert!!!');
                        Email::message($template);
                        Email::sendEmail();
                    }

                    Notification::set(Notification::TYPE_INFO,'Welcome',sprintf($this->language['text_welcome'],$res['firstname']));

                    $response = ['success' => true,'redirect_url' => $this->redirect->link('admin.php?dispatch=dashboard')];
                    
                } else {
                    $response = ['errors' => $this->language['text_invalid_creds']];
                }
            }

            Response::json(Json::encode($response));
        }
        Tygh::display('backend/auth/login');
    }
    
    public function forget() {
        Tygh::display('backend/auth/forget');
    }
    
    /**
     * logout
     *
     * @return void
     */
    public function logout() {
        Session::destroy();
        $this->redirect->url('admin.php?dispatch=auth.login');
    }

    /**
     * logout_all_device
     *
     * @return void
     */
    public function logout_all_device() {
        if ($this->requestMethod == 'GET') {

            Validation::validate([
                'user_id'     =>  'required|in:users.id'

            ], $this->requestParam);

            // get errors
            if (Validation::getErrors() !== true) {

                foreach (Validation::getErrors() as $key => $value) {

                    Notification::set('E', 'Error', $value);
                }
            } else {
                $res = $this->model->deleteSession($this->requestParam);
                if ($res) {
                    Notification::set('O', 'Success', $this->language['text_success']);
                } else {

                    Notification::set('E', 'Error', sprintf($this->language['text_failed_logout']));
                }
            }

            $this->redirect->url('admin.php?dispatch=profile.account');
        }
    }

    /**
     * verifyPassword
     *
     * @param  array $data
     * @return bool
     */
    protected function verifyPassword(array $data) {
        $response = $this->model->selectUser($data['email'],'A');
        if(!empty($response) && password_verify($data['password'], $response['password'])) {
            return $response;
        }

        return false;
    }
}
