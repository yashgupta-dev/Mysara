<?php
namespace app\controllers\middleware;

use app\core\Tygh;
use app\core\Notification;

class NotificationMiddleware
{
    public function handle($request)
    {
        // If the session has notifications, pass them to the view layer
        if (Notification::hasNotifications()) {
            Tygh::assign('notifications', Notification::get());
        }

        return $request;
    }
}
