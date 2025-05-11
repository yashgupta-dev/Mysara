<?php

namespace app\core\DataGrid\src\ColumnTypes;

use app\core\DataGrid\src\Column;
use app\core\DataGrid\src\Enums\FilterTypeEnum;
use app\core\DataGrid\src\Exceptions\InvalidColumnExpressionException;

class Aggregate extends Column
{
    /**
     * Process filter.
     */
    public function processFilter($requestedValues): array
    {
        $conditions = [];

        if ($this->filterableType === FilterTypeEnum::DROPDOWN) {
            if (is_string($requestedValues)) {
                $conditions[] = "{$this->columnName} = $requestedValues";
            } elseif (is_array($requestedValues)) {
                foreach ($requestedValues as $value) {
                    $conditions[] = "{$this->columnName} = $value";
                }
            } else {
                throw new InvalidColumnExpressionException('Only string and array are allowed for dropdown filter.');
            }
        } else {
            if (is_string($requestedValues)) {
                $conditions[] = "{$this->columnName} LIKE '%{$requestedValues}%'";
            } elseif (is_array($requestedValues)) {
                foreach ($requestedValues as $value) {
                    $conditions[] = "{$this->columnName} LIKE '%{$value}%'";
                }
            } else {
                throw new InvalidColumnExpressionException('Only string and array are allowed for text filter.');
            }
        }

        $having = '';
        if (count($conditions) === 1) {
            $having = 'HAVING ' . $conditions[0];
        } elseif (!empty($conditions)) {
            $having = 'HAVING (' . implode(' OR ', $conditions) . ')';
        }

        return [
            'having' => [$having],
        ];
    }

}
