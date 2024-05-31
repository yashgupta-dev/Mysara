<?php

namespace app\core;

class DBSession {

    private $db;
    
    public function __construct($db) {
        $this->db = $db;
        session_set_save_handler(
            array($this, 'open'),
            array($this, 'close'),
            array($this, 'read'),
            array($this, 'write'),
            array($this, 'destroy'),
            array($this, 'gc')
        );
        register_shutdown_function('session_write_close');
    }

    public function open() {
        return true;
    }

    public function close() {
        return true;
    }

    public function read($session_id) {
        
        $stmt = $this->db->get->query("SELECT payload as data FROM sessions WHERE id = '".$session_id."'");
        $result = $stmt->fetch_assoc();
        return $result ? $result : '';
    }

    public function write($session_id, $data) {
        
        
        $last_activity = time();
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $query = "REPLACE INTO sessions (id, payload, last_activity,ip_address) VALUES ('$session_id', '$data', '$last_activity','$ip_address')";
        $stmt = $this->db->get->query($query);
        return true;
    }

    public function destroy($session_id) {
        $query = "DELETE FROM sessions WHERE id = $session_id";
        $stmt = $this->db->get->query($query);
        
        return true;
    }

    public function gc($max_lifetime) {
        $expired_time = time() - $max_lifetime;
        $query = "DELETE FROM sessions WHERE last_activity < $expired_time";
        $stmt = $this->db->get->query($query);
        
        return true;
    }
}

// Usage
// $db = new PDO('mysql:host=localhost;dbname=your_database', 'username', 'password');
// $sessionManager = new SessionManager($db);
// session_start();
?>
