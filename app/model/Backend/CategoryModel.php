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
    function getCategories($parent_id = 0, $filter = []) {
        
        $fields = [
            '*'
        ];

        $conditions[] = " WHERE c.parent_id = '" . (int)$parent_id . "'";
        $conditions[] = " AND cd.language_id = '1'";
        $conditions[] = " AND c.status = '1'";

        // filter name
        if(!empty($filer)) {
            $conditions[] = " AND LCASE(cd.name) LIKE '%" . $filter['search'] . "%'";
        }

        // filter with category ID in array
        if(!empty($filter['category_id'])) {
            $conditions[] = " AND c.category_id IN ('" . implode("','", $filter['category_id']) . "')";
        }

        $join[] =  " LEFT JOIN category_description cd ON (c.category_id = cd.category_id)";
        // $join[] =  " LEFT JOIN category_to_store c2s ON (c.category_id = c2s.category_id)";

        $extra[] = " ORDER BY c.sort_order";
        $extra[] = " LCASE(cd.name)";

        return $this->query('category c','rows', $fields, $join, $conditions, $extra);
        
    }

    /**
     * categories
     *
     * @param  array $fields
     * @param  array $conditions
     * @param  array $join
     * @param  array $other
     * @param  bigint $parent_id
     * @return array
     */
    function categories($filter = []) {
        
        $fields = [
            '*'
        ];

        $conditions[] = " WHERE 1=1 ";
        $conditions[] = " AND cd.language_id = '1'";
        $conditions[] = " AND c.status = '1'";

        // filter name
        if(!empty($filer)) {
            $conditions[] = " AND LCASE(cd.name) LIKE '%" . $filter['search'] . "%'";
        }

        // filter with category ID in array
        if(!empty($filter['category_id'])) {
            $conditions[] = " AND c.category_id IN ('" . implode("','", $filter['category_id']) . "')";
        }

        $join[] =  " LEFT JOIN category_description cd ON (c.category_id = cd.category_id)";
        // $join[] =  " LEFT JOIN category_to_store c2s ON (c.category_id = c2s.category_id)";

        $extra[] = " ORDER BY c.sort_order";
        $extra[] = " LCASE(cd.name)";

        return $this->query('category c','rows', $fields, $join, $conditions, $extra);
        
    }

    public function updateCategory($data) {
        // if category ID exists then delete category
        if (!empty($data['category_id'])) {
            $this->deleteCategory($data['category_id']);
        }
        $category_id = !empty($data['category_id']) ? $data['category_id'] : 0;
        
    }
}
