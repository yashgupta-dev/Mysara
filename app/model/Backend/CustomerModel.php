<?php

namespace app\model\Backend;

use app\model\BaseModel;

/**
 * MyModel
 */
class CustomerModel extends BaseModel
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
     * getCustomers
     *
     * @param  mixed $request
     * @return array
     */
    public function getCustomers($request = array()) {
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

        $conditions['user_type'] = 'C';

        return $this->select('users',implode(',',$fields),$conditions,'mysqli_fetch_all');

    }

}
