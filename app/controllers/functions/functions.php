<?php

use app\model\Backend\CategoryModel;
use app\controllers\backend\Common\Menu;
use app\controllers\backend\System\Setting;
use app\core\Redirect;
use app\core\Setting as CoreSetting;
use app\model\Common;
use core\engine\Session;

/**
 * fn_get_status
 *
 * @param  mixed $status
 * @return string
 */
function fn_get_status($status)
{
    $statusList = [
        'A' => 'Active',
        'D' => 'Deactivate',
        'U' => 'Unknown',
        'P' => 'Pending'
    ];
    return $statusList[$status] ?? $statusList['U'];
}

/**
 * getStat
 *
 * @param  mixed $type
 * @return array|string
 */
function getStat($type)
{
    $statusList = [
        'A' => 'Admin',
        'C' => 'Customer',
        'V' => 'Vendor',
        'U' => 'Unknown'
    ];
    return $statusList[$type] ?? $statusList['U'];
}

/**
 * fn_get_human_readable_date
 *
 * @param  mixed $dateFormat
 * @param  mixed $timestamp
 * @return string
 */
function fn_get_human_readable_date($dateFormat, $timestamp)
{

    return date($dateFormat, $timestamp);
}

/**
 * fn_get_menus
 *
 * @return array
 */
function fn_get_menus()
{

    $menu = new Menu();
    return $menu->getMenu();
}

/**
 * fn_get_categories
 *
 * @param  array $filter
 * @param  bigint $parent_id
 * @return array
 */
function fn_get_categories($filter = array(), $parent_id = 0)
{
    $categoryModel = new CategoryModel;

    $categories = $categoryModel->getCategories($parent_id);

    foreach ($categories as $category) {
        if ($category['top']) {
            // Level 2
            $children_data = array();

            $children = $categoryModel->getCategories($category['category_id']);

            foreach ($children as $child) {

                $filter_data = array(
                    'filter_category_id'  => $child['category_id'],
                    'filter_sub_category' => true
                );

                $children_data[] = array(
                    'name'  => $child['name'],
                    'href'  => fn_href('product/category', 'category_id=' . $child['category_id']),
                );
            }

            // Level 1
            $data[] = array(
                'name'     => $category['name'],
                'children' => $children_data,
                'column'   => $category['column'] ? $category['column'] : 1,
                'href'     => fn_href('product/category', 'category_id=' . $category['category_id'], 'C'),
            );
        }
    }

    return $data;
}

/**
 * getTimeDiff
 *
 * @param  mixed $time
 * @param  mixed $format
 * @return string|array
 */
function getTimeDiff($time, $format = '')
{
    // Given Unix timestamp
    $givenTimestamp = $time;

    // Create DateTime object for the given timestamp
    $givenDateTime = new DateTime();
    $givenDateTime->setTimestamp($givenTimestamp);

    // Create DateTime object for the current time
    $currentDateTime = new DateTime();

    // Calculate the difference
    $interval = $currentDateTime->diff($givenDateTime);


    // Calculate total months
    $totalMonths = ($interval->y * 12) + $interval->m;

    // Convert total months to years and months
    $years = floor($totalMonths / 12);
    $months = $totalMonths % 12;

    // Prepare the output
    $output = [];
    if ($years > 0) {
        $output[] = "$years years";
    }
    if ($months > 0) {
        $output[] = "$months months";
    }
    if ($interval->d > 0) {
        $output[] = "$interval->d days";
    }
    if ($interval->h > 0) {
        $output[] = "$interval->h hours";
    }
    if ($interval->i > 0) {
        $output[] = "$interval->i minutes";
    }
    if ($interval->s > 0) {
        $output[] = "$interval->s seconds";
    }

    // Output the difference
    return implode(", ", $output);
}

/**
 * getAgentInfo
 *
 * @param  mixed $userAgent
 * @return array
 */
function getAgentInfo($userAgent)
{

    $browserInfo = [
        'userAgent' => $userAgent,
        'agent'     => 'Unknown',
        'browser'   => 'Unknown',
        'platform'  => 'Unknown',
        'device'    => 'Unknown',
    ];

    // Detect platform
    if (preg_match('/linux/i', $userAgent)) {
        $browserInfo['platform'] = 'Linux';
    } elseif (preg_match('/macintosh|mac os x/i', $userAgent)) {
        $browserInfo['platform'] = 'Mac';
    } elseif (preg_match('/windows|win32/i', $userAgent)) {
        $browserInfo['platform'] = 'Windows';
    } elseif (preg_match('/iphone/i', $userAgent)) {
        $browserInfo['platform'] = 'iPhone';
        $browserInfo['device'] = 'M';
    } elseif (preg_match('/android/i', $userAgent)) {
        $browserInfo['platform'] = 'Android';
        $browserInfo['device'] = 'M';
    }

    // Detect browser
    if (preg_match('/MSIE/i', $userAgent) && !preg_match('/Opera/i', $userAgent)) {
        $browserInfo['browser'] = 'Internet Explorer';
    } elseif (preg_match('/Firefox/i', $userAgent)) {
        $browserInfo['browser'] = 'Firefox';
    } elseif (preg_match('/Chrome/i', $userAgent)) {
        $browserInfo['browser'] = 'Chrome';
    } elseif (preg_match('/Safari/i', $userAgent) && !preg_match('/Chrome/i', $userAgent)) {
        $browserInfo['browser'] = 'Safari';
    } elseif (preg_match('/Opera/i', $userAgent)) {
        $browserInfo['browser'] = 'Opera';
    } elseif (preg_match('/Netscape/i', $userAgent)) {
        $browserInfo['browser'] = 'Netscape';
    }

    // Detect device type
    if ($browserInfo['device'] === 'Unknown') {
        if (preg_match('/mobile/i', $userAgent)) {
            $browserInfo['device'] = 'M';
        } else {
            $browserInfo['device'] = 'D';
        }
    }

    return $browserInfo;
}

