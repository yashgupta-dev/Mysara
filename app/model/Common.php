<?php

namespace app\model;

use app\model\BaseModel;

/**
 * MyModel
 */
class Common extends BaseModel
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
     * getSeoUrlsByQuery
     *
     * @param  mixed $query
     * @return mixed
     */
    public function getSeoUrlsByQuery($query = '', $condition = []) {
        
        $conditions['seo_origin'] = $query;

        if(!empty($condition['status'])) {
            $conditions['status'] = $condition['status'];
        }
        $response  = $this->select('seo', ['seo_url'], $conditions, 'row');
        if(!empty($response)) {
            return $response['seo_url'];
        }

        return false;
        
    }


}
