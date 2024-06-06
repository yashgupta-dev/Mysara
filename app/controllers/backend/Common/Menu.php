<?php

namespace app\controllers\backend\Common;

use app\model\AuthModel;
use app\controllers\BaseController;

class Menu extends BaseController
{

    protected $menu;

    protected $permission;

    /**
     * __construct
     *
     * @param  mixed $mode
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $auth = new AuthModel();
        $this->permission = $auth->getPermissions();
    }

    /**
     * getMenu
     *
     * @return array
     */
    public function getMenu()
    {

        // dashboard
        if (!empty($this->permission) && !empty(json_decode($this->permission['permission'], true)) && in_array('dashboard', json_decode($this->permission['permission'], true)['access'])) {
            $this->menu['dashboard'] = [
                'title'     => 'Dashboard',
                'link'      => $this->redirect->link('admin.php?dispatch=dashboard'),
                'icon'      => 'bx-home-circle',
                'sort'      => 0,
                'child'     => [],
            ];
        }

        // customers menu
        if (!empty($this->permission) && !empty(json_decode($this->permission['permission'], true)) && in_array('customers', json_decode($this->permission['permission'], true)['access'])) {
            $this->menu['customers'] = [
                'title'     => 'Customers',
                'link'      => $this->redirect->link('admin.php?dispatch=customers'),
                'icon'      => 'bx-user',
                'sort'      => 2,
                'child'     => [],
            ];
        }
        
        // catalog
        $catalog = [];
        if (!empty($this->permission) && !empty(json_decode($this->permission['permission'], true)) && in_array('catalog.category', json_decode($this->permission['permission'], true)['access'])) {
            $catalog['catalog.category'] = [
                'title'     => 'Category',
                'link'      => $this->redirect->link('admin.php?dispatch=catalog.category'),
            ];
        }

        if (!empty($this->permission) && !empty(json_decode($this->permission['permission'], true)) && in_array('catalog.product', json_decode($this->permission['permission'], true)['access'])) {
            $catalog['catalog.products'] = [
                'title'     => 'Product',
                'link'      => $this->redirect->link('admin.php?dispatch=catalog.products'),
            ];
        }

        if (!empty($this->permission) && !empty(json_decode($this->permission['permission'], true)) && in_array('catalog.option', json_decode($this->permission['permission'], true)['access'])) {
            $catalog['catalog.options'] = [
                'title'     => 'Option',
                'link'      => $this->redirect->link('admin.php?dispatch=catalog.options'),
            ];
        }

        if (!empty($this->permission) && !empty(json_decode($this->permission['permission'], true)) && in_array('catalog.attribute', json_decode($this->permission['permission'], true)['access'])) {
            $catalog['catalog.attribute'] = [
                'title'     => 'Attribute',
                'link'      => $this->redirect->link('admin.php?dispatch=catalog.attribute'),
            ];
        }
        if ($catalog) {
            $this->menu['catalog'] = [
                'title' => 'Catalog',
                'link'  => 'javascript:;',
                'icon'  => 'bx-bullseye',
                'sort'      => 1,
                'child' => $catalog,
            ];
        }

        // catalog
        $sale = [];
        if (!empty($this->permission) && !empty(json_decode($this->permission['permission'], true)) && in_array('sale.order', json_decode($this->permission['permission'], true)['access'])) {
            $sale['sale.order'] = [
                'title'     => 'Orders',
                'link'      => $this->redirect->link('admin.php?dispatch=sale.order'),
            ];
        }

        if ($sale) {
            $this->menu['sale'] = [
                'title' => 'Sale',
                'link'  => 'javascript:;',
                'icon'  => 'bx-store',
                'sort'      => 1,
                'child' => $sale,
            ];
        }

        // extension menu
        $extension = [];
      

        if ($extension) {
            $this->menu['extension'] = [
                'title' => 'Extension',
                'link'  => 'javascript:;',
                'icon'  => 'bx-list-check',
                'sort'      => 3,
                'child' => $extension,
            ];
        }

        // system menu
        $settings = [];
        if (!empty($this->permission) && !empty(json_decode($this->permission['permission'], true)) && in_array('system.users', json_decode($this->permission['permission'], true)['access'])) {
            $settings['system.users'] = [
                'title'     => 'Users',
                'link'      => $this->redirect->link('admin.php?dispatch=system.users'),
            ];
        }

        if (!empty($this->permission) && !empty(json_decode($this->permission['permission'], true)) && in_array('system.groups', json_decode($this->permission['permission'], true)['access'])) {
            $settings['system.groups'] = [
                'title'     => 'Groups',
                'link'      => $this->redirect->link('admin.php?dispatch=system.groups'),
            ];
        }

        if (!empty($this->permission) && !empty(json_decode($this->permission['permission'], true)) && in_array('system.setting', json_decode($this->permission['permission'], true)['access'])) {
            $settings['system.setting'] = [
                'title'     => 'Setting',
                'link'      => $this->redirect->link('admin.php?dispatch=system.setting'),
            ];
        }

        if (!empty($this->permission) && !empty(json_decode($this->permission['permission'], true)) && in_array('system.extensions', json_decode($this->permission['permission'], true)['access'])) {
            $settings['system.extensions'] = [
                'title'     => 'Extensions',
                'link'      => $this->redirect->link('admin.php?dispatch=system.extensions'),
            ];
        }

        if ($settings) {
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
