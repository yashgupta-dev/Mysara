<?php

namespace app\model;

use app\controllers\BaseController;
use Exception;
use app\core\DB;

/**
 * BaseModel
 */
class BaseModel extends BaseController
{

    /**
     * @var string logFile is the file path of the logs.
     */
    public $logFile = CORE . '/logs/error_log.log';

    /**
     * setting
     *
     * @var array|object|string
     */
    protected $setting;

    protected $redirect;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * select
     *
     * @param  string $table
     * @param  array $select
     * @param  array $where
     * @return array
     */
    public function select($table = '', $selection = array(), $where = array(), $func = 'row', $sorting = [], $request = array())
    {

        try {
            $query = '';
            $query .= "SELECT " . (is_array($selection) ? implode(",", $selection) : $selection) . " FROM $table";
            if (!empty($where)) {
                $query .= " WHERE 1 ";
                foreach ($where as $column => $values) {
                    if (is_array($values)) {
                        if ($values[1] == 'LIKE') {
                            $value = "'$values[0]%'";
                        } else if ($values[1] == 'BETWEEN') {
                            $value = "$values[0]";
                        } else {
                            $value = $this->checkWhereClause($values[1]) ? "('" . implode("', '", $values[0]) . "')" : $this->checkIsString($values[0]);
                        }

                        $constraint = $values[1];
                    } else {
                        $_isValid = !empty(explode(':', $values)[1]);
                        $value = $_isValid ? $this->checkIsString(explode(':', $values)[0]) : $this->checkIsString($values);
                        $constraint = $_isValid ? explode(':', $values)[1] : '=';
                    }
                    $query .= "AND $column $constraint $value ";
                }
            }
            // sorting
            if (!empty($sorting)) {
                $query .= implode(' ', $sorting);
            }   

            // pagination
            if (!empty($request['items_per_page']) && (!empty($request['offset']) && is_numeric($request['offset']) && $request['offset'] >= 0)) {
               $query .= " LIMIT " . (int)$request['offset'] . "," . (int)$request['items_per_page'];
            }

            $func = $this->getMysqlFetch($func);
            
            if ($func == 'mysqli_fetch_all') {
                return $func(DB::get()->get->query($query), MYSQLI_ASSOC);
            } else {

                return $func(DB::get()->get->query($query));
            }
        } catch (\Exception $e) {
            $this->_writeLog($this->logFile, $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * update
     * 
     * @param string
     * @param array
     * @param array
     * 
     * @return int
     */
    public function update($table, $params, $where = array())
    {

        // update query
        $query = "UPDATE $table SET ";

        $setParams = $condition = '';

        // making condition
        if (!empty($where)) {
            $condition .= " WHERE 1 ";

            foreach ($where as $column => $values) {
                if (is_array($values)) {
                    if ($this->checkWhereClause($values[1])) {
                        $value = "('" . implode("', '", $values[0]) . "')";
                    } else {
                        $value = $this->checkIsString($values[0]);
                    }
                    $constraint = $values[1];
                } else {

                    $_isValid = !empty(explode(':', $values)[1]) ? true : false;
                    if ($_isValid) {
                        $value = $this->checkIsString(explode(':', $values)[0]);
                        $constraint = explode(':', $values)[1];
                    } else {
                        $value = $this->checkIsString($values);
                        $constraint = '=';
                    }
                }
                $condition .= "AND $column $constraint $value ";
            }
        }

        // making update params         
        if (!empty($params)) {
            $setParams = array_map(function ($key, $value) {
                return "$key = '$value'";
            }, array_keys($params), $params);

            $setParams = implode(', ', $setParams);
        }

        try {

            return DB::get()->get->query($query . '' . $setParams . ' ' . $condition);
            // return ['success' => true, 'message' => 'Changes successfully saved.'];
        } catch (\Exception $e) {
            $this->_writeLog($this->logFile, $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * update
     * 
     * @param string
     * @param array
     * @param array
     * 
     * @return int
     */
    public function replace($table, $params, $where = array())
    {

        // update query
        $query = "REPLACE INTO $table SET ";

        $setParams = $condition = '';

        // making condition
        if (!empty($where)) {
            $condition .= " WHERE 1 ";

            foreach ($where as $column => $values) {
                if (is_array($values)) {
                    if ($this->checkWhereClause($values[1])) {
                        $value = "('" . implode("', '", $values[0]) . "')";
                    } else {
                        $value = $this->checkIsString($values[0]);
                    }
                    $constraint = $values[1];
                } else {

                    $_isValid = !empty(explode(':', $values)[1]) ? true : false;
                    if ($_isValid) {
                        $value = $this->checkIsString(explode(':', $values)[0]);
                        $constraint = explode(':', $values)[1];
                    } else {
                        $value = $this->checkIsString($values);
                        $constraint = '=';
                    }
                }
                $condition .= "AND $column $constraint $value ";
            }
        }

        // Making update params
        if (!empty($params)) {
            $setParams = array_map(function ($key, $value) {
                return "$key = '$value'";
            }, array_keys($params), $params);

            $setParams = implode(', ', $setParams);
        }

        try {
            
            return DB::get()->get->query($query . '' . $setParams . ' ' . $condition);

            // return ['success' => true, 'message' => 'Changes successfully saved.'];
        } catch (\Exception $e) {
            $this->_writeLog($this->logFile, $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * getLastId
     *
     * @return bool|int
     */
    public function getLastId()
    {
        try {

            return DB::get()->get->insert_id;
        } catch (Exception $e) {
            $this->_writeLog($this->logFile, $e->getMessage());
            return false;
        }
    }

    /**
     * 
     * @param string
     * @param array
     * 
     * @return int
     */
    // public function insert($table,$params){

    //     $query = "INSERT INTO " . DB_PREFIX . "$table";

    //     try {            
    //         $response = DB_query($query,$params);
    //     } catch (\Exception $e) {

    //         $this->writeLog($this->logFile,$e->getMessage());
    //     }

    // }

    /**
     * 
     * @param string
     * @param array
     * 
     * @return void
     */
    public function delete($table, $where = array())
    {
        $query = "DELETE FROM $table";
        $condition = '';
        if (!empty($where)) {
            $condition .= " WHERE 1 ";

            foreach ($where as $column => $values) {
                if (is_array($values)) {
                    if ($this->checkWhereClause($values[1])) {
                        $value = "('" . implode("', '", $values[0]) . "')";
                    } else {
                        $value = $this->checkIsString($values[0]);
                    }
                    $constraint = $values[1];
                } else {

                    $_isValid = !empty(explode(':', $values)[1]) ? true : false;
                    if ($_isValid) {
                        $value = $this->checkIsString(explode(':', $values)[0]);
                        $constraint = explode(':', $values)[1];
                    } else {
                        $value = $this->checkIsString($values);
                        $constraint = '=';
                    }
                }
                $condition .= "AND $column $constraint $value ";
            }

            try {
                $this->_writeLog($this->logFile, $query . '' . $condition);
                return DB::get()->get->query($query . '' . $condition);
                // return ['success' => true, 'message' => 'Changes successfully saved.'];
            } catch (\Exception $e) {
                $this->_writeLog($this->logFile, $e->getMessage());
                return ['success' => false, 'message' => $e->getMessage()];
            }
        }
    }

    /**
     * query
     *
     * @param  string $table
     * @param  array $fields
     * @param  array $join
     * @param  array $conditions
     * @param  array $other
     * @param  string $func
     * @return array
     */
    public function query($table, $func, $fields = [], $join = [], $conditions = [], $other = [])
    {
        try {

            $sql = "SELECT " . implode(', ', $fields) . " FROM " . $table . " ";
            $sql .= implode(' ', $join);
            $sql .= implode(' ', $conditions);
            $sql .= implode(', ', $other);

            $func = $this->getMysqlFetch($func);
            
            if ($func == 'mysqli_fetch_all') {
                return $func(DB::get()->get->query($sql), MYSQLI_ASSOC);
            } else {
                return $func(DB::get()->get->query($sql));
            }
        } catch (\Exception $e) {
            $this->_writeLog($this->logFile, $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * @param string
     * 
     * @return string
     */
    private function checkIsString($value)
    {
        return (is_string($value)) ? "\"$value\"" : $value;
    }

    /**
     * Check Where clause exist or not.
     * 
     * @param string
     * 
     * @return bool
     */
    private function checkWhereClause($value)
    {
        $allowedClause = array('NOT IN', 'IN', 'LIKE');
        return in_array($value, $allowedClause);
    }

    /**
     * @param string
     * @param array
     * 
     * @return string|array|void
     */
    private function _writeLog($file, $contents)
    {
        $file = fopen($this->logFile, "a");
        $contents = date("Y-m-d h:i:s") . " " . $contents . "\n";
        fwrite($file, $contents);
        fclose($file);
    }
    
    /**
     * getMysqlFetch
     *
     * @param  mixed $key
     * @return string
     */
    private function getMysqlFetch($key) {
        switch ($key) {
            case 'row':
                return 'mysqli_fetch_assoc';
                break;

            case 'rows':
                return 'mysqli_fetch_all';
                break;
            
            default:
                return 'mysqli_fetch_assoc';
                break;
        }
    }
    
    /**
     * pagination
     *
     * @param  mixed $table
     * @param  mixed $selection
     * @param  mixed $where
     * @param  mixed $func
     * @param  mixed $sorting
     * @param  mixed $items_per_page
     * @return array
     */
    public function pagination($table = '', $selection = array(), $where = array(), $func = 'row', $sorting = [], $items_per_page = 0, $page = 1) {
        $params = [];        
        $response = $this->select($table, $selection, $where, $func, $sorting);
        
        if(!empty($response)) {
            $totalItems = $response['total_items'] ?? 0;
            $params['items_per_page'] = $items_per_page;
            $params['page'] = $page;
            $params['total_items'] = $totalItems;
            if (!empty($page)) {
                $page = $page;
                if (($page - 1) * $items_per_page >= $totalItems) {

                    $page = ceil($totalItems / $items_per_page);
                }

                $offset = (($page - 1) * $items_per_page);
            }
            
            $params['offset'] = $offset ?? 0;
        }

        return $params;
    }
}
