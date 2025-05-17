<?php

namespace app\core;
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

/**
 * DB
 */
class DB
{
    private static $instance;
    
    /**
     * conn
     *
     * @var mixed
     */
    private $conn;

    /**
     * host
     *
     * @var string
     */
    private $host = HOST;

    /**
     * username
     *
     * @var string
     */
    private $username = USERNAME;

    /**
     * password
     *
     * @var string
     */
    private $password = PASSWORD;

    /**
     * database
     *
     * @var string
     */
    private $database = DATABASE;

    /**
     * __construct
     *
     * @return void
     */
    private function __construct()
    {
        $this->conn = new \mysqli($this->host, $this->username, $this->password, $this->database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    /**
     * getInstance
     *
     * @return object
     */
    private static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new DB();
        }
        return self::$instance;
    }
    
    /**
     * __get
     *
     * @param  mixed $property
     * @return object
     */
    public function __get($property)
    {
        if ($property === 'get') {
            return $this->conn;
        }
        return null;
    }

    /**
     * DB
     *
     * @return object|array
     */
    public static function get()
    {
        return self::getInstance();
    }
}
