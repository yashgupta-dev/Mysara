<?php

/**
 * @package		Webkul Cs-Cart Data Grid
 * @author		Webkul Software Pvt. Ltd.
 * @copyright	Copyright (c) 2024, Webkul Software Pvt. Ltd. (https://www.webkul.in/)
 * @license		webkul
 * @link		https://www.webkul.in
 */

namespace WkdatagridModels;

use Exception;

class BaseModel
{

    private $data;

    private $logId;

    private $logFileLocation;

    public function __construct()
    {
        $this->logId = TIME;

        $baseUrl = substr(__DIR__, 0, strpos(__DIR__, "WkdatagridModels"));
        $this->logFileLocation = $baseUrl . 'logs/wk_datagridmysql.log';
        // Here base model is loaded
    }

    /**
     * 
     * @param string $varName
     * 
     * @return string|array|object
     */
    public function __get($varName)
    {

        if (!array_key_exists($varName, $this->data)) {
            throw new Exception('.....');
        } else return $this->data[$varName];
    }

    /**
     * 
     * 
     * @return void
     */
    public function __set($varName, $value)
    {
        $this->data[$varName] = $value;
    }

    /**
     * 
     * @param string
     * @param string|array
     * @param array
     * @param string
     * @param string
     * 
     * @return string|array|object|void
     */
    public function select($table, $selection, $where, $func, $others = '', $limit = '', $offset = '')
    {

        $selection = (is_array($selection)) ? implode(",", $selection) : $selection;
        $selection = (empty($selection)) ? '*' : $selection;
        $query = "SELECT $selection FROM ?:$table";
        if (!empty($where)) {
            $query .= " WHERE 1 ";
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
                    if (filter_var($values, FILTER_VALIDATE_URL)) {
                        $_isValid = false;
                    }
                    if ($_isValid) {
                        $value = $this->checkIsString(explode(':', $values)[0]);
                        $constraint = explode(':', $values)[1];
                    } else {
                        $value = $this->checkIsString($values);
                        $constraint = '=';
                    }
                }
                $query .= "AND $column $constraint $value ";
            }
        }
        $query = (!empty(trim($others))) ? $query . $others : $query;
        $func = empty($func) ? 'db_get_array' : $func;

        if (!empty($limit)) {
            $data = (!empty($offset)) ? $offset . ', ' . $limit : $limit;
            $query .= " LIMIT $data";
        }

        try {
            $result = $func($query);
            return $result;
        } catch (Exception $e) {

            $this->writeLog($this->logFileLocation, $e->getMessage());
        }
    }
    
    /**
     * mtSelect
     *
     * @param  mixed $table
     * @param  mixed $selection
     * @param  mixed $where
     * @param  mixed $func
     * @param  mixed $join
     * @param  mixed $orderBy
     * @param  mixed $limit
     * @param  mixed $offset
     * @return array
     */
    public function mtSelect($table, $selection, $where, $func, $join='', $orderBy='', $limit='', $offset='') {
        $selection = (is_array($selection)) ? implode(",", $selection) : $selection;
        $query = "SELECT $selection FROM ?:$table";


        if(!empty($join)){
            $query .= " $join ";
        }


        if(!empty($where)){
            $query .= " WHERE 1 ";

            if(is_array($where)){
                foreach($where as $column => $values) {
                    if(is_array($values)){
                        if($this->checkWhereClause($values[1])) {
                            $value = "('" . implode ( "', '", $values[0] ) . "')";
                        } else {
                            $value = $this->checkIsString($values[0]);
                        }
                        $constraint = $values[1];
                    } else {
                        $value = $this->checkIsString($values);
                        $constraint = '=';
                    }
                    $query .= "AND `$column` $constraint $value ";
                }
            }else{
                $query .= " $where ";
            }
        }
        
        if(!empty($orderBy)){
            $order = is_array($orderBy) ? $orderBy[0] : $orderBy;
            $query .= "ORDER BY $order";
            if(is_array($orderBy) && isset($orderBy[1])) {
                $query .= " $orderBy[1]";
            }
        }
        if(!empty($limit)){
            $data = (!empty($offset)) ? $offset.', '.$limit : $limit;
            $query .= " LIMIT $data";
        }
        try {
            $result = $func($query);
            return $result;
        } catch (Exception $e) {
            $this->writeLog(self::MYSQL_LOG, $e->getMessage());
        }
    }

    /**
     * 
     * @param string
     * @param array
     * 
     * @return
     */
    public function insert($table, $params)
    {
        $query = "INSERT INTO ?:$table ?e";

        try {
            return db_query($query, $params);
        } catch (Exception $e) {

            $this->writeLog($this->logFileLocation, $e->getMessage());
        }
    }

    /**
     * 
     * @param string
     * @param array
     * 
     * @return void
     */
    public function replace($table, $params)
    {

        $query = "REPLACE INTO ?:$table ?e";
        try {
            return db_query($query, $params);
        } catch (Exception $e) {
            $this->writeLog($this->logFileLocation, $e->getMessage());
        }
    }

    /**
     * 
     * @param string
     * @param array
     * @param array
     * 
     * @return void
     */
    public function update($table, $params, $where = array())
    {
        $query = "UPDATE ?:$table SET ?u";
        if (!empty($where)) {
            $query .= " WHERE ";
            $condition = ' AND ';

            $extraWhere = true;
            $lastIndex = 0; // check last index
            $totalCondition = count($where); // check total where condition.

            if (count($where) > 1) {
                $extraWhere = false;
            }

            foreach ($where as $column => $values) {
                if (is_array($values)) {
                    if ($this->checkWhereClause($values[1])) {
                        $value = "('" . implode("', '", $values[0]) . "')";
                    } else {
                        $value = $this->checkIsString($values[0]);
                    }
                    $constraint = $values[1];
                } else {
                    $value = $this->checkIsString($values);
                    $constraint = '=';
                }

                // this will work for single where condition;
                if ($extraWhere) {

                    $query .= "$column $constraint $value ";
                } else {
                    // this will work for multiple where condition
                    if (++$lastIndex === $totalCondition) {
                        $query .= "$column $constraint $value";
                    } else {
                        $query .= "$column $constraint $value $condition";
                    }
                }
            }
        }
        try {
            db_query($query, $params);
        } catch (Exception $e) {
            $this->writeLog($this->logFileLocation, $e->getMessage());
        }
    }


    /**
     * 
     * @param string
     * @param array
     * 
     * @return void
     */
    public function delete($table, $where = array())
    {
        $query = "DELETE FROM ?:$table";
        if (!empty($where)) {
            $query .= " WHERE ";
            foreach ($where as $column => $value) {
                if (is_array($value)) {
                    $value = $this->checkIsString($value[0]);
                    $constraint = $value[1];
                } else {
                    $value = $this->checkIsString($value);
                    $constraint = '=';
                }
                $query .= "$column $constraint $value ";
            }

            try {
                return db_query($query);
            } catch (Exception $e) {
                $this->writeLog($this->logFileLocation, $e->getMessage());
            }
        }
    }

    public function deleteMoreCondition($table, $where = array())
    {
        $query = "DELETE FROM ?:$table";
        if (!empty($where)) {
            $query .= " WHERE ";
            $condition = ' AND ';

            $extraWhere = true;
            $lastIndex = 0; // check last index
            $totalCondition = count($where); // check total where condition.

            if (count($where) > 1) {
                $extraWhere = false;
            }

            foreach ($where as $column => $values) {
                if (is_array($values)) {
                    if ($this->checkWhereClause($values[1])) {
                        $value = "('" . implode("', '", $values[0]) . "')";
                    } else {
                        $value = $this->checkIsString($values[0]);
                    }
                    $constraint = $values[1];
                } else {
                    $value = $this->checkIsString($values);
                    $constraint = '=';
                }

                // this will work for single where condition;
                if ($extraWhere) {

                    $query .= "$column $constraint $value ";
                } else {
                    // this will work for multiple where condition
                    if (++$lastIndex === $totalCondition) {
                        $query .= "$column $constraint $value";
                    } else {
                        $query .= "$column $constraint $value $condition";
                    }
                }
            }
        }


        try {
            return db_query($query);
        } catch (Exception $e) {

            $this->writeLog($this->logFileLocation, $e->getMessage());
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
     * @param string
     * @param array
     * 
     * @return string|array|void
     */
    public function writeLog($file, $contents)
    {
        $file = fopen($this->logFileLocation, "a+");
        $contents = $this->logId . " " . date("Y-m-d h:i:s", TIME) . " " . $contents . "\n";
        fwrite($file, $contents);
        fclose($file);
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
        $allowedClause = array('NOT IN', 'IN');
        return in_array($value, $allowedClause);
    }

    public function manualQuery($query, $func)
    {

        $result = $func($query);
        return $result;
    }
}
