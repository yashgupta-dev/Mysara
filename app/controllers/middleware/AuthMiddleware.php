<?php
namespace app\controllers\middleware;

use app\core\Redirect;
use core\engine\Session;

class AuthMiddleware {
    public function handle($request) {
        // Check if user is authenticated
        if (!$this->isAuthenticated()) {
            // If not authenticated, redirect to login page or return an error
            Redirect::url('admin.php?dispatch=auth.login');
        }

        // If authenticated, pass the request to the next middleware or controller
        return $request;
    }

    private function isAuthenticated() {
        // Implement your authentication logic here
        // For example, you can check if a user is logged in by checking session or cookies
        return !empty(Session::get('isAuth')) ? true : false;
    }
}