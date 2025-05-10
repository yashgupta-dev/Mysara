<?php

namespace app\controllers\backend\Common;

use app\controllers\BaseController;
use app\core\Json;
use app\core\Response;

class Autocomplete extends BaseController
{

    protected $json;

    protected $model;

    /**
     * __construct
     *
     * @param  mixed $mode
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->model = new \app\model\Backend\Autocomplete();
    }

    public function autocomplete() {
        if ($this->requestMethod == 'GET') {
            $table  = (string) $this->requestParam['table'] ?? '';
            $search_column  = (string) $this->requestParam['search_column'] ?? '';
            $fields = (array)$this->requestParam['select_columns'] ??  [];
            $query =  (string)$this->requestParam['query'] ?? '';

            $response = $this->model->autocomplete($table, $fields, $search_column, $query);
            $results = [];
            if(!empty($response)) {
                foreach ($response as $key => $value) {
                    $v = array_values($value);
                    $results[] = [
                        'id'    => $v[0] ?? '',
                        'name'  => $v[1] ?? ''
                    ];
                }
            }

            $this->json = $results; 
        }
        Response::json(Json::encode($this->json));
    }

}