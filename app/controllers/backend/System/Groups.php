<?php

namespace app\controllers\backend\System;

use app\core\Json;
use app\core\Tygh;
use ReflectionClass;
use ReflectionMethod;
use app\core\Response;
use app\core\Notification;
use app\controllers\BaseController;
use app\core\validation\Validation;
use app\model\Backend\SettingModel;

class Groups extends BaseController
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
        $this->executeMiddleware($this->requestParam, ['AuthMiddleware', 'PermissionMiddleware', 'NotificationMiddleware']);
        $this->model = new SettingModel();
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {

        list($groups, $search) = $this->model->getGroups($this->requestParam);
        Tygh::assign('groups', $groups);
        Tygh::assign('search', $search);

        Tygh::display('backend/system/groups');
    }

    /**
     * update
     *
     * @return void
     */
    public function update()
    {
        if ($this->requestMethod == 'POST') {

            Validation::validate([
                'name'     =>  'required|string'

            ], $this->requestParam);

            // get errors
            if (Validation::getErrors() !== true) {

                foreach (Validation::getErrors() as $key => $value) {
                    $this->error[$key] = $value;
                }
                if (isset($this->requestParam['is_ajax'])) {
                    $response = ['errors' => $this->error];
                }
            } else {
                $res = $this->model->updateGroup($this->requestParam);
                if ($res) {
                    Notification::set('O', 'Success', $this->language['text_success']);
                    $response = ['success' => true, 'message' => $this->language['text_success'], 'redirect_url' => $this->redirect->link('admin.php?dispatch=system.groups')];
                } else {
                    Notification::set('E', 'Error', sprintf($this->language['text_failed'],'update'));
                    $response = ['errors' => sprintf($this->language['text_failed'],'update'), 'redirect_url' => $this->redirect->link('admin.php?dispatch=system.groups.update', '&group_id=' . $this->requestParam['id'])];
                }
            }

            Response::json(Json::encode($response));
        }

        $access = $this->model->getEditGroup($this->requestParam);
        if (empty($access)) {
            Notification::set('I', 'Info', $this->language['text_no_group_found']);
            $this->redirect->url('admin.php?dispatch=system.groups');
        }
        $permissions = $this->getClassMethods($this->getFiles('app/controllers/backend/*'));
        Tygh::assign('permissions', $permissions);
        Tygh::assign('groups', $access);
        Tygh::assign('access', json_decode($access['permission'], true));
        Tygh::assign('route', 'admin.php?dispatch=system.groups.update');
        Tygh::display('backend/system/groups-form.tpl');
    }

    /**
     * add
     *
     * @return void
     */
    public function add()
    {
        if ($this->requestMethod == 'POST') {

            Validation::validate([
                'name'     =>  'required|string|unique:roles.name',
                'group_type' => 'required|string'

            ], $this->requestParam);

            // get errors
            if (Validation::getErrors() !== true) {

                foreach (Validation::getErrors() as $key => $value) {
                    $this->error[$key] = $value;
                }
                if (isset($this->requestParam['is_ajax'])) {
                    $response = ['errors' => $this->error];
                }
            } else {
                $res = $this->model->addGroup($this->requestParam);
                if ($res) {
                    Notification::set('O', 'Success', $this->language['text_success']);
                    $response = ['success' => true, 'message' => $this->language['text_success'], 'redirect_url' => $this->redirect->link('admin.php?dispatch=system.groups')];
                } else {
                    Notification::set('E', 'Error', sprintf($this->language['text_failed'],'add'));
                    $response = ['errors' => sprintf($this->language['text_failed'],'add'), 'redirect_url' => $this->redirect->link('admin.php?dispatch=system.groups.update', '&group_id=' . $this->requestParam['id'])];
                }
            }

            Response::json(Json::encode($response));
        }

        $permissions = $this->getClassMethods($this->getFiles('app/controllers/backend/*'));
        Tygh::assign('permissions', $permissions);
        Tygh::assign('route', 'admin.php?dispatch=system.groups.add');
        Tygh::display('backend/system/groups-form.tpl');
    }

    /**
     * delete
     *
     * @return void
     */
    public function delete()
    {
        if ($this->requestMethod == 'GET') {

            Validation::validate([
                'group_id'     =>  'required|in:roles.id|assign:role_user.role_id'

            ], $this->requestParam);

            // get errors
            if (Validation::getErrors() !== true) {

                foreach (Validation::getErrors() as $key => $value) {

                    Notification::set('E', 'Error', $value);
                }
            } else {
                $res = $this->model->deleteGroup($this->requestParam);
                if ($res) {
                    Notification::set('O', 'Success', $this->language['text_success']);
                } else {

                    Notification::set('E', 'Error', sprintf($this->language['text_failed'],'delete'));
                }
            }

            $this->redirect->url('admin.php?dispatch=system.groups');
        }
    }

    /**
     * getFiles
     *
     * @param  mixed $pattern
     * @return array
     */
    protected function getFiles($pattern)
    {
        $files = glob($pattern, $flags = 0);
        foreach (glob($pattern) as $dir) {
            $files = array_merge($files, $this->getFiles($dir . '/' . basename($pattern), $flags));
        }
        return $files;
    }

    /**
     * getClassMethods
     *
     * @param  mixed $namespace
     * @return array
     */
    protected function getClassMethods($namespace)
    {
        // Use Reflection API to get class names in the specified namespace
        $results = [];

        $controllerExclude = [
            'app\controllers\backend\auth',
            'app\controllers\backend\common\menu',
            'app\controllers\backend\common\autocomplete',
            'app\controllers\backend\common\filemanager',
            'app\controllers\backend\errors\access',
            'app\controllers\backend\errors\modify',
            'app\controllers\basecontroller'
        ];

        $exclude = [
            '__construct',
            'getclassmethods',
            'getfiles'
        ];

        foreach ($namespace as $class) {
            if (strpos($class, '.php')) {
                // Create an instance of the controller
                $controllerClass = str_replace('/', '\\', str_replace('.php', '', $class));
                $reflector = new ReflectionClass($controllerClass);
                $methods = $reflector->getMethods(ReflectionMethod::IS_PUBLIC);
                foreach ($methods as $method) {
                    if (!in_array(strtolower($method->class), $controllerExclude)) {
                        if ($method->class === $controllerClass) {

                            if (!in_array(strtolower($method->getShortName()), $exclude)) {
                                if (in_array('index', [strtolower($method->getName())])) {
                                    $permission = strtolower(str_replace('\\', '.', explode('app\\controllers\\backend\\', $method->class)[1]));
                                } else {
                                    $permission = strtolower(str_replace('\\', '.', explode('app\\controllers\\backend\\', $method->class)[1])) . '.' . strtolower($method->getName());
                                }

                                $results[] = $permission;
                            }
                        }
                    }
                }
            }
        }

        return $results;
    }
}
