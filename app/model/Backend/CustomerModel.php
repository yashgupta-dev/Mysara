<?php

namespace app\model\Backend;

use app\core\Setting;
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
        $conditions = $sorting = [];

        if (!empty($request['items_per_page'])) {
            $itemsPerPage = $request['items_per_page'];
        } else {
            $itemsPerPage = Setting::getConfig('config_pagination');
        }
        
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

        if(!empty($request['page'])) {
            $page = $request['page'];
        } else  {
            $page = 1;
        }

        $conditions['user_type'] = 'C';

        $request = array_merge($request, $this->pagination('users', array('count(*) as total_items'), $conditions, 'row', [], $itemsPerPage, $page));

        $customers = $this->select('users',implode(',',$fields),$conditions,'rows', $sorting, $request);
        return [$customers, $request];
    }

}
