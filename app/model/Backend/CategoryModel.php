<?php

namespace app\model\Backend;

use app\model\BaseModel;

/**
 * CategoryModel
 */
class CategoryModel extends BaseModel
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
     * getCategories
     *
     * @param  array $fields
     * @param  array $conditions
     * @param  array $join
     * @param  array $other
     * @param  bigint $parent_id
     * @return array
     */
    function getCategories($parent_id = 0) {
        
        $fields = [
            '*'
        ];

        $conditions[] = " WHERE c.parent_id = '" . (int)$parent_id . "'";
        $conditions[] = " AND cd.language_id = '1'";
        $conditions[] = " AND c.status = '1'";

        $join[] =  " LEFT JOIN category_description cd ON (c.category_id = cd.category_id)";
        // $join[] =  " LEFT JOIN category_to_store c2s ON (c.category_id = c2s.category_id)";

        $extra[] = " ORDER BY c.sort_order";
        $extra[] = " LCASE(cd.name)";

        return $this->query('category c','mysqli_fetch_all', $fields, $join, $conditions, $extra);
        
    }

}
