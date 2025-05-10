<?php

namespace app\model\Backend;

use app\model\BaseModel;

/**
 * Autocomplete
 */
class Autocomplete extends BaseModel
{
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function autocomplete($table, $columns, $search_column, $query) {
        $fields = $conditions = $join = $sorting = array();
        $fields = $columns;
        $join[] = $table;

        $conditions[$search_column] = array($query, 'LIKE');

        return $this->select(implode(' ', $join), $fields, $conditions, 'rows');
    }

}