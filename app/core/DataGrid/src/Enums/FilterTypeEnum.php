<?php

namespace app\core\DataGrid\src\Enums;

class FilterTypeEnum
{
    /**
     * Dropdown.
     */
    const DROPDOWN = 'dropdown';

    /**
     * Date Range.
     */
    const DATE_RANGE = 'date_range';

    /**
     * DateTime Range.
     */
    const DATETIME_RANGE = 'datetime_range';

    /**
     * Get all filter types.
     *
     * @return array
     */
    public static function getAll(): array
    {
        return [
            self::DROPDOWN,
            self::DATE_RANGE,
            self::DATETIME_RANGE,
        ];
    }
}
