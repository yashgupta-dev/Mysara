<?php
namespace app\core;

use core\engine\Session;

class Notification
{
    const TYPE_INFO     = 'I';
    const TYPE_OK       = 'O';
    const TYPE_WARNING  = 'W';
    const TYPE_ERROR    = 'E';

    public static function set($type, $title, $message, $state = 'K')
    {
        
        if (!empty(Session::get('notifications'))) {
            Session::set('notifications',[]);
        }

        $notifications[] = [
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'state' => $state,
        ];
        Session::set('notifications',$notifications);

    }

    public static function get()
    {
        if (!empty(Session::get('notifications'))) {
            $notifications = Session::get('notifications');
            Session::remove('notifications');
            return $notifications;
        }

        return [];
    }

    public static function hasNotifications()
    {
        return !empty(Session::get('notifications'));
    }
}
