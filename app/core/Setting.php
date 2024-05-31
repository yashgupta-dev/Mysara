<?php

namespace app\core;

use app\model\BaseModel;

class Setting extends BaseModel{

    protected $config = [];
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
        
    /**
     * getAll
     *
     * @return array
     */
    public function getAll() {

        $query = $this->select('settings',array('value'),array(),'mysqli_fetch_assoc');
        foreach ($query as $result) {
			if (!$result['serialized']) {
				$this->config[$result['key']] = $result['value'];
			} else {
				$this->config[$result['key']] = json_decode($result['value'], true);
			}
		}   

        return $this->config;
    }
    
    /**
     * get
     *
     * @param  mixed $key
     * @return array
     */
    public function get($key) {
        $conditions['name'] = $key;
        $value = $this->select('settings',array('value','serialized'),$conditions,'mysqli_fetch_assoc');
        if (!empty($value)) {
            if (!$value['serialized']) {
                return $value['value'];
            } else {
                return json_decode($value['value'],true);
            }
        }
    }



}