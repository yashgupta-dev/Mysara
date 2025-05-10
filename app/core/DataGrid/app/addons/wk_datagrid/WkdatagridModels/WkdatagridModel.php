<?php

/**
 * @package		Webkul Cs-Cart Data Grid
 * @author		Webkul Software Pvt. Ltd.
 * @copyright	Copyright (c) 2024, Webkul Software Pvt. Ltd. (https://www.webkul.in/)
 * @license		webkul
 * @link		https://www.webkul.in
 */

namespace WkdatagridModels;

use Tygh\Tygh;
use Tygh\Registry;
use Tygh\Settings;
use Tygh\Enum\YesNo;
use WkdatagridModels\BaseModel;

class WkdatagridModel extends BaseModel
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * saveAddonConfiguration
     *
     * @param  mixed $_data
     * @param  mixed $lang_code
     * @return void
     */
    public function saveAddonConfiguration($_data, $company_id = null)
    {

        if (!$setting_id = Settings::instance()->getId('wk_datagrid_tpl_data', '')) {

            $setting_id = Settings::instance()->update(array(
                'name' =>           'wk_datagrid_tpl_data',
                'section_id' =>     0,
                'section_tab_id' => 0,
                'type' =>           'A',
                'position' =>       0,
                'is_global' =>      'N',
                'handler' =>        ''
            ));
        }

        Settings::instance()->updateValueById($setting_id, serialize($_data), $company_id);
    }

    /**
     * getSettingsData
     *
     * @param  mixed $company_id
     * @return array
     */
    public function getSettingsData($company_id = null)
    {

        static $cache;
        if (empty($cache['settings_' . $company_id])) {

            $settings = Settings::instance()->getValue('wk_datagrid_tpl_data', '', $company_id);
            $settings = unserialize($settings);
            if (empty($settings)) {
                $settings = array();
            }
            $cache['settings_' . $company_id] = $settings;
        }
        return $cache['settings_' . $company_id];
    }

    public function getProductData($params, $items_per_page = 0, $lang_code = CART_LANGUAGE)
    {
        $params = LastView::instance()->update('products', $params);

        // Set default values to input params
        $default_params = array(
            'page' => 1,
            'items_per_page' => $items_per_page
        );

        $params = array_merge($default_params, $params);
        $condition = $join = $group = $limit = '';
        // Define fields that should be retrieved

        $fields = array(
            'product_id',
            'product_code',
            'status',
            'company_id', // Added storefront_id field
            'list_price', // Added user_group_id field
            'amount',
            'timestamp'
        );

        $sortings = array(
            'kyc_id' => '?:wk_vendor_kyc_type.kyc_id',
            'status' => '?:wk_vendor_kyc_type.status',
            'is_required' => '?:wk_vendor_kyc_type.is_required',
            'kyc_type' => '?:wk_vendor_kyc_type_description.description'
        );

        if (isset($params['kyc_id']) && !empty($params['kyc_id'])) {
            $condition .= db_quote("AND kyc_id = ?i", $params['kyc_id']);
        }
        if (isset($params['kyc_type']) && !empty($params['kyc_type'])) {
            $condition .= db_quote(" AND description LIKE ?l", "%{$params['kyc_type']}%");
        }
        if (isset($params['storefront_id']) && $params['storefront_id'] !== '') {
            $condition .= db_quote(" AND storefront_id = ?i", $params['storefront_id']);
        }
        $sorting = db_sort($params, $sortings, 'product_id', 'asc');
        
        if (!empty($params['items_per_page'])) {
            $params['total_items'] = $this->model->select('products', 'COUNT(product_id)', "$condition", 'db_get_field');
            $limit = db_paginate($params['page'], $params['items_per_page'], $params['total_items']);
        }
        $wk_vendor_kyc_type_data = $this->mtSelect(
            'products',
            implode(', ', $fields),
            "$condition $sorting $limit",
            'db_get_array'
        );
        return array($wk_vendor_kyc_type_data, $params);
    }
}
