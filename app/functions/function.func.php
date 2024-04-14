<?php

function smarty_function_func($params, $smarty)
{
    require_once './app/controllers/function/function.php';

    if (!empty($params['name'])) {
        $functionName = $params['name'];
        // Check if the function exists and call it without parameters
        if (function_exists($functionName)) {
            return call_user_func($functionName);
        } else {
            return "Function '$functionName' not found";
        }
    }
}
