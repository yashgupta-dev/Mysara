<?php

namespace app\core\DataGrid\src\ColumnTypes;

use app\core\DataGrid\src\Column;
use app\core\DataGrid\src\Exceptions\InvalidColumnExpressionException;

class Integer extends Column
{
     /**
     * Process filter: builds SQL-safe condition strings for CS-Cart.
     */
    public function processFilter($requestedValues): array
    {
        $or_conditions = [];

        if (is_string($requestedValues)) {
            $this->applyIntegerCondition($or_conditions, $requestedValues);
        } elseif (is_array($requestedValues)) {
            foreach ($requestedValues as $value) {
                $this->applyIntegerCondition($or_conditions, $value);
            }
        } else {
            throw new InvalidColumnExpressionException('Only string and array are allowed for integer column type.');
        }

        if (count($or_conditions) === 1) {
            $final_condition = ' AND ' . $or_conditions[0];
        } elseif (!empty($or_conditions)) {
            $final_condition = ' AND (' . implode(' OR ', $or_conditions) . ')';
        } else {
            $final_condition = '';
        }
        return [$final_condition];
    }

    /**
     * Converts a filter expression into SQL-safe condition string.
     */
    private function applyIntegerCondition(array &$conditions, string $value): void
    {

        if (preg_match('/^([<>]=?|=)\s*(-?\d+)$/', $value, $matches)) {
            $operator = $matches[1];
            $intValue = (int) $matches[2];
            $conditions[] = "{$this->columnName} {$operator} {$intValue}";
            
        } elseif (preg_match('/^(-?\d+)\s*-\s*(-?\d+)$/', $value, $matches)) {
            $min = (int) $matches[1];
            $max = (int) $matches[2];
            $conditions[] = "{$this->columnName} BETWEEN ".$min." AND ".$max;

        } elseif (is_numeric($value)) {
            $conditions[] = "{$this->columnName} = ". (int)$value;
        }
    }
}
