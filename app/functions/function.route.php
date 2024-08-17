<?php

use app\core\Seo;

function smarty_function_route($params, $smarty)
{
    $route = new Seo();
    $newRoute = $route->route($params);
    return $newRoute;
}
