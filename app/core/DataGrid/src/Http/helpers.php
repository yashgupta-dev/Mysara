<?php

use app\core\DataGrid\src\DataGrid;
use app\core\DataGrid\src\Exceptions\InvalidDataGridException;

if (!function_exists('fn_datagrid')) {

    function fn_datagrid(string $datagridClass): DataGrid 
    {
        if (!class_exists($datagridClass)) {
            throw new InvalidDataGridException("Class '{$datagridClass}' does not exist.");
        }

        if (!is_subclass_of($datagridClass, DataGrid::class)) {
            throw new InvalidDataGridException("'{$datagridClass}' must extend '" . DataGrid::class . "'.");
        }
        
        return new $datagridClass(); // Directly instantiate the class
    }
}
