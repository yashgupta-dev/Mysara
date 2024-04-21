<?php

namespace app\model\Backend;

use app\model\BaseModel;

/**
 * MyModel
 */
class SettingModel extends BaseModel
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
    public function getUsers($request = array()) {
        $conditions = [];

        $fields = [
            'id',
            'CONCAT(firstname, " ", lastname) as name',
            'email',
            'phone',
            'active',
            'created_at',
            'updated_at'
            // 'profile_id'          
        ];

        $conditions['user_type'] = 'A';

        return $this->select('users',implode(',',$fields),$conditions,'mysqli_fetch_all');

    }

    public function getGroups() {
        $conditions = [];

        $fields = [
            'id',
            'name',
            'created_at',
            'updated_at'
            // 'profile_id'          
        ];

        return $this->select('roles',implode(',',$fields),$conditions,'mysqli_fetch_all');
    }

}
