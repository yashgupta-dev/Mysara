<?php
namespace app\controllers\backend\Datagrid;

use app\core\DB;
use app\core\DataGrid\src\DataGrid;

class GroupAttributeDataGrid extends DataGrid
{
    protected $primaryColumn = 'attribute_group_id';

    protected $save_search = 'group';

    public function prepareQueryBuilder() {
        $queryBuilder = [
            'tablename' => 'attribute_group ag',
            'joins'     => [
                ' LEFT JOIN attribute_group_description agd ON agd.attribute_group_id = ag.attribute_group_id',
            ],
            'condition' => [],
            'fields'    => [
               'ag.attribute_group_id',
               'ag.sort_order',
               'agd.name'
            ],
            'groups'    => []
        ];

        return $queryBuilder;
    }

    public function prepareColumns(): void {
        $this->addColumn([
            'index'              => 'agd.name',
            'label'              => 'Group name',
            'type'               => 'string',
            'sortable'           => true,
            'searchable'         => true,            
            'filterable'         => true
        ]);

        $this->addColumn([
            'index'              => 'ag.sort_order',
            'label'              => 'Sort',
            'type'               => 'integer',
            'sortable'           => true,
            'searchable'         => false,            
            'filterable'         => false
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
                return fn_link("catalog.group.delete&attribute_group_id=" . $row->attribute_group_id);
            },
        ]);

        $this->addAction([
            'icon'   => 'bx-pencil',
            'title'  => 'Edit',
            'class'  => '',
            'method' => 'GET',
            'type'   => 'list',
            'url'    => function ($row) {                
                return fn_link("catalog.group.update&attribute_group_id=" . $row->attribute_group_id);
            },
        ]);
    }

    public function prepareMassActions() {
        $this->addMassAction([
            'title'     => 'Add',
            'icon'      => 'bx-plus',
            'dispatch'  => fn_link('catalog.group.add'),
            'type'      => 'action',
            'method'    => 'GET'
        ]);

        $this->addMassAction([
            'title'     => 'More',
            'icon'      => 'bx-plus',                        
            'method'    => 'POST',            
            'options' => [
                ['label' => 'Bulk Delete', 'value' => fn_link('catalog.group.m_delete'), 'type' => 'delete'],
                ['label' => 'Attribute Lists', 'value' => fn_link('catalog.attribute'), 'type' => 'list']
            ],
        ]);
    }
}