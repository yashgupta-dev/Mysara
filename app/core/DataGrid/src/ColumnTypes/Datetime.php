<?php

namespace app\core\DataGrid\src\ColumnTypes;

use app\core\DataGrid\src\Column;
use app\core\DataGrid\src\Enums\DateRangeOptionEnum;
use app\core\DataGrid\src\Enums\FilterTypeEnum;
use app\core\DataGrid\src\Exceptions\InvalidColumnException;
use app\core\DataGrid\src\Exceptions\InvalidColumnExpressionException;

class Datetime extends Column
{
    /**
     * Set filterable type.
     */
    public function setFilterableType(?string $filterableType): void
    {
        if (
            $filterableType
            && ($filterableType !== FilterTypeEnum::DATETIME_RANGE)
        ) {
            throw new InvalidColumnException('Datetime filters will only work with `datetime_range` type. Either remove the `filterable_type` or set it to `datetime_range`.');
        }

        parent::setFilterableType($filterableType);
    }

    /**
     * Set filterable options.
     */
    public function setFilterableOptions(array $filterableOptions): void
    {
        if (empty($filterableOptions)) {
            $filterableOptions = DateRangeOptionEnum::getOptions();
        }

        parent::setFilterableOptions($filterableOptions);
    }

    /**
     * Process filter.
     */
    public function processFilter($requestedDates): array
    {
        $conditions = [];

        if($requestedDates['period'] === 'A') {
            return $conditions;
        }

        if (is_string($requestedDates)) {
            // If input is a period string (e.g., "LW")
            
            $requestedDates = [
                'time_from' => $requestedDates,
                'time_to'   => $requestedDates,
            ];            
        }

        if (is_array($requestedDates)) {
            $from = $requestedDates['time_from'] ?? '';
            $to   = $requestedDates['time_to'] ?? '';

            // Auto-add time parts if not provided
            if ($from) {
                $from = strpos($from, ' ') === false ? $from . ' 00:00:01' : $from;
            }
            if ($to) {
                $to = strpos($to, ' ') === false ? $to . ' 23:59:59' : $to;
            }

            if ($from && $to) {
                $conditions[] = "{$this->columnName} BETWEEN ".fn_parse_date($from)." AND ".fn_parse_date($to);
            }
        } else {
            throw new InvalidColumnExpressionException('Only string and array are allowed for datetime column type.');
        }

        $final_condition = '';
        if (count($conditions) === 1) {
            $final_condition = ' AND ' . $conditions[0];
        } elseif (!empty($conditions)) {
            $final_condition = ' AND (' . implode(' OR ', $conditions) . ')';
        }

        return [$final_condition];
    }
}
