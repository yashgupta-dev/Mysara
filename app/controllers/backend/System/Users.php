<?php

namespace app\controllers\backend\System;

use app\controllers\backend\Datagrid\System\UserDataGrid;
use app\core\Json;
use app\core\Tygh;
use app\core\Email;
use app\core\Response;
use app\core\Notification;
use app\controllers\BaseController;
use app\core\validation\Validation;
use app\model\Backend\SettingModel;

class Users extends BaseController
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

        list($users, $search) = fn_datagrid(UserDataGrid::class)->process();
        
        Tygh::assign('lists', $users);
        Tygh::assign('search', $search);
        Tygh::display('backend/system/users');
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
                'firstname' =>  'required|string|regex:[a-zA-z]',
                'lastname'  =>  'required|string|regex:[a-zA-z]',
                'email'     =>  'required|email|unique:users.email',
                'phone'     =>  'required|phone|unique:users.phone',
                'group'     =>  'required|in:roles.id',
                'password'  =>  'required',
                'confirm_password'  =>  'required|equals:' . $this->requestParam['password']

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
                $res = $this->model->addUser($this->requestParam);
                if ($res) {
                    // email send
                    $template = Tygh::fetch('frontend/auth/mail/register');

                    Email::to($this->requestParam['email']);
                    Email::subject('Mysara:: Register notification');
                    Email::message($template);
                    Email::sendEmail();
                    Notification::set('O', 'Success', $this->language['text_success']);
                    $response = ['success' => true, 'message' => $this->language['text_success'], 'redirect_url' => $this->redirect->link('admin.php?dispatch=system.users')];
                } else {
                    Notification::set('E', 'Error', sprintf($this->language['text_failed'], 'add'));
                    $response = ['errors' => sprintf($this->language['text_failed'], 'add'), 'redirect_url' => $this->redirect->link('admin.php?dispatch=system.users.add')];
                }
            }

            Response::json(Json::encode($response));
        }
        list($groups) = $this->model->getGroups();
        Tygh::assign('groups', $groups);
        Tygh::assign('route', 'admin.php?dispatch=system.users.add');
        Tygh::display('backend/system/users-form.tpl');
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
                'firstname' =>  'required|string|regex:[a-zA-z]',
                'user_id'   =>  'required|in:users.id',
                'lastname'  =>  'required|string|regex:[a-zA-z]',
                'email'     =>  'required|email|not_in:users.email,id-' . $this->requestParam['user_id'],
                'phone'     =>  'required|phone|not_in:users.phone,id-' . $this->requestParam['user_id'],
                'group'     =>  'required|in:roles.id',
                'user_status'     =>  'required|in_array:A,D',
                'confirm_password'  =>  'equals:' . $this->requestParam['password']

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
                $res = $this->model->updateUser($this->requestParam);
                if ($res) {
                    // email send
                    $template = Tygh::fetch('frontend/auth/mail/register');

                    Email::to($this->requestParam['email']);
                    Email::subject('Mysara:: Profile update notification');
                    Email::message($template);
                    Email::sendEmail();
                    Notification::set('O', 'Success', $this->language['text_success']);
                    $response = ['success' => true, 'message' => $this->language['text_success'], 'redirect_url' => $this->redirect->link('admin.php?dispatch=system.users')];
                } else {
                    Notification::set('E', 'Error', sprintf($this->language['text_failed'], 'add'));
                    $response = ['errors' => sprintf($this->language['text_failed'], 'add'), 'redirect_url' => $this->redirect->link('admin.php?dispatch=system.users.add')];
                }
            }

            Response::json(Json::encode($response));
        }
        list($groups) = $this->model->getGroups();
        $user = $this->model->getUser($this->requestParam);

        Tygh::assign('groups', $groups);
        Tygh::assign('user', $user);
        Tygh::assign('route', 'admin.php?dispatch=system.users.update');
        Tygh::display('backend/system/users-form.tpl');
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
                'user_id'     =>  'required|in:users.id'

            ], $this->requestParam);

            // get errors
            if (Validation::getErrors() !== true) {

                foreach (Validation::getErrors() as $key => $value) {

                    Notification::set('E', 'Error', $value);
                }
            } else {
                $res = $this->model->deleteUser($this->requestParam);
                if ($res) {
                    Notification::set('O', 'Success', $this->language['text_success']);
                } else {

                    Notification::set('E', 'Error', sprintf($this->language['text_failed'], 'delete'));
                }
            }

            $this->redirect->url('admin.php?dispatch=system.users');
        }
    }
}
