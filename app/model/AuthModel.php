<?php

namespace app\model;

use app\core\Response;
use app\model\BaseModel;
use core\engine\Session;
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
                'active'     => 'D',
                // 'profile'    => $data['profile'],
                'created_at' => TIME,
                'updated_at' => TIME
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
    public function selectUser(string $email, $user_type = "C") {
        
        $conditions = $join = [];

        $fields = [
            'u.id',
            'u.firstname',
            'u.lastname',
            'u.user_type',
            'u.username',
            'u.email',
            'u.password',
            'u.phone',
            'u.active',
            'u.profile',
            // 'u.last_updated_password_at',
            // 'u.custom_fields',
            'u.created_at',
            'u.updated_at',  
            'ru.notification',
            'ru.role_id',
            'r.type',
            'r.name as role',
        ];

        $join[] = "users u ";
        $join[] = "LEFT JOIN role_user ru ON (ru.user_id = u.id) ";
        $join[] = "LEFT JOIN roles r ON (r.id = ru.role_id) ";

        $conditions['u.user_type'] = $user_type;
        
        $conditions['u.username'] = $email;        

        // $res = $this->select(implode(' ',$join),implode(',',$fields),$conditions,'row');

        $res = $this->select(implode(' ',$join),implode(',',$fields),$conditions);
        $res['notification']  = json_decode($res['notification'], true);

        return $res;
    }
    
    /**
     * generateRecoveryKey
     *
     * @param  mixed $email
     * @return bool
     */
    public function generateRecoveryKey(string $email, $user_type = '') {
        $recoveryKey = Response::codegenerate(32);
        // ,'user_type' => $user_type
        $this->update('users',array('recovery_key' => $recoveryKey),array('email' => $email));
        return $recoveryKey;
    }
    
    /**
     * changePassword
     *
     * @param  mixed $data
     * @return bool
     */
    public function changePassword(array $data, $user_type = 'C') {
        // 'user_type' => $user_type
        return $this->update('users',array(
            'password' => password_hash($data['confirm_password'],PASSWORD_DEFAULT),
            'recovery_key' => '',
            'last_updated_password_at' => TIME
        ),array('email' => $data['email']));
    }

    /**
     * deleteSession
     *
     * @return bool
     */
    public function deleteSession($data) {
        return $this->delete('sessions',array('user_id' => $data['user_id']));
    }
    
    /**
     * getPermissions
     *
     * @return array
     */
    public function getPermissions() {
        
        return $this->select(
            'roles',
            array('permission'),
            array('id' => $this->select(
                'role_user',
                array('role_id'),
                array('user_id' => Session::get('auth')['id'])
            )['role_id'])
        );
    }

}
