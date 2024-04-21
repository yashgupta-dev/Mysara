<?php
namespace app\controllers\function;

use app\controllers\backend\Common\Menu;
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
        
        return date($dateFormat,strtotime($timestamp));
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
}
