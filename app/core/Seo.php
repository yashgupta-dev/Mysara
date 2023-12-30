<?php

namespace app\core;

use app\core\DB;

require_once './config.php';
class Seo
{

    public function route($params)
    {
        // Add rewrite to url class
        // if ($this->config->get('config_seo_url')) {
        // 	$this->url->addRewrite($this);
        // }

        // Decode URL

        if (isset($params['path'])) {

            $query = DB::get()->get->query("SELECT `seo_url` FROM `seo` WHERE `seo_origin` = '" . (string)$params['path'] . "' AND `status` = 1");

            if ($query->num_rows) {

                $url = $query->fetch_assoc()['seo_url'];
                return BASE_URL.$url;
            } else {
                return BASE_URL . $params['path'];
            }
        }
        
    }
}
