<?php

namespace app\controllers\frontend\Auth;

use app\core\Json;
use app\core\Tygh;
use app\core\Email;
use app\core\Response;
use app\model\AuthModel;
use app\controllers\BaseController;
use app\core\validation\Validation;

class Register extends BaseController
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
    
    /**
     * index
     *
     * @return void
     */
    public function index() {
        if($this->requestMethod === 'POST') {

            Validation::validate([
                'firstname' =>  'required|string|regex:[a-zA-z]',
                'lastname'  =>  'required|string|regex:[a-zA-z]',
                'email'     =>  'required|email|unique:users.email',
                'phone'     =>  'required|phone|unique:users.phone',
                'password'  =>  'required',
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
                // creating account
                $response = $this->registerModel->createAccount($this->requestParam);

                // email send
                $template = Tygh::fetch('frontend/auth/mail/register');

                Email::to($this->requestParam['email']);
                Email::subject('Mysara:: Register notification');
                Email::message($template);
                Email::sendEmail();
            }

            Response::json(Json::encode($response));
        }

        Tygh::display('frontend/auth/register');
    }
}