/**
 * fn_url
 *
 * @param  mixed $query
 * @return string
 */
function fn_url($query, $area = 'A')
{
    $url = new Redirect();

    // $area = Session::get('auth')['user_type'] ?? 'C';

    $pathExtension  = ($area == 'A') ? 'admin.php?' : '';
    unset($_REQUEST['page']);
    $urlPath =  $pathExtension . http_build_query($_REQUEST);

    return $url->link($urlPath . $query);
}

/**
 * fn_link
 *
 * @param  mixed $link
 * @param  mixed $area
 * @return string
 */
function fn_link($link, $area = 'A')
{
    $pathExtension  = ($area == 'A') ? 'admin.php?' : '';
    $url = new Redirect();
    return $url->link($pathExtension."dispatch=$link");
}

function fn_query_remove($params, $url = '')
{
    // echo "<pre>";
    // print_r($url);
    // echo "</pre>";
    // die;
}

function fn_href($url, $query, $store_id = 0, $language_id = 1)
{
    // Convert query to string if it's an array
    $query_string = is_array($query) ? http_build_query($query) : $query;
    if (fn_settings()->get('config_seo_url')) {
        // Instantiate Common model (adjust namespace/path if needed)
        $model = new Common();

        // Get the SEO keyword for the given query
        $seo_url = $model->getSeoUrlsByQuery($query_string);

        // If found, return the SEO-friendly URL
        if (!empty($seo_url)) {
            $extensionTag = '';
            if (!empty(fn_settings()->get('config_seo_extension'))) {
                $extensionTag = '.' . fn_settings()->get('config_seo_extension');
            }
            return $seo_url;
        }
    }

    // Otherwise, return the original URL with query string
    return $url . '?' . $query_string;
}

/**
 * Function defines and assigns pages
 *
 * @param array $params params to generate pagination from
 * @param string $area Area
 * @return array pagination structure
 */
function fn_generate_pagination($params)
{
    if (empty($params['total_items']) || empty($params['items_per_page'])) {
        return array();
    }

    $area = Session::get('auth')['user_type'] ?? 'C';
    $deviation = ($area == 'A') ? 5 : 7;

    /**
     * This hook allows you to change the pagination data
     *
     * @param array  $params    Pagination data
     * @param string $area      One-letter area code
     * @param int    $deviation Number of pages to display before and after selected page
     */
    $total_pages = ceil((int) $params['total_items'] / $params['items_per_page']);

    // Pagination in other areas displayed as in any search engine
    $page_from = fn_get_page_from($params['page'], $deviation);
    $page_to = fn_get_page_to($params['page'], $deviation, $total_pages);

    $pagination = array(
        'navi_pages' => range($page_from, $page_to),
        'prev_range' => ($page_from > 1) ? $page_from - 1 : 0,
        'next_range' => ($page_to < $total_pages) ? $page_to + 1 : 0,
        'current_page' => $params['page'],
        'prev_page' => ($params['page'] > 1) ? $params['page'] - 1 : 0,
        'next_page' => ($params['page'] < $total_pages) ? $params['page'] + 1 : 0,
        'total_pages' => $total_pages,
        'total_items' => $params['total_items'],
        'items_per_page' => $params['items_per_page'],
        'per_page_range' => array(10, 25, 50, 100, 250),
        'range_from' => (($params['page'] - 1) * $params['items_per_page']) + 1,
        'range_to' => (($params['page'] * $params['items_per_page']) > $params['total_items']) ? $params['total_items'] : $params['page'] * $params['items_per_page'],
    );

    if ($pagination['prev_range']) {
        $pagination['prev_range_from']  = fn_get_page_from($pagination['prev_range'], $deviation);
        $pagination['prev_range_to']    = fn_get_page_to($pagination['prev_range'], $deviation, $total_pages);
    }

    if ($pagination['next_range']) {
        $pagination['next_range_from']  = fn_get_page_from($pagination['next_range'], $deviation);
        $pagination['next_range_to']    = fn_get_page_to($pagination['next_range'], $deviation, $total_pages);
    }

    if (!in_array($params['items_per_page'], $pagination['per_page_range'])) {
        $pagination['per_page_range'][] = $params['items_per_page'];
        sort($pagination['per_page_range']);
    }

    return $pagination;
}

function fn_get_page_from($page, $deviation)
{
    return ($page - $deviation < 1) ? 1 : $page - $deviation;
}

function fn_get_page_to($page, $deviation, $total_pages)
{
    return ($page + $deviation > $total_pages) ? $total_pages : $page + $deviation;
}

function fn_settings()
{
    return new CoreSetting();
}

function fn_print_r(...$debugs) {
    if(!empty($debugs)) {
        foreach ($debugs as $debug) {
            echo "<pre>";
            print_r($debug);
            echo "</pre>";
        }
    }
}

function fn_print_die(...$debugs) {
    if(!empty($debugs)) {
        foreach ($debugs as $debug) {
            echo "<pre>";
            print_r($debug);
            echo "</pre>";
        }
    }
    die;
}
