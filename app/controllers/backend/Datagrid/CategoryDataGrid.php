<?php
namespace app\controllers\backend\Datagrid;

use app\core\DataGrid\src\DataGrid;

class CategoryDataGrid extends DataGrid
{
    protected $primaryColumn = 'c.category_id';

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
            'sortable'           => true,
            'searchable'         => true,            
            'filterable'         => true
        ]);

        $this->addColumn([
            'index'              => 'cd.status',
            'label'              => 'Status',
            'type'               => 'integer',
            'sortable'           => true,
            'searchable'         => true,    
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
            'icon'   => 'ty-icon-delete',
            'title'  => 'delete',
            'class'  => 'cm-ajax cm-confirm',
            'method' => 'POST',
            'type'   => 'delete',
            'url'    => function ($row) {                
                return "products.delete?product_id=" . $row->category_id;
            },
        ]);
    }

    public function prepareMassActions() {
        $this->addMassAction([
            'title'     => 'Add',
            'icon'      => 'icon-plus',
            'dispatch'  => 'products.add',
            'type'      => 'action',
            'method'    => 'GET'
        ]);

        $this->addMassAction([
            'title'     => 'More',
            'icon'      => 'icon-plus',                        
            'method'    => 'GET',            
            'options' => [
                ['label' => 'Label Name', 'value' => 'Label Value', 'type' => 'update'],
            ],
        ]);
    }
}