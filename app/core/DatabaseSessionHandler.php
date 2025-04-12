<?php

namespace app\core;

use app\model\BaseModel;
use core\engine\Session;
use SessionHandlerInterface;

class DatabaseSessionHandler extends BaseModel implements \SessionHandlerInterface
{
    protected $table;

    public function __construct($table = 'sessions')
    {
        parent::__construct();

        $this->table = $table;
    }
        
    /**
     * open
     *
     * @param  mixed $savePath
     * @param  mixed $sessionName
     * @return bool
     */
    public function open($savePath, $sessionName): bool
    {
        return true;
    }
    
    /**
     * close
     *
     * @return bool
     */
    public function close(): bool
    {
        return true;
    }
    
    /**
     * read
     *
     * @param  mixed $sessionId
     * @return string
     */
    public function read(string $sessionId): string
    {
        $stmt = $this->select($this->table, ['payload'], ['id' => $sessionId]);

        if (!empty($stmt['payload'])) {
            return base64_decode($stmt['payload']);
        }
        return '';
    }
    
    /**
     * write
     *
     * @param  mixed $sessionId
     * @param  mixed $data
     * @return bool
     */
    public function write(string $sessionId, string $data): bool
    {

        $array['id'] =  $sessionId;
        $array['payload'] =  base64_encode($data);
        $array['last_activity'] =  time();

        // Assuming you have functions or globals to get these details
        $userId = Session::get('auth')['id'] ?? 0;
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        $userAgent = $_SERVER['HTTP_USER_AGENT'];

        $array['user_id'] =  $userId;
        $array['ip_address'] =  $ipAddress;
        $array['user_agent'] =  $userAgent;

        return $this->replace($this->table, $array);
    }
    
    /**
     * destroy
     *
     * @param  mixed $sessionId
     * @return bool
     */
    public function destroy(string $sessionId): bool
    {
        
        return $this->delete($this->table, ['id' => $sessionId]);
    }
    
    /**
     * gc
     *
     * @param  mixed $maxlifetime
     * @return int
     */
    public function gc(int $maxlifetime): int|false
    {
        $old = time() - $maxlifetime;
        return $this->delete($this->table, ['last_activity' => $old.':<']);
    }
}
