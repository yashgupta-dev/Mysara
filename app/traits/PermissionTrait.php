<?php

namespace app\traits;

trait PermissionTrait
{
    
    /**
     * geNotification
     *
     * @return array
     */
    protected function geNotification()
    {
        return [
            'account_update'        => 'Y',
            'login'                 => 'Y',
            'password_update'       => 'Y',
            'new_customer_add'      => 'N',
            'permission_update'     => 'N',
            'permission_created'    => 'N',
            'permission_deleted'    => 'N'
        ];
    }
}
