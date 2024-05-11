<?php
namespace app\model;

use app\core\DB;
use Exception;

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
        
    }

    /**
     * select
     *
     * @param  string $table
     * @param  array $select
     * @param  array $where
     * @return array
     */
    public function select($table = '', $selection = array(), $where = array(), $func = 'fetch_assoc')
    {   

        try {
            $query = '';

            $query .= "SELECT " . (is_array($selection) ? implode(",", $selection) : $selection) . " FROM $table";
            if (!empty($where)) {
                $query .= " WHERE 1 ";
                foreach ($where as $column => $values) {
                    if (is_array($values)) { 
                        if($values[1] == 'LIKE') {
                            $value = "'$values[0]%'";
                        }
                        else if($values[1] == 'BETWEEN') {
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
                    $query .= "AND `$column` $constraint $value ";
                }
            }

            if($func == 'mysqli_fetch_all') {
                return $func(DB::get()->get->query($query),MYSQLI_ASSOC);
            } else {
                return $func(DB::get()->get->query($query));
            }
            
        } catch (\Exception $e) {
            $this->_writeLog($this->logFile, $e->getMessage());
            return ['success'=> false, 'message' => $e->getMessage()];
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

            DB::get()->get->query($query . '' . $setParams . ' ' . $condition);
            return ['success'=> true, 'message' => 'Changes successfully saved.'];

        } catch (\Exception $e) {
            $this->_writeLog($this->logFile, $e->getMessage());
            return ['success'=> false, 'message' => $e->getMessage()];
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

            DB::get()->get->query($query . '' . $setParams . ' ' . $condition);
            
            return ['success'=> true, 'message' => 'Changes successfully saved.'];

        } catch (\Exception $e) {
            $this->_writeLog($this->logFile, $e->getMessage());
            return ['success'=> false, 'message' => $e->getMessage()];
            
        }
    }
    
    /**
     * getLastId
     *
     * @return bool|int
     */
    public function getLastId() {
        try {

            $response = DB::get()->get->getLastId();

        } catch(Exception $e) {
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

                $response = DB::get()->get->query($query . '' . $condition);
                return ['success'=> true, 'message' => 'Changes successfully saved.'];

            } catch (\Exception $e) {
                $this->_writeLog($this->logFile, $e->getMessage());
                return ['success'=> false, 'message' => $e->getMessage()];
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
    public function query($table, $func, $fields = [], $join = [], $conditions = [], $other = []) {
        try {

            $sql = "SELECT ".implode(', ', $fields)." FROM ".$table." ";
            $sql .= implode(' ', $join);
            $sql .= implode(' ', $conditions);
            $sql .= implode(', ', $other);

            if($func == 'mysqli_fetch_all') {
                return $func(DB::get()->get->query($sql),MYSQLI_ASSOC);
            } else {
                return $func(DB::get()->get->query($sql));
            }
            
        } catch (\Exception $e) {
            $this->_writeLog($this->logFile, $e->getMessage());
            return ['success'=> false, 'message' => $e->getMessage()];
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
        $allowedClause = array('NOT IN', 'IN','LIKE');
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
