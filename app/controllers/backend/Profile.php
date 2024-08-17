<?php

namespace app\controllers\backend;

use app\core\Json;
use app\core\Tygh;
use app\core\Email;
use app\core\Response;
use core\engine\Session;
use app\core\Notification;
use app\controllers\BaseController;
use app\core\validation\Validation;
use app\model\Backend\ProfileModel;
use app\traits\PermissionTrait;

class Profile extends BaseController
{

    use PermissionTrait;

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

        $this->model = new ProfileModel();
    }

    /**
     * account
     *
     * @return void
     */
    public function account()
    {
        $authId = Session::get('auth')['id'];
        if ($this->requestMethod == 'POST') {

            Validation::validate([
                'firstname' =>  'required|string|regex:[a-zA-z]',
                'user_id'   =>  'required|in:users.id',
                'lastname'  =>  'required|string|regex:[a-zA-z]',
                'email'     =>  'required|email|not_in:users.email,id-' . $authId,

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
                    if(Session::get('auth')['notification']['account_update'] == 'Y') {
                        // email send
                        $template = Tygh::fetch('frontend/auth/mail/register');

                        Email::to($this->requestParam['email']);
                        Email::subject('Mysara:: Profile update notification');
                        Email::message($template);
                        Email::sendEmail();
                    }

                    Notification::set('O', 'Success', $this->language['text_success']);
                    $response = ['success' => true, 'message' => $this->language['text_success']];
                    Session::set('auth', $this->model->getUser($authId));
                } else {
                    Notification::set('E', 'Error', sprintf($this->language['text_failed'], 'add'));
                    $response = ['errors' => sprintf($this->language['text_failed'], 'add')];
                }
            }

            Response::json(Json::encode($response));
        }
        list($groups) = $this->model->getGroups();
        $user = $this->model->getUser($authId);
        $browserSessions = $this->model->getBrowserSessions($authId);

        Tygh::assign('groups', $groups);
        Tygh::assign('user', $user);
        Tygh::assign('authId', $authId);
        Tygh::assign('sesisons', $browserSessions);
        Tygh::assign('current_session_id', Session::getSessionId());
        Tygh::display('backend/profile/account');
    }

    /**
     * setting
     *
     * @return void
     */
    public function setting()
    {
        $authId = Session::get('auth')['id'];

        if ($this->requestMethod == 'POST') {

            $res = $this->model->updateNotification($this->requestParam);
            if ($res) {

                Notification::set('O', 'Success', $this->language['text_success']);

                $response = ['success' => true, 'message' => $this->language['text_success']];
                Session::set('auth', $this->model->getUser($authId));
            } else {
                Notification::set('E', 'Error', sprintf($this->language['text_failed'], 'add'));
                $response = ['errors' => sprintf($this->language['text_failed'], 'add')];
            }
            Response::json(Json::encode($response));
        }

        $user = $this->model->getUserNotification($authId);
        $user['notification_get'] = json_decode($user['notification'],true);

        Tygh::assign('user', $user);
        Tygh::assign('notification', $this->geNotification());
        Tygh::assign('authId', $authId);
        Tygh::display('backend/profile/setting');
    }
}
