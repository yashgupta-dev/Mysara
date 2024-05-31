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
                    Session::set('isAuth',1);    
                                    
                    // email send
                    $template = Tygh::fetch('frontend/auth/mail/login');

                    Email::to($this->requestParam['email']);
                    Email::subject('Mysara:: Login alert!!!');
                    Email::message($template);
                    Email::sendEmail();
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
