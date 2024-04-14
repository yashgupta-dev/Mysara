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

class Forget extends BaseController
{   

    /**
     * error
     *
     * @var array
     */
    private $error = array();

    protected $registerModel;

    /**
     * __construct
     *
     * @param  mixed $mode
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->registerModel = new AuthModel();
    }

    public function index() {
        Tygh::display('frontend/auth/forget');
    }
    
    /**
     * forget
     *
     * @return json
     */
    public function forget() {
        if($this->requestMethod == 'POST') {
            Validation::validate([
                'email'     =>  'required|email|in:users.email',

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
                // create recovery key
                $res = $this->registerModel->generateRecoveryKey($this->requestParam['email']);
                if($res) {           
                    // email send
                    Tygh::assign('link',$this->redirect->link('auth/forget/update?code='.$res.'',['email'=>$this->requestParam['email']]));
                    $template = Tygh::fetch('frontend/auth/mail/forget');

                    Email::to($this->requestParam['email']);
                    Email::subject('Mysara:: Forget password mail');
                    Email::message($template);
                    Email::sendEmail();

                    $response = ['success' => true,'message' => 'Forget password mail sended on your mail address.'];
                    
                } else {
                    $response = ['errors' => 'Warning! unable to handle your request at this moment.'];
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
    public function update() {
        if($this->requestMethod == 'GET') {
            Validation::validate([
                'email'             =>  'required|email|in:users.email',
                'code'              =>  'required|in:users.recovery_key'
            ],$this->requestParam);

            // get errors
            if (Validation::getErrors() !== true) {        
                
                foreach (Validation::getErrors() as $key => $value) {
                    $this->error[$key] = $value;
                }

                $this->redirect->url('auth/forget');

            } else {               
                Tygh::assign('code',$this->requestParam['code']);
                Tygh::assign('email',$this->requestParam['email']);
                Tygh::display('frontend/auth/change_password');
            }
         
        }
               
    }
    
    /**
     * password_change
     *
     * @return json
     */
    public function password_change() {
        if($this->requestMethod == 'POST') {
            Validation::validate([
                'email'             =>  'required|email|in:users.email',
                'code'              =>  'required|in:users.recovery_key',
                'password'          =>  'required',
                'confirm_password'  =>  'required|equals:'.$this->requestParam['password']
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
                // create recovery key
                $res = $this->registerModel->changePassword($this->requestParam);
                if($res) {           
                    // email send
                    $template = Tygh::fetch('frontend/auth/mail/password_update');

                    Email::to($this->requestParam['email']);
                    Email::subject('Mysara:: Password update');
                    Email::message($template);
                    Email::sendEmail();

                    $response = ['success' => true,'message' => 'Password successfully updated','redirect_url' => $this->redirect->link('auth/login')];
                    
                } else {
                    $response = ['errors' => 'Warning! unable to update password at this moment.'];
                }
            }

            Response::json(Json::encode($response));
        }
    }
}