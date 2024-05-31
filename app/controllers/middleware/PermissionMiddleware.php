<?php

namespace app\controllers\middleware;

use app\core\Redirect;
use app\model\AuthModel;

class PermissionMiddleware
{
    public function handle($request)
    {
        // Check if user is access
        if (!$this->isPermission($request)) {
            // If user don't have access, redirect to error page page
            Redirect::url('admin.php?dispatch=errors.access');
        }

        // If user have access, pass the request to the next middleware or controller
        return $request;
    }

    private function isPermission($request)
    {
        $auth = new AuthModel();
        $permission = $auth->getPermissions();


        if (!empty($permission) && !empty(json_decode($permission['permission'], true)) && in_array($request['dispatch'], json_decode($permission['permission'], true)['access'])) {
            return true;
        }

        return false;
    }
}
