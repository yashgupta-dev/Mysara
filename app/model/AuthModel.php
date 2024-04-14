<?php

namespace app\model;

use app\core\Response;
use app\model\BaseModel;
use Exception;

/**
 * AuthModel
 */
class AuthModel extends BaseModel
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
     * createAccount
     *
     * @param  array $data
     * @return array
     */
    public function createAccount(array $data) {

        try {
            // password_hash($password, PASSWORD_DEFAULT)
            $_array = [
                'firstname'  => $data['firstname'],
                'lastname'   => $data['lastname'],
                'user_type'  => 'C',
                'username'   => $data['email'],
                'password'   => password_hash($data['confirm_password'],PASSWORD_DEFAULT),
                'email'      => $data['email'],
                'phone'      => $data['phone'],
                'active'     => 'A'            
            ];

            return $this->replace('users',$_array);            

        } catch(Exception $e){
            return ['error' => $e->getMessage()];
        }
    }
    
    /**
     * selectUser
     *
     * @param  string $email
     * @return array
     */
    public function selectUser(string $email) {
        return $this->select('users',array('firstname','email','password'),array('email' => $email),'mysqli_fetch_assoc');
    }
    
    /**
     * generateRecoveryKey
     *
     * @param  mixed $email
     * @return bool
     */
    public function generateRecoveryKey(string $email) {
        $recoveryKey = Response::codegenerate(32);
        $this->update('users',array('recovery_key' => $recoveryKey),array('email' => $email));
        return $recoveryKey;
    }
    
    /**
     * changePassword
     *
     * @param  mixed $data
     * @return bool
     */
    public function changePassword(array $data) {
        return $this->update('users',array(
            'password' => password_hash($data['confirm_password'],PASSWORD_DEFAULT),
            'recovery_key' => '',
            'last_updated_password_at' => date('Y-m-d h:i:s')
        ),array('email' => $data['email']));
    }

}
