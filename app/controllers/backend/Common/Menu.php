<?php

namespace app\controllers\backend\Common;

use app\controllers\BaseController;

class Menu extends BaseController
{

    protected $menu;

    /**
     * __construct
     *
     * @param  mixed $mode
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * getMenu
     *
     * @return array
     */
    public function getMenu() {
        
        // dashboard
        $this->menu['dashboard'] = [
            'title'     => 'Dashboard',
            'link'      => $this->redirect->link('admin.php?dispatch=dashboard'),
            'icon'      => 'bx-home-circle',
            'sort'      => 0,
            'child'     => [],
        ];

        // customers menu
        $this->menu['customers'] = [
            'title'     => 'Customers',
            'link'      => $this->redirect->link('admin.php?dispatch=customers'),
            'icon'      => 'bx-user',
            'sort'      => 2,
            'child'     => [],
        ];

        // catalog
        $catalog['catalog.category'] = [
            'title'     => 'Category',
            'link'      => $this->redirect->link('admin.php?dispatch=catalog.category'),
        ];

        $catalog['catalog.products'] = [
            'title'     => 'Product',
            'link'      => $this->redirect->link('admin.php?dispatch=catalog.products'),
        ];

        $catalog['catalog.options'] = [
            'title'     => 'Option',
            'link'      => $this->redirect->link('admin.php?dispatch=catalog.options'),
        ];

        $catalog['catalog.attribute'] = [
            'title'     => 'Attribute',
            'link'      => $this->redirect->link('admin.php?dispatch=catalog.attribute'),
        ];

        if($catalog) {
            $this->menu['catalog'] = [
                'title' => 'Catalog',
                'link'  => 'javascript:;',
                'icon'  => 'bx-bullseye',
                'sort'      => 1,
                'child' => $catalog,
            ];
        }


        // system menu
        $settings['system.users'] = [
            'title'     => 'Users',
            'link'      => $this->redirect->link('admin.php?dispatch=system.users'),
        ];
        
        $settings['system.groups'] = [
            'title'     => 'Groups',
            'link'      => $this->redirect->link('admin.php?dispatch=system.groups'),
        ];

        $settings['system.setting'] = [
            'title'     => 'Setting',
            'link'      => $this->redirect->link('admin.php?dispatch=system.setting'),
        ];

        if($settings) {
            $this->menu['system'] = [
                'title' => 'System',
                'link'  => 'javascript:;',
                'icon'  => 'bx-cog',
                'sort'      => 3,
                'child' => $settings,
            ];
        }

        return $this->menu;
    }
}