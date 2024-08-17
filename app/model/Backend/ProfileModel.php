<?php

namespace app\model\Backend;

use Exception;
use app\model\BaseModel;
use core\engine\Session;

/**
 * MyModel
 */
class ProfileModel extends BaseModel
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
     * getUsers
     *
     * @param  mixed $request
     * @return array
     */
    public function getUser($user_id) {
        $conditions = $join = [];

        $fields = [
            'u.id',
            'u.firstname',
            'u.lastname',
            'u.email',
            'u.phone',
            'u.active',
            'u.created_at',
            'u.updated_at',
            'r.name as role',
            'r.id as role_id',
            'r.type',
            'ru.notification',
            'u.profile'
            // 'profile_id'          
        ];

        $join[] = "users u ";
        $join[] = "LEFT JOIN role_user ru ON (ru.user_id = u.id) ";
        $join[] = "LEFT JOIN roles r ON (r.id = ru.role_id) ";

        $conditions['u.user_type'] = 'A';
        
        $conditions['u.id'] = $user_id;
        

        $res = $this->select(implode(' ',$join),implode(',',$fields),$conditions);
        $res['notification']  = json_decode($res['notification'],true);
        return $res;

        
    }
    
    /**
     * getBrowserSessions
     *
     * @param  mixed $user_id
     * @return array
     */
    public function getBrowserSessions($user_id) {
        $conditions = $join = [];

        $fields = [
            '*'
        ];

        $join[] = "sessions s ";
        
        $conditions['s.user_id'] = $user_id;
        

        return $this->select(implode(' ',$join),implode(',',$fields),$conditions,'rows');
    }
    /**
     * updateUser
     *
     * @param  mixed $data
     * @return bool
     */
    public function updateUser($data) {
        try {
            // password_hash($password, PASSWORD_DEFAULT)
            $_array = [
                'firstname'  => $data['firstname'],
                'lastname'   => $data['lastname'],
                'username'   => $data['email'],
                'email'      => $data['email'],
                'phone'      => $data['phone'],
                'profile'    => $data['f_image'] ?? '',
            ];

            if(!empty($data['confirm_password'])) {
                $_array = array_merge($_array,['password'   => password_hash($data['confirm_password'],PASSWORD_DEFAULT)]);
            }

            return $this->update('users',$_array,['id' => $data['user_id']]);

        } catch(Exception $e){
            return ['error' => $e->getMessage()];
        }
    }
    
    /**
     * updateNotification
     *
     * @param  mixed $data
     * @return bool
     */
    public function updateNotification($data) {
        try {
            
            $_array = [
                'notification'  => json_encode($data['notification'])
            ];

            return $this->update('role_user',$_array,['user_id' => Session::get('auth')['id']]);

        } catch(Exception $e){
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * getGroups
     *
     * @param  mixed $request
     * @return array
     */
    public function getGroups($request = array()) {
        $conditions = [];

        $fields = [
            'id',
            'name',
            'permission',
            'type',
            'created_at',
            'updated_at'
            // 'profile_id'          
        ];

        $roles = $this->select('roles',implode(',',$fields),$conditions,'rows');
        return [$roles, $request];
    }
    
    /**
     * getUserNotification
     *
     * @param  mixed $user_id
     * @return array
     */
    public function getUserNotification($user_id) {
        $conditions = $join = [];

        $fields = [
            'u.id',
            'u.firstname',
            'u.lastname',
            'u.email',
            'u.phone',
            'u.active',
            'ru.role_id as role_id',
            'ru.notification as notification'
            // 'profile_id'          
        ];

        $join[] = "users u ";
        $join[] = "LEFT JOIN role_user ru ON (ru.user_id = u.id) ";

        $conditions['u.user_type'] = 'A';
        
        $conditions['u.id'] = $user_id;
        

        return $this->select(implode(' ',$join),implode(',',$fields),$conditions);
    }
}