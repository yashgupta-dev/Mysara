<?php

namespace app\controllers\backend\Extension;

use app\core\Json;
use app\core\Setting;
use app\core\Language;
use app\core\Response;
use app\core\Notification;
use app\controllers\BaseController;
use app\model\Backend\ExtensionModel;

class Extension extends BaseController
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

        $this->model = new ExtensionModel();
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        if ($this->requestMethod == 'GET') {
            $dir = APP . 'controllers/backend/Extension/' . $this->requestParam['code'] . '/';

            $extensions = $this->model->getInstalled($this->requestParam['code']);

            foreach ($extensions as $key => $value) {

                if (!is_file($dir . $value . '.php')) {
                    $this->model->uninstall($this->requestParam['code'], $value);

                    unset($extensions[$key]);

                    $this->model->deleteModulesByCode($value);
                }
            }

            $data['extensions'] = array();

            // Create a new language container so we don't pollute the current one
            // $language = new Language($this->config->get('config_language'));

            // Compatibility code for old extension folders
            $files = glob($dir . '*');

            if ($files) {
                foreach ($files as $file) {
                    $extension = basename($file, '.php');

                    $categoriesExtension = explode(APP . 'controllers/backend/Extension/' . $this->requestParam['code'] . '/', $file)[1] ?? $file;
                    $categoriesExtension = explode('.php', $categoriesExtension)[0] ?? $categoriesExtension;

                    $lang = Language::load($categoriesExtension);
                    $module_data = array();

                    // $modules = $this->model_setting_module->getModulesByCode($extension);

                    // foreach ($modules as $module) {
                    //     if ($module['setting']) {
                    //         $setting_info = json_decode($module['setting'], true);
                    //     } else {
                    //         $setting_info = array();
                    //     }

                    //     $module_data[] = array(
                    //         'module_id' => $module['module_id'],
                    //         'name'      => $module['name'],
                    //         'status'    => (isset($setting_info['status']) && $setting_info['status']) ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
                    //         'edit'      => $this->url->link('extension/module/' . $extension, 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $module['module_id'], true),
                    //         'delete'    => $this->url->link('extension/extension/module/delete', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $module['module_id'], true)
                    //     );
                    // }


                    $data['extensions'][] = array(
                        'name'      => $lang['text_heading'] ?? $categoriesExtension,
                        'code'      => substr($categoriesExtension, 0, 1),
                        'status'    => ($this->setting->get(\strtolower($this->requestParam['code'] . '_' . $extension . '_status')) == 'A') ? $this->language['text_enabled'] : $this->language['text_disabled'],
                        'module'    => $module_data,
                        'install'   => $this->redirect->link('admin.php?dispatch=extension.extension.install', '&extension=' . $categoriesExtension . '&code=' . $this->requestParam['code']),
                        'uninstall' => $this->redirect->link('admin.php?dispatch=extension.extension.uninstall', '&extension=' . $categoriesExtension . '&code=' . $this->requestParam['code']),
                        'installed' => in_array($extension, $extensions),
                        'edit'      => $this->redirect->link('admin.php?dispatch=extension.' . \strtolower($this->requestParam['code'] . '.' . $extension))
                    );
                }
            }

            $sort_order = array();

            foreach ($data['extensions'] as $key => $value) {
                $sort_order[$key] = $value['name'];
            }

            array_multisort($sort_order, SORT_ASC, $data['extensions']);

            Response::json(Json::encode($data));
        }
    }

    /**
     * install
     *
     * @return void
     */
    public function install()
    {
        $this->model->install($this->requestParam['code'], $this->requestParam['extension']);

        // Call install method if it exsits
        // $this->load->controller('extension/module/' . $this->request->get['extension'] . '/install');
        Notification::set(Notification::TYPE_OK, 'Success', sprintf($this->language['text_extension'], $this->requestParam['extension']));

        // $this->redirect->url('admin.php?dispatch=extension.' . $this->requestParam['code'] . '.' . $this->requestParam['extension']);
        $this->redirect->url('admin.php?dispatch=system.extensions');
    }

    /**
     * uninstall
     *
     * @return void
     */
    public function uninstall()
    {
        $this->model->uninstall($this->requestParam['code'], $this->requestParam['extension']);

        Notification::set(Notification::TYPE_OK, 'Success', sprintf($this->language['text_extension_uninstalled'], $this->requestParam['extension']));

        $this->redirect->url('admin.php?dispatch=system.extensions');
    }
}
