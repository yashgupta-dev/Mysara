<?php

namespace app\core\DataGrid\src\ColumnTypes;

use app\core\DataGrid\src\Column;
use app\core\DataGrid\src\Enums\DateRangeOptionEnum;
use app\core\DataGrid\src\Enums\FilterTypeEnum;
use app\core\DataGrid\src\Exceptions\InvalidColumnException;
use app\core\DataGrid\src\Exceptions\InvalidColumnExpressionException;

class Date extends Column
{
    /**
     * Set filterable type.
     */
    public function setFilterableType(?string $filterableType): void
    {
        if (
            $filterableType
            && ($filterableType !== FilterTypeEnum::DATE_RANGE)
        ) {
            throw new InvalidColumnException('Date filters will only work with `date_range` type. Either remove the `filterable_type` or set it to `date_range`.');
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
            // If input is a string, find the matching predefined period
            $requestedDates = [
                'time_from' => $requestedDates,
                'time_to' => $requestedDates,
            ];
        }

        if (is_array($requestedDates)) {
            $from = $requestedDates['time_from'] ?? '';
            $to = $requestedDates['time_to'] ?? '';

            // Format 'from' and 'to' with time parts if missing
            if ($from) {
                $from = (strpos($from, ' ') !== false) ? $from : $from . ' 00:00:01';
            }
            if ($to) {
                $to = (strpos($to, ' ') !== false) ? $to : $to . ' 23:59:59';
            }

            if ($from && $to) {
                $conditions[] = "{$this->columnName} BETWEEN ".strtotime($from)." AND ".strtotime($to);
            }
        } else {
            throw new InvalidColumnExpressionException('Only string and array are allowed for date column type.');
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
