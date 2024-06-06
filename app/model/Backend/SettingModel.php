<?php

namespace app\model\Backend;

use Exception;
use app\model\BaseModel;
use app\traits\PermissionTrait;
use app\core\Setting;
/**
 * MyModel
 */
class SettingModel extends BaseModel
{
    use PermissionTrait;

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
    public function getUsers($request = array())
    {
        $conditions = $join = $sorting = [];
        if (!empty($request['items_per_page'])) {
            $itemsPerPage = $request['items_per_page'];
        } else {
            $itemsPerPage = Setting::getConfig('config_pagination');
        }
        
        $fields = [
            'u.id',
            'CONCAT(u.firstname, " ", u.lastname) as name',
            'u.email',
            'u.phone',
            'u.active',
            'u.created_at',
            'u.updated_at',
            'r.name as role',
            'r.id as role_id'        
        ];

        $join[] = "users u ";
        $join[] = "LEFT JOIN role_user ru ON (ru.user_id = u.id) ";
        $join[] = "LEFT JOIN roles r ON (r.id = ru.role_id) ";

        $conditions['u.user_type'] = 'A';
        if (!empty($request['user_id'])) {
            $conditions['u.id'] = $request['user_id'];
        }

        if (!empty($request['is_filter']) && $request['is_filter'] == 'Y') {

            if (!empty($request['name'])) {
                $conditions['u.firstname'] = array($request['name'], 'LIKE');
            }

            if (!empty($request['email'])) {
                $conditions['u.email'] = $request['email'];
            }

            if (!empty($request['phone'])) {
                $conditions['u.phone'] = $request['phone'];
            }

            if (!empty($request['status'])) {
                $conditions['u.active'] = $request['status'];
            }

            // if(!empty($request['from']) || !empty($request['to'])) {
            //     $from = $request['from'] ?? ''; 
            //     $to   = $request['to'] ?? ''; 
            //     $conditions['DATE(created_at)'] = array($from,'BETWEEN', $to);
            // }
        }

        if(!empty($request['page'])) {
            $page = $request['page'];
        } else  {
            $page = 1;
        }
        
        $request = array_merge($request, $this->pagination(implode(' ', $join), array('count(u.id) as total_items'), $conditions, 'row', $sorting, $itemsPerPage, $page));
        
        $response = $this->select(implode(' ', $join), implode(',', $fields), $conditions, 'rows', $sorting, $request);
        
        return [$response, $request];
    }

    /**
     * getUsers
     *
     * @param  mixed $request
     * @return array
     */
    public function getUser($request = array())
    {
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
            'r.id as role_id'
            // 'profile_id'          
        ];

        $join[] = "users u ";
        $join[] = "LEFT JOIN role_user ru ON (ru.user_id = u.id) ";
        $join[] = "LEFT JOIN roles r ON (r.id = ru.role_id) ";

        $conditions['u.user_type'] = 'A';
        if (!empty($request['user_id'])) {
            $conditions['u.id'] = $request['user_id'];
        }

        return $this->select(implode(' ', $join), implode(',', $fields), $conditions);
    }

    /**
     * addUser
     *
     * @param  mixed $data
     * @return bool
     */
    public function addUser($data)
    {
        try {
            // password_hash($password, PASSWORD_DEFAULT)
            $_array = [
                'firstname'  => $data['firstname'],
                'lastname'   => $data['lastname'],
                'user_type'  => 'A',
                'username'   => $data['email'],
                'password'   => password_hash($data['confirm_password'], PASSWORD_DEFAULT),
                'email'      => $data['email'],
                'phone'      => $data['phone'],
                'active'     => $data['user_status'],
                'created_at' => TIME,
                'updated_at' => TIME
            ];

            $this->replace('users', $_array);
            $userId = $this->getLastId();
            if ($userId) {

                $group = [
                    'role_id' => $data['group'],
                    'user_id' => $userId,
                    'notification' => json_encode($this->geNotification())
                ];

                return $this->replace('role_user', $group);
            }
            return $userId;
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * updateUser
     *
     * @param  mixed $data
     * @return bool
     */
    public function updateUser($data)
    {
        try {
            // password_hash($password, PASSWORD_DEFAULT)
            $_array = [
                'firstname'  => $data['firstname'],
                'lastname'   => $data['lastname'],
                'user_type'  => 'A',
                'username'   => $data['email'],
                'email'      => $data['email'],
                'phone'      => $data['phone'],
                'active'     => $data['user_status'],
                'updated_at' => TIME
            ];

            if (!empty($data['confirm_password'])) {
                $_array = array_merge($_array, ['password'   => password_hash($data['confirm_password'], PASSWORD_DEFAULT)]);
            }

            $userId = $this->update('users', $_array, ['id' => $data['user_id']]);

            if ($userId) {

                $group = [
                    'role_id' => $data['group'],
                    'user_id' => $data['user_id']
                ];

                return $this->update('role_user', $group, ['user_id' => $data['user_id']]);
            }

            return $userId;
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * getGroups
     *
     * @param  mixed $request
     * @return array
     */
    public function getGroups($request = array())
    {
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

        $roles = $this->select('roles', implode(',', $fields), $conditions, 'rows');
        return [$roles, $request];
    }

    /**
     * getEditGroup
     *
     * @param  mixed $request
     * @return array
     */
    public function getEditGroup($request = array())
    {
        $conditions = [];

        $fields = [
            'id',
            'name',
            'permission',
            'type'
            // 'profile_id'          
        ];

        $conditions['id'] = $request['group_id'];

        return $this->select('roles', implode(',', $fields), $conditions);
    }

    /**
     * updateGroup
     *
     * @param  mixed $request
     * @return bool
     */
    public function updateGroup($request)
    {

        $array = [
            'name' => $request['name'],
            'permission' => json_encode($request['permission'] ?? []),
            'type' => $request['group_type'],
            // 'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => TIME,
        ];

        return $this->update('roles', $array, ['id' => $request['id']]);
    }

    /**
     * addGroup
     *
     * @param  mixed $request
     * @return bool
     */
    public function addGroup($request)
    {

        $array = [
            'name' => $request['name'],
            'permission' => json_encode($request['permission'] ?? []),
            'type' => $request['group_type'],
            'created_at' => TIME,
            'updated_at' => TIME,
        ];

        return $this->replace('roles', $array);
    }

    /**
     * deleteGroup
     *
     * @param  mixed $request
     * @return bool
     */
    public function deleteGroup($request)
    {
        return $this->delete('roles', ['id' => $request['group_id']]);
    }

    /**
     * deleteUser
     *
     * @param  mixed $request
     * @return bool
     */
    public function deleteUser($request)
    {
        return $this->delete('users', ['id' => $request['user_id']]);
    }
}
