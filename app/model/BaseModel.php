<?php
namespace app\model;

use app\core\DB;

/**
 * BaseModel
 */
class BaseModel
{

    /**
     * @var string logFile is the file path of the logs.
     */
    public $logFile = CORE . '/logs/error_log.log';
    
    /**
     * conn
     *
     * @var mixed
     */
    private $conn;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        // To get the global database connection instance
        $db = DB::get();

        // To get the connection object
        $this->conn = $db->get();
    }

    /**
     * select
     *
     * @param  string $table
     * @param  array $select
     * @param  array $where
     * @return array
     */
    public function select($table = '', $selection = array(), $where = array(), $func = 'fetch_assoc()')
    {
        try {
            $query = '';

            $query .= "SELECT " . (is_array($selection) ? implode(",", $selection) : $selection) . " FROM $table";
            if (!empty($where)) {
                $query .= " WHERE 1 ";
                foreach ($where as $column => $values) {
                    if (is_array($values)) {
                        $value = $this->checkWhereClause($values[1]) ? "('" . implode("', '", $values[0]) . "')" : $this->checkIsString($values[0]);
                        $constraint = $values[1];
                    } else {
                        $_isValid = !empty(explode(':', $values)[1]);
                        $value = $_isValid ? $this->checkIsString(explode(':', $values)[0]) : $this->checkIsString($values);
                        $constraint = $_isValid ? explode(':', $values)[1] : '=';
                    }
                    $query .= "AND $column $constraint $value ";
                }
            }

            return $this->conn->query($query)->$func;
        } catch (\Exception $e) {
            $this->_writeLog($this->logFile, $e->getMessage());
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

            return $this->conn->query($query . '' . $setParams . ' ' . $condition);
        } catch (\Exception $e) {
            $this->_writeLog($this->logFile, $e->getMessage());
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

            return $this->conn->query($query . '' . $setParams . ' ' . $condition);
            // get inserted ID            
            // return $this->conn->getLastId();

        } catch (\Exception $e) {
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
    //         return db_query($query,$params);
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

                return $this->conn->query($query . '' . $condition);
            } catch (\Exception $e) {
                $this->_writeLog($this->logFile, $e->getMessage());
            }
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
        $allowedClause = array('NOT IN', 'IN');
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
}
