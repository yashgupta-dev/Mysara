<?php

namespace app\core\DataGrid\src\Enums;

use app\core\DataGrid\src\ColumnTypes\Date;
use app\core\DataGrid\src\ColumnTypes\Text;
use app\core\DataGrid\src\ColumnTypes\Boolean;
use app\core\DataGrid\src\ColumnTypes\Decimal;
use app\core\DataGrid\src\ColumnTypes\Integer;
use app\core\DataGrid\src\ColumnTypes\Datetime;
use app\core\DataGrid\src\ColumnTypes\Aggregate;
use app\core\DataGrid\src\Exceptions\InvalidColumnTypeException;

class ColumnTypeEnum
{
    /**
     * String.
     */
    const STRING    = 'string';

    /**
     * Integer.
     */
    const INTEGER   = 'integer';

    /**
     * Decimal.
     */
    const DECIMAL   = 'decimal';

    /**
     * Boolean.
     */
    const BOOLEAN   = 'boolean';

    /**
     * Date.
     */
    const DATE      = 'date';

    /**
     * Datetime.
     */
    const DATETIME  = 'datetime';

    /**
     * Aggreagate.
     */
    const AGGREGATE = 'aggregate';

    /**
     * Get the corresponding class name for the column type.
     *
     * @param string $type
     * @return string
     * @throws InvalidColumnTypeException
     */
    public static function getClassName(string $type): string
    {
        $map = [
            self::STRING    => Text::class,
            self::INTEGER   => Integer::class,
            self::DECIMAL   => Decimal::class,
            self::BOOLEAN   => Boolean::class,
            self::DATE      => Date::class,
            self::DATETIME  => Datetime::class,
            self::AGGREGATE => Aggregate::class,
        ];

        if (!isset($map[$type])) {
            throw new InvalidColumnTypeException("Invalid column type: {$type}");
        }

        return $map[$type];
    }
}
