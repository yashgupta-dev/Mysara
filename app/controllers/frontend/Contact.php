<?php
namespace app\controllers\frontend;

use app\controllers\BaseController;
use app\core\Json;
use app\core\Email;
use app\core\validation\Validation;

class Contact extends BaseController
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * index
     *
     * @return void
     */
    public function index() {
        
        if($this->requestMethod === 'POST') {

            Validation::validate([
                'name'=>'required|string',
                'email'=>'required|email',
                'subject'=>'required',
                'message'=>'required|string|min:200|max:1000'

            ],$this->requestParam);

            // post validation
            if (Validation::getErrors() !== true) {        
                
                foreach (Validation::getErrors() as $key => $value) {
                    $this->error[$key] = $value;
                }
                if(isset($this->requestParam['is_ajax'])) {
                    echo Json::encode(['errors' => $this->error]);
                    exit;
                }
            }
            
            Email::to(RECEIVE_MAIL);
            Email::subject($this->requestParam['subject']);
            Email::message($this->requestParam['message']);

            if(Email::sendEmail()) {

                if(isset($this->requestParam['is_ajax'])) {
                    echo Json::encode(['success' => true,'message'=>'Mail sended successfully']);
                    exit;
                }
            } else {
                if(isset($this->requestParam['is_ajax'])) {
                    echo Json::encode(['success' => true,'message'=>'Mail not sended successfully']);
                    exit;
                }
            }

        }
    }
}