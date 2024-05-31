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

        if(!empty($request['is_filter']) && $request['is_filter'] == 'Y') {

            if(!empty($request['name'])) {
                $conditions['firstname'] = array($request['name'],'LIKE'); 
            }

            if(!empty($request['email'])) {
                $conditions['email'] = $request['email']; 
            }

            if(!empty($request['phone'])) {
                $conditions['phone'] = $request['phone']; 
            }

            if(!empty($request['status'])) {
                $conditions['active'] = $request['status']; 
            }

            // if(!empty($request['from']) || !empty($request['to'])) {
            //     $from = $request['from'] ?? ''; 
            //     $to   = $request['to'] ?? ''; 
            //     $conditions['DATE(created_at)'] = array($from,'BETWEEN', $to);
            // }
        }


        $conditions['user_type'] = 'C';

        $customers = $this->select('users',implode(',',$fields),$conditions,'mysqli_fetch_all');
        return [$customers, $request];
    }

}
