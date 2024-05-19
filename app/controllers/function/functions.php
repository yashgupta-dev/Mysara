<?php
namespace app\controllers\function;

use app\controllers\backend\Common\Menu;
use app\model\Backend\CategoryModel;

class functions {

    /**
     * fn_get_status
     *
     * @param  mixed $status
     * @return string
     */
    function fn_get_status($status) {
        $statusList = [
            'A' => 'Active',
            'D' => 'Deactivate',
            'U' => 'Unknown',
            'P' => 'Pending'
        ];
        return $statusList[$status] ?? $statusList['U']; 
    }
    
    /**
     * fn_get_human_readable_date
     *
     * @param  mixed $dateFormat
     * @param  mixed $timestamp
     * @return string
     */
    function fn_get_human_readable_date($dateFormat, $timestamp) {
        
        return date($dateFormat,$timestamp);
    }
    
    /**
     * fn_get_menus
     *
     * @return array
     */
    function fn_get_menus() {
        
        $menu = new Menu();
        return $menu->getMenu();
    }
    
    /**
     * fn_get_Categories
     *
     * @param  array $filter
     * @param  bigint $parent_id
     * @return array
     */
    function fn_get_Categories($filter = array(), $parent_id = 0) {

        $categoryModel = new CategoryModel;        

        $categories = $categoryModel->getCategories($parent_id);

        foreach ($categories as $category) {
			if ($category['top']) {
				// Level 2
				$children_data = array();

				$children = $categoryModel->getCategories($category['category_id']);

				foreach ($children as $child) {

					$filter_data = array(
						'filter_category_id'  => $child['category_id'],
						'filter_sub_category' => true
					);

					$children_data[] = array(
						'name'  => $child['name'],
						'href'  => '',
					);
				}

				// Level 1
				$data[] = array(
					'name'     => $category['name'],
					'children' => $children_data,
					'column'   => $category['column'] ? $category['column'] : 1,
					'href'     => '',
				);
			}
		}
        return $data;
    }
}
