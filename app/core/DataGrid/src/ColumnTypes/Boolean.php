<?php

namespace app\core\DataGrid\src\ColumnTypes;

use app\core\DataGrid\src\Column;
use app\core\DataGrid\src\Exceptions\InvalidColumnException;
use app\core\DataGrid\src\Enums\FilterTypeEnum;
use app\core\DataGrid\src\Exceptions\InvalidColumnExpressionException;

class Boolean extends Column
{
    /**
     * Set filterable type.
     */
    public function setFilterableType(?string $filterableType): void
    {
        if (
            $filterableType
            && ($filterableType !== FilterTypeEnum::DROPDOWN)
        ) {
            throw new InvalidColumnException('Boolean filters will only work with `dropdown` type. Either remove the `filterable_type` or set it to `dropdown`.');
        }

        if (! $filterableType) {
            $filterableType = FilterTypeEnum::DROPDOWN;
        }

        parent::setFilterableType($filterableType);
    }

    /**
     * Set filterable options.
     */
    public function setFilterableOptions(array $filterableOptions): void
    {
        if (empty($filterableOptions)) {
            $filterableOptions = [
                [
                    'label' => __('admin::app.components.datagrid.filters.boolean-options.true'),
                    'value' => 1,
                ],
                [
                    'label' => __('admin::app.components.datagrid.filters.boolean-options.false'),
                    'value' => 0,
                ],
            ];
        }

        parent::setFilterableOptions($filterableOptions);
    }

    /**
     * Process filter.
     */
    public function processFilter($requestedValues): array
    {
        $conditions = [];

        if (is_string($requestedValues)) {
            $conditions[] = "{$this->columnName} = $requestedValues";
        } elseif (is_array($requestedValues)) {
            foreach ($requestedValues as $value) {
                $conditions[] = "{$this->columnName} =  $value";
            }
        } else {
            throw new InvalidColumnExpressionException('Only string and array are allowed for boolean column type.');
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
