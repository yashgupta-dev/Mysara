<?php
require_once './config.php';
function smarty_function_asset($params, $smarty)
{
    $assetPath = isset($params['path']) ? $params['path'] : '';
    return BASE_URL . $assetPath; // Define BASE_URL according to your project's setup
}
