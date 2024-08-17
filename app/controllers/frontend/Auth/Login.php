<?php

namespace app\controllers\frontend\Auth;

use app\core\Json;
use app\core\Tygh;
use app\core\Email;
use app\core\Response;
use app\model\AuthModel;
use app\controllers\BaseController;
use app\core\Redirect;
use app\core\validation\Validation;

class Login extends BaseController
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
    
    /**
     * index
     *
     * @return void
     */
    public function index() {
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
                    // email send
                    $template = Tygh::fetch('frontend/auth/mail/login');

                    Email::to($this->requestParam['email']);
                    Email::subject('Mysara:: Login alert!!!');
                    Email::message($template);
                    Email::sendEmail();

                    $response = ['success' => true,'redirect_url' => $this->redirect->link('welcome')];
                    
                } else {
                    $response = ['errors' => 'Warning! invalid credentials.'];
                }
            }

            Response::json(Json::encode($response));
        }

        Tygh::display('frontend/auth/sign-in');
    }
    
    /**
     * verifyPassword
     *
     * @param  array $data
     * @return bool
     */
    protected function verifyPassword(array $data) {
        $response = $this->model->selectUser($data['email']);
        if(!empty($response) && password_verify($data['password'], $response['password'])) {
            return true;
        }

        return false;
    }
}