<?php

namespace app\model\Backend;

use app\model\BaseModel;

/**
 * ExtensionModel
 */
class ExtensionModel extends BaseModel
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

    /**
     * getInstalled
     *
     * @param  mixed $code
     * @return array
     */
    public function getInstalled($code)
    {
        $condition = $join = [];

        $condition['type']  = $code;
        $results =  $this->select('extension', ['*'], $condition, 'rows');

        $extension_data = [];
        foreach ($results as $result) {
            $extension_data[] = ucfirst($result['code']);
        }

        return $extension_data;
    }

    /**
     * install
     *
     * @param  mixed $code
     * @param  mixed $type
     * @return bool
     */
    public function install($code, $type)
    {
        $extensions = $this->getInstalled($code);
        
        if (!in_array($code, $extensions)) {
            
            return $this->replace('extension', ['type' => $code, 'code' => $type]);
        }
    }

    /**
     * uninstall
     *
     * @param  mixed $code
     * @param  mixed $type
     * @return void
     */
    public function uninstall($code, $type)
    {

        $this->delete('extension', ['type' => $code, 'code' => $type]);
        $this->delete('settings',  ['code' => strtolower($code.'_'.$type)]);
    }

    public function deleteModulesByCode($code)
    {
    }
        
    /**
     * getSettings
     *
     * @param  mixed $code
     * @param  mixed $store_id
     * @return array
     */
    public function getSettings($code, $store_id = 0) {
        $setting_data = array();

        $results = $this->select('settings',['*'],['store_id' => $store_id, 'code' => $code],'rows');

		foreach ($results as $result) {
            
			if (!$result['serialized']) {
				$setting_data[$result['name']] = $result['value'];
			} else {
				$setting_data[$result['name']] = json_decode($result['value'], true);
			}
		}

		return $setting_data;
    }

    /**
     * editSettings
     *
     * @param  mixed $code
     * @param  mixed $data
     * @param  mixed $store_id
     * @return void
     */
    public function editSettings($code, $data, $store_id = 0){
        $this->delete('settings',array('store_id' => $store_id, 'code' => $code));

		foreach ($data as $key => $value) {
			if (substr($key, 0, strlen($code)) == $code) {
				if (!is_array($value)) {
                    $this->replace('settings',['store_id' => $store_id, 'code' => $code, 'name' => $key, 'value' => $value]);
				} else {
                    $this->replace('settings',['store_id' => $store_id, 'code' => $code, 'name' => $key, 'value' => json_encode($value,true),'serialized' => '1']);
				}
			}
		}
    }
}
