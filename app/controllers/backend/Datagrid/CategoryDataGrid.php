<?php
namespace app\controllers\backend\Datagrid;

use app\core\DataGrid\src\DataGrid;

class CategoryDataGrid extends DataGrid
{
    protected $primaryColumn = 'category_id';

    protected $save_search = 'categories';

    public function prepareQueryBuilder() {
        $queryBuilder = [
            'tablename' => 'category c',
            'joins'     => [
                'LEFT JOIN category_description cd ON cd.category_id = c.category_id'
            ],
            'condition' => [
                ' AND cd.language_id = 1'
            ],
            'fields'    => [
                'c.category_id',
                'c.date_added',
                'cd.name',
                'cd.description',
                'cd.meta_title',
                'c.status'
            ],
            'groups'    => []
        ];

        $this->addFilter('category_id', 'c.category_id');

        return $queryBuilder;
    }

    public function prepareColumns(): void {
        $this->addColumn([
            'index'              => 'cd.name',
            'label'              => 'Name',
            'type'               => 'string',
            'sortable'           => true,
            'searchable'         => true,            
            'filterable'         => true
        ]);

        $this->addColumn([
            'index'              => 'cd.meta_title',
            'label'              => 'Meta Title',
            'type'               => 'string',
            'sortable'           => false,
            'searchable'         => true,            
            'filterable'         => true
        ]);

        $this->addColumn([
            'index'              => 'c.date_added',
            'label'              => 'Created At',
            'type'               => 'date',
            'sortable'           => true,
            'searchable'         => false,            
            'filterable'         => true,
            'filtereable_type'   => 'date_range',
        ]);

        $this->addColumn([
            'index'              => 'c.status',
            'label'              => 'Status',
            'type'               => 'integer',
            'sortable'           => true,    
            'filterable'         => true,
            'filterable_type'    => 'dropdown',
            'filterable_options' => [
                [
                    'label' => 'Active', 
                    'value' => '1'
                ],
                [
                    'label' => 'Disabled', 
                    'value' => '0'
                ],
            ],
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
                return fn_link("catalog.category.delete&category_id=" . $row->category_id);
            },
        ]);

        $this->addAction([
            'icon'   => 'bx-pencil',
            'title'  => 'Edit',
            'class'  => '',
            'method' => 'GET',
            'type'   => 'list',
            'url'    => function ($row) {                
                return fn_link("catalog.category.update&category_id=" . $row->category_id);
            },
        ]);
    }

    public function prepareMassActions() {
        $this->addMassAction([
            'title'     => 'Add',
            'icon'      => 'bx-plus',
            'dispatch'  => fn_link('catalog.category.add'),
            'type'      => 'action',
            'method'    => 'GET'
        ]);

        $this->addMassAction([
            'title'     => 'More',
            'icon'      => 'bx-plus',                        
            'method'    => 'GET',            
            'options' => [
                ['label' => 'Bulk Delete', 'value' => fn_link('catalog.category.m_delete'), 'type' => 'delete'],
            ],
        ]);
    }
}