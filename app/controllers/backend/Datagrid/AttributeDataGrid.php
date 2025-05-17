<?php
namespace app\controllers\backend\Datagrid;

use app\core\DB;
use app\core\DataGrid\src\DataGrid;

class AttributeDataGrid extends DataGrid
{
    protected $primaryColumn = 'attribute_id';

    protected $save_search = 'attribute';

    public function prepareQueryBuilder() {
        $queryBuilder = [
            'tablename' => 'attribute a',
            'joins'     => [
                ' LEFT JOIN attribute_description ad ON ad.attribute_id = a.attribute_id',
                ' LEFT JOIN attribute_group_description agd ON agd.attribute_group_id = a.attribute_group_id',
            ],
            'condition' => [],
            'fields'    => [
               'a.attribute_id',
               'a.sort_order',
               'agd.name as group_name',
               'ad.name'
            ],
            'groups'    => []
        ];

        return $queryBuilder;
    }

    public function prepareColumns(): void {
        $this->addColumn([
            'index'              => 'ad.name',
            'label'              => 'Attribute name',
            'type'               => 'string',
            'sortable'           => true,
            'searchable'         => true,            
            'filterable'         => true
        ]);

        $this->addColumn([
            'index'              => 'a.sort_order',
            'label'              => 'Sort',
            'type'               => 'integer',
            'sortable'           => true,
            'searchable'         => false,            
            'filterable'         => false
        ]);

        $groups = mysqli_fetch_all(DB::get()->get->query("SELECT name, attribute_group_id FROM attribute_group_description "), MYSQLI_ASSOC);    

        $this->addColumn([
            'index'              => 'a.attribute_group_id',
            'label'              => 'Groups',
            'type'               => 'string',
            'visibility'         => false,
            'sortable'           => false,
            'searchable'         => true,            
            'filterable'         => true,
            'filterable_type'    => 'dropdown',
            'filterable_options' => array_map(function ($group) {
                return [
                    'label' => $group['name'],
                    'value' => $group['attribute_group_id']
                ];
            }, $groups),
        ]);
    }

    public function prepareActions() {
        $this->addAction([
            'icon'   => 'bx-trash',
            'title'  => 'delete',
            'class'  => 'cm-ajax cm-confirm',
            'method' => 'POST',
            'type'   => 'delete',
            'url'    => function ($row) {                
                return fn_link("catalog.attribute.delete&attribute_id=" . $row->attribute_id);
            },
        ]);

        $this->addAction([
            'icon'   => 'bx-pencil',
            'title'  => 'Edit',
            'class'  => '',
            'method' => 'GET',
            'type'   => 'list',
            'url'    => function ($row) {                
                return fn_link("catalog.attribute.update&attribute_id=" . $row->attribute_id);
            },
        ]);
    }

    public function prepareMassActions() {
        $this->addMassAction([
            'title'     => 'Add',
            'icon'      => 'bx-plus',
            'dispatch'  => fn_link('catalog.attribute.add'),
            'type'      => 'action',
            'method'    => 'GET'
        ]);

        $this->addMassAction([
            'title'     => 'More',
            'icon'      => 'bx-plus',                        
            'method'    => 'POST',            
            'options' => [
                ['label' => 'Bulk Delete', 'value' => fn_link('catalog.attribute.m_delete'), 'type' => 'delete'],
                ['label' => 'Group Lists', 'value' => fn_link('catalog.group'), 'type' => 'list']
            ],
        ]);
    }
}