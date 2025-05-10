<?php

namespace app\model\Backend;

use app\model\BaseModel;
use app\core\Setting;
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
        if(!empty($request['name'])) {
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
    function categories($request = []) {
        $fields = $conditions = $join = $sorting = array();

        if (!empty($request['items_per_page'])) {
            $itemsPerPage = $request['items_per_page'];
        } else {
            $itemsPerPage = Setting::getConfig('config_pagination');
        }

        $fields = [
            "cp.category_id AS category_id",
            "GROUP_CONCAT(cd1.name ORDER BY cp.level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') AS name",
            "c1.parent_id",
            "c1.sort_order"
        ];
        
        $join[] = " category_path cp";
        $join[] = " LEFT JOIN category c1 ON (cp.category_id = c1.category_id)";
        $join[] = " LEFT JOIN category c2 ON (cp.path_id = c2.category_id)";
        $join[] = " LEFT JOIN category_description cd1 ON (cp.path_id = cd1.category_id)";
        $join[] = " LEFT JOIN category_description cd2 ON (cp.category_id = cd2.category_id)";
        
        $conditions['cd1.language_id'] = "1";
        $conditions['cd2.language_id'] = "1";

        if (!empty($request['is_filter']) && $request['is_filter'] == 'Y') {
            // filter name
            if(!empty($request['name'])) {
                $conditions['LCASE(cd.name)'] = array($request['name'], 'LIKE');
            }
        }
        // filter with category ID in array
        if(!empty($request['category_id'])) {
            $conditions['c1.category_id'] = implode(', ', is_array($request['category_id']) ? $request['category_id'] : [$request['category_id']]);
        }
       
        if (!empty($request['page'])) {
            $page = $request['page'];
        } else {
            $page = 1;
        }

        $group[] = "cp.category_id";

        $request = array_merge($request, $this->pagination(implode(' ',$join), array('count(*) as total_items'), $conditions, 'row', [], $itemsPerPage, $page));
        
        $attributes = $this->select(implode(' ', $join), implode(',', $fields), $conditions, 'rows', $sorting, $request, $group);

        return [$attributes, $request];
        
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
    function category($request = []) {
        $fields = $conditions = $join = $sorting = array();

        $fields = [
            "DISTINCT *", 
            "GROUP_CONCAT(cd1.name ORDER BY cp.level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') as path"
        ];
        
        $join[] = " category_path cp";
        $join[] = " LEFT JOIN category c1 ON (cp.category_id = c1.category_id)";
        $join[] = " LEFT JOIN category c2 ON (cp.path_id = c2.category_id)";
        $join[] = " LEFT JOIN category_description cd1 ON (cp.path_id = cd1.category_id)";
        $join[] = " LEFT JOIN category_description cd2 ON (cp.category_id = cd2.category_id)";
        
        $conditions['cd1.language_id'] = "1";
        $conditions['cd2.language_id'] = "1";

        if (!empty($request['is_filter']) && $request['is_filter'] == 'Y') {
            // filter name
            if(!empty($request['name'])) {
                $conditions['LCASE(cd.name)'] = array($request['name'], 'LIKE');
            }
        }
        // filter with category ID in array
        if(!empty($request['category_id'])) {
            $conditions['c1.category_id'] = implode(', ',is_array($request['category_id']) ? $request['category_id'] : [$request['category_id']]);
        }

        $group[] = "cp.category_id";
        
        $attributes = $this->select(implode(' ', $join), implode(',', $fields), $conditions, 'row');

        return $attributes;
        
    }

    public function updateCategory($data) {
        // if category ID exists then delete category
        
        $update = $this->update('category', [
            'parent_id'   => (int)$data['parent_id'],
            'top'         => (isset($data['top']) ? (int)$data['top'] : 0),
            'column'      => (int)$data['column'],
            'sort_order'  => (int)$data['sort_order'],
            'status'      => (int)$data['status']
        ], ['category_id' => $data['category_id']]);
        
        if($update) {
            if (isset($data['f_image'])) {
                $this->update('category', [
                    'image'       => $data['f_image']
                ], ['category_id' => $data['category_id']]);
            }

            if (!empty($data['category_id'])) {
                $this->delete('category_description', ['category_id' => $data['category_id']]);
            }       
                
            $this->replace('category_description', [
                'category_id'   => $data['category_id'],
                'language_id'   => 1,
                'name'          => $data['category_description']['name'],
                'description'   => $data['category_description']['description'],
                'meta_title'    => $data['category_description']['meta_title'],
                'meta_description' => $data['category_description']['meta_description'],
                'meta_keyword'  => $data['category_description']['meta_keyword']
            ]);

            // Check for existing category paths
            $existingPaths = $this->select('category_path', ['*'], [
                'category_id' => $data['category_id']
            ], 'rows');

            if (!empty($existingPaths)) {
                foreach ($existingPaths as $category_path) {
                    // Delete paths below current
                    $this->delete('category_path', [
                        'category_id' => $category_path['category_id'],
                        'level'       => [$category_path['level'], '<']
                    ]);

                    $path = [];

                    // Get parent path
                    $parentPaths = $this->select('category_path', ['*'], [
                        'category_id' => $data['parent_id']
                    ], 'rows', ['ORDER BY level ASC']);

                    foreach ($parentPaths as $result) {
                        $path[] = $result['path_id'];
                    }

                    // Get current category path
                    $currentPaths = $this->select('category_path', ['*'], [
                        'category_id' => $category_path['category_id']
                    ], 'rows', ['ORDER BY level ASC']);

                    foreach ($currentPaths as $result) {
                        $path[] = $result['path_id'];
                    }

                    // Rebuild path with new levels
                    $level = 0;
                    foreach ($path as $path_id) {
                        $this->replace('category_path', [
                            'category_id' => $category_path['category_id'],
                            'path_id'     => $path_id,
                            'level'       => $level++
                        ]);
                    }
                }
            } else {
                // Delete any existing paths (if not found above)
                $this->delete('category_path', [
                    'category_id' => $data['category_id']
                ]);

                // Recreate path from parent
                $level = 0;
                $parentPaths = $this->select('category_path', ['*'], [
                    'category_id' => $data['parent_id']
                ], 'rows', ['ORDER BY level ASC']);

                foreach ($parentPaths as $result) {
                    $this->replace('category_path', [
                        'category_id' => $data['category_id'],
                        'path_id'     => $result['path_id'],
                        'level'       => $level++
                    ]);
                }

                // Add self as final path
                $this->replace('category_path', [
                    'category_id' => $data['category_id'],
                    'path_id'     => $data['category_id'],
                    'level'       => $level
                ]);
            }
            
            // Delete existing SEO URLs for this category
            $this->delete('seo', [
                'seo_origin' => 'category_id=' . (int) $data['category_id']
            ]);
            // C:\wamp64\bin\php\php8.0.30\
    
            // Insert new SEO URLs if provided
            if (!empty($data['seo_url'])) {
                
                $this->replace('seo', [
                    'seo_origin'  => 'category_id='.$data['category_id'],
                    'seo_url'     => $data['seo_url'],
                    'status'      => true
                ]);
            }

            return $update;
        }

        return false;
        
    }
}
