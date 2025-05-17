<?php
namespace app\controllers\backend\Datagrid\System;

use app\core\DB;
use app\core\DataGrid\src\DataGrid;

class UserDataGrid extends DataGrid
{
    protected $primaryColumn = 'id';

    protected $save_search = 'users';

    public function prepareQueryBuilder() {
        $queryBuilder = [
            'tablename' => 'users u',
            'joins'     => [
                ' LEFT JOIN role_user ru ON (ru.user_id = u.id)',
                ' LEFT JOIN roles r ON (r.id = ru.role_id)',
            ],
            'condition' => [
                " AND u.user_type = 'A'"
            ],
            'fields'    => [
                'u.id',
                'u.firstname',
                'u.lastname',
                'u.email',
                'u.phone',
                'u.active',
                'u.created_at',
                'r.name as role'                      
            ],
            'groups'    => []
        ];

        return $queryBuilder;
    }

    public function prepareColumns(): void {
        $this->addColumn([
            'index'              => 'u.firstname',
            'label'              => 'Firstname',
            'type'               => 'string',
            'sortable'           => true,
            'searchable'         => true,            
            'filterable'         => true
        ]);

        $this->addColumn([
            'index'              => 'u.lastname',
            'label'              => 'Lastname',
            'type'               => 'string',
            'sortable'           => true,
            'searchable'         => true,            
            'filterable'         => false
        ]);

        $this->addColumn([
            'index'              => 'u.email',
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
            'index'              => 'r.role',
            'label'              => 'Role',
            'type'               => 'string',
            'sortable'           => false,
            'searchable'         => false,            
            'filterable'         => false,
            'exportable'         => false,
            'closure' => function ($row) {                
                return '<span class="btn btn-dark btn-sm p-1">'.$row->role.'</span>';
            },
        ]);

        $this->addColumn([
            'index'              => 'u.phone',
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

        $roles = mysqli_fetch_all(DB::get()->get->query("SELECT name, id FROM roles "), MYSQLI_ASSOC);    

        $this->addColumn([
            'index'              => 'ru.role_id',
            'label'              => 'Roles',
            'type'               => 'integer',
            'visibility'         => false,
            'sortable'           => false,
            'searchable'         => false,            
            'filterable'         => true,
            'exportable'         => false,
            'filterable_type'    => 'dropdown',
            'filterable_options' => array_map(function ($roles) {
                return [
                    'label' => $roles['name'],
                    'value' => $roles['id']
                ];
            }, $roles),
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
                return fn_link("system.users.delete&user_id=" . $row->id);
            },
        ]);

        $this->addAction([
            'icon'   => 'bx-pencil',
            'title'  => 'Edit',
            'class'  => '',
            'method' => 'GET',
            'type'   => 'list',
            'url'    => function ($row) {                
                return fn_link("system.users.update&user_id=" . $row->id);
            },
        ]);
    }

    public function prepareMassActions() {
        $this->addMassAction([
            'title'     => 'Add',
            'icon'      => 'bx-plus',
            'dispatch'  => fn_link('system.users.add'),
            'type'      => 'action',
            'method'    => 'GET'
        ]);
    }
}