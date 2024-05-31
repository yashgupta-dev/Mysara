<?php

namespace app\controllers\backend\System;

use app\core\Tygh;
use app\controllers\BaseController;

class Extensions extends BaseController
{
    /**
     * __construct
     *
     * @param  mixed $mode
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->executeMiddleware($this->requestParam, ['AuthMiddleware', 'PermissionMiddleware','NotificationMiddleware']);
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        Tygh::assign('extensions',$this->extensions());
        Tygh::display('backend/system/extension/lists');
    }


    /**
     * extensions
     *
     * @param  mixed $dir
     * @return array
     */
    protected function extensions($dir = APP . 'controllers/backend/Extension/')
    {
        // Compatibility code for old extension folders
        $files = glob($dir . '*');

        if ($files) {
            foreach ($files as $file) {
                if (!strpos($file, '.php')) {
                    $categoriesExtension = explode($dir, $file)[1] ?? $file;

                    $data[] = array(
                        'name'      => $categoriesExtension,
                        'icon'      => substr(strtoupper($categoriesExtension),0,1),
                        'code'      => strtolower($categoriesExtension),
                        'count'     => count(glob($dir . $categoriesExtension.'/*')) .' '. strtolower($categoriesExtension),
                        'view'   => $this->redirect->link('admin.php?dispatch=extension.extension', '&code=' . $categoriesExtension)
                    );
                }
            }
        }

        $sort_order = array();

        foreach ($data as $key => $value) {
            $sort_order[$key] = $value['name'];
        }

        array_multisort($sort_order, SORT_ASC, $data);

        return $data;
    }
}
