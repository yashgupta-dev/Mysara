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
                'label' => 'Today',
                'from'  => date($format, strtotime('today')),
                'to'    => date($format, strtotime('tomorrow') - 1),
            ],
            [
                'name'  => self::YESTERDAY,
                'label' => 'Yesterday',
                'from'  => date($format, strtotime('yesterday')),
                'to'    => date($format, strtotime('today') - 1),
            ],
            [
                'name'  => self::THIS_WEEK,
                'label' => 'This Week',
                'from'  => date($format, strtotime('monday this week')),
                'to'    => date($format, strtotime('sunday this week 23:59:59')),
            ],
            [
                'name'  => self::THIS_MONTH,
                'label' => 'This Month',
                'from'  => date($format, strtotime('first day of this month')),
                'to'    => date($format, strtotime('last day of this month 23:59:59')),
            ],
            [
                'name'  => self::LAST_MONTH,
                'label' => 'Last Month',
                'from'  => date($format, strtotime('first day of last month')),
                'to'    => date($format, strtotime('last day of last month 23:59:59')),
            ],
            [
                'name'  => self::LAST_THREE_MONTHS,
                'label' => 'Last 3 Months',
                'from'  => date($format, strtotime('first day of -3 months')),
                'to'    => date($format, strtotime('last day of last month 23:59:59')),
            ],
            [
                'name'  => self::LAST_SIX_MONTHS,
                'label' => 'Last 6 Months',
                'from'  => date($format, strtotime('first day of -6 months')),
                'to'    => date($format, strtotime('last day of last month 23:59:59')),
            ],
            [
                'name'  => self::THIS_YEAR,
                'label' => 'This Year',
                'from'  => date($format, strtotime('first day of January this year')),
                'to'    => date($format, strtotime('last day of December this year 23:59:59')),
            ],
        ];
    }
}
