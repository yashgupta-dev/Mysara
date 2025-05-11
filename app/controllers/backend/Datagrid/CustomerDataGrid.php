<?php
namespace app\controllers\backend\Datagrid;

use app\core\DataGrid\src\DataGrid;

class CustomerDataGrid extends DataGrid
{
    protected $primaryColumn = 'id';

    protected $save_search = 'customer';

    public function prepareQueryBuilder() {
        $queryBuilder = [
            'tablename' => 'users',
            'joins'     => [],
            'condition' => [],
            'fields'    => [
                'id',
                'CONCAT(firstname, " ", lastname) as firstname',
                'email',
                'phone',
                'active',
                'created_at',
                'updated_at'
            ],
            'groups'    => []
        ];

        return $queryBuilder;
    }

    public function prepareColumns(): void {
        $this->addColumn([
            'index'              => 'firstname',
            'label'              => 'Name',
            'type'               => 'string',
            'sortable'           => true,
            'searchable'         => true,            
            'filterable'         => true
        ]);

        $this->addColumn([
            'index'              => 'email',
            'label'              => 'Email',
            'type'               => 'string',
            'sortable'           => true,
            'searchable'         => true,            
            'filterable'         => true,
            'closure' => function ($row) {                
                return '<a href="mailto:'.$row->email.'">'.$row->email.'</a>';
            },     
        ]);

        $this->addColumn([
            'index'              => 'phone',
            'label'              => 'Phone',
            'type'               => 'string',
            'sortable'           => true,
            'searchable'         => true,       
            'closure' => function ($row) {                
                return '<a href="tel:'.$row->phone.'">'.$row->phone.'</a>';
            },     
            'filterable'         => true
        ]);

        $this->addColumn([
            'index'              => 'created_at',
            'label'              => 'Created At',
            'type'               => 'date',
            'sortable'           => true,
            'searchable'         => false,            
            'filterable'         => true,
            'filtereable_type'   => 'date_range',
        ]);

        $this->addColumn([
            'index'              => 'updated_at',
            'label'              => 'Updated At',
            'type'               => 'date',
            'sortable'           => true,
            'searchable'         => false,            
            'filterable'         => false,
            'filtereable_type'   => 'date_range',
        ]);

        $this->addColumn([
            'index'              => 'active',
            'label'              => 'Status',
            'type'               => 'string',
            'sortable'           => true,    
            'filterable'         => true,
            'closure' => function ($row) {                
                return ($row->active  == 'A') ? 'Active' : 'Disabled';
            },
            'filterable_type'    => 'dropdown',
            'filterable_options' => [
                [
                    'label' => 'Active', 
                    'value' => 'A'
                ],
                [
                    'label' => 'Disabled', 
                    'value' => 'D'
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
                return fn_link("customers.delete&user_id=" . $row->id);
            },
        ]);

        $this->addAction([
            'icon'   => 'bx-pencil',
            'title'  => 'Edit',
            'class'  => '',
            'method' => 'GET',
            'type'   => 'list',
            'url'    => function ($row) {                
                return fn_link("customers.update&user_id=" . $row->id);
            },
        ]);
    }

    public function prepareMassActions() {
        $this->addMassAction([
            'title'     => 'Add',
            'icon'      => 'bx-plus',
            'dispatch'  => fn_link('customers.add'),
            'type'      => 'action',
            'method'    => 'GET'
        ]);

        $this->addMassAction([
            'title'     => 'More',
            'icon'      => 'bx-plus',                        
            'method'    => 'POST',            
            'options' => [
                ['label' => 'Bulk Delete', 'value' => fn_link('customers.m_delete'), 'type' => 'delete'],
            ],
        ]);
    }
}