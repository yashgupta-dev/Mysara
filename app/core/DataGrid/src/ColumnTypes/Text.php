<?php

namespace app\core\DataGrid\src\ColumnTypes;

use app\core\DataGrid\src\Column;
use app\core\DataGrid\src\Enums\FilterTypeEnum;
use app\core\DataGrid\src\Exceptions\InvalidColumnExpressionException;

class Text extends Column
{
    /**
     * Process filter.
     */
    public function processFilter($requestedValues): array
    {
        $conditions = [];
        
        // Use exact match for dropdown
        if ($this->filterableType === FilterTypeEnum::DROPDOWN) {
            if (is_string($requestedValues)) {
                $conditions[] = db_quote(" AND {$this->columnName} = ?s", $requestedValues);
            } elseif (is_array($requestedValues)) {
                $orConditions = [];
                foreach ($requestedValues as $value) {
                    $orConditions[] = db_quote("{$this->columnName} = ?s", $value);
                }
                $conditions[] = ' AND (' . implode(' OR ', $orConditions) . ')';
            } else {
                throw new InvalidColumnExpressionException('Only string and array are allowed for dropdown values.');
            }

            return $conditions;
        }

        // Use LIKE match for others
        if (is_string($requestedValues)) {
            $conditions[] = db_quote(" AND {$this->columnName} LIKE ?l", "%$requestedValues%");
        } elseif (is_array($requestedValues)) {
            $orConditions = [];
            foreach ($requestedValues as $value) {
                $orConditions[] = db_quote("{$this->columnName} LIKE ?l", "%$value%");
            }
            $conditions[] = ' AND (' . implode(' OR ', $orConditions) . ')';
        } else {
            throw new InvalidColumnExpressionException('Only string and array are allowed for text column type.');
        }

        return $conditions;
    }

}
