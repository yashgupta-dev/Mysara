<?php

namespace app\core\DataGrid\src\Enums;

use Tygh\Languages\Helper as LangHelper;

class DateRangeOptionEnum
{
    const TODAY             = 'today';
    const YESTERDAY         = 'yesterday';
    const THIS_WEEK         = 'this_week';
    const THIS_MONTH        = 'this_month';
    const LAST_MONTH        = 'last_month';
    const LAST_THREE_MONTHS = 'last_three_months';
    const LAST_SIX_MONTHS   = 'last_six_months';
    const THIS_YEAR         = 'this_year';

    /**
     * Get date range options.
     */
    public static function getOptions(string $format = 'Y-m-d H:i:s'): array
    {
        return [
            [
                'name'  => self::TODAY,
                'label' => __('wk_datagrid.text_today'),
                'from'  => date($format, strtotime('today')),
                'to'    => date($format, strtotime('tomorrow') - 1),
            ],
            [
                'name'  => self::YESTERDAY,
                'label' => __('wk_datagrid.text_yesterday'),
                'from'  => date($format, strtotime('yesterday')),
                'to'    => date($format, strtotime('today') - 1),
            ],
            [
                'name'  => self::THIS_WEEK,
                'label' => __('wk_datagrid.text_this_week'),
                'from'  => date($format, strtotime('monday this week')),
                'to'    => date($format, strtotime('sunday this week 23:59:59')),
            ],
            [
                'name'  => self::THIS_MONTH,
                'label' => __('wk_datagrid.text_this_month'),
                'from'  => date($format, strtotime('first day of this month')),
                'to'    => date($format, strtotime('last day of this month 23:59:59')),
            ],
            [
                'name'  => self::LAST_MONTH,
                'label' => __('wk_datagrid.text_last_month'),
                'from'  => date($format, strtotime('first day of last month')),
                'to'    => date($format, strtotime('last day of last month 23:59:59')),
            ],
            [
                'name'  => self::LAST_THREE_MONTHS,
                'label' => __('wk_datagrid.text_last_three_months'),
                'from'  => date($format, strtotime('first day of -3 months')),
                'to'    => date($format, strtotime('last day of last month 23:59:59')),
            ],
            [
                'name'  => self::LAST_SIX_MONTHS,
                'label' => __('wk_datagrid.text_last_six_months'),
                'from'  => date($format, strtotime('first day of -6 months')),
                'to'    => date($format, strtotime('last day of last month 23:59:59')),
            ],
            [
                'name'  => self::THIS_YEAR,
                'label' => __('wk_datagrid.text_this_year'),
                'from'  => date($format, strtotime('first day of January this year')),
                'to'    => date($format, strtotime('last day of December this year 23:59:59')),
            ],
        ];
    }
}
