<?php

namespace app\model\Backend;

use app\core\Setting;
use app\model\BaseModel;

/**
 * CategoryModel
 */
class AttributeModel extends BaseModel
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
     * getGroups
     *
     * @param  mixed $request
     * @return array
     */
    public function getGroups($request)
    {
        $fields = $conditions = $join = $sorting = array();

        if (!empty($request['items_per_page'])) {
            $itemsPerPage = $request['items_per_page'];
        } else {
            $itemsPerPage = Setting::getConfig('config_pagination');
        }

        $fields = [
            'ag.attribute_group_id',
            'agd.name',
            'ag.sort_order'
        ];

        $join[] = "attribute_group ag ";
        $join[] = " LEFT JOIN attribute_group_description agd ON (agd.attribute_group_id = ag.attribute_group_id)";

        if (!empty($request['is_filter']) && $request['is_filter'] == 'Y') {

            if (!empty($request['name'])) {
                $conditions['agd.name'] = array($request['name'], 'LIKE');
            }
        }

        if (!empty($request['page'])) {
            $page = $request['page'];
        } else {
            $page = 1;
        }

        $request = array_merge($request, $this->pagination(implode(' ',$join), array('count(*) as total_items'), $conditions, 'row', [], $itemsPerPage, $page));

        $customers = $this->select(implode(' ', $join), implode(',', $fields), $conditions, 'rows', $sorting, $request);

        return [$customers, $request];
    }
    
    /**
     * addGroup
     *
     * @return bool
     */
    public function addGroup($data) {
        $group = [
            'sort_order' => $data['sort'] ?? 0
        ];

        $this->replace('')
    }
}
