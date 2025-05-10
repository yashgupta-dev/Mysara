<?php

namespace app\controllers\backend\Catalog;

use app\core\Json;
use app\core\Tygh;
use app\core\Response;
use app\core\Notification;
use app\controllers\BaseController;
use app\core\validation\Validation;
use app\model\Backend\CategoryModel;

class Category extends BaseController
{
    
    /**
     * error
     *
     * @var array
     */
    public $error = [];

    /**
     * __construct
     *
     * @param  mixed $mode
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->executeMiddleware($this->requestParam, ['AuthMiddleware','PermissionMiddleware']);
        
        $this->model = new CategoryModel;

    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        list($results, $search) = $this->model->categories($this->requestParam);
        
        Tygh::assign('search',$search);
        Tygh::assign('lists',$results);
        Tygh::display('backend/catalog/category/list');

    }
    
    /**
     * add
     *
     * @return json
     */
    public function add() {

        if ($this->requestMethod === 'POST') {
            Validation::validate([
                'name'          =>  'required|string',
                'description'   =>  'string',
                'meta_title'    =>  'required|string',

            ], $this->requestParam['category_description']);

            // get errors
            if (Validation::getErrors() !== true) {

                foreach (Validation::getErrors() as $key => $value) {
                    $this->error[$key] = $value;
                }
                if (isset($this->requestParam['is_ajax'])) {
                    $response = ['errors' => $this->error];
                }
            } else {
                $res = $this->model->updateCategory($this->requestParam);
                if ($res) {
                    
                    Notification::set(Notification::TYPE_OK, 'Success', $this->language['text_success']);

                    $response = ['success' => true, 'redirect_url' => $this->redirect->link('admin.php?dispatch=catalog.category.update&category_id='.$res)];
                } else {
                    $response = ['errors' => sprintf($this->language['text_error'],'create category')];
                }
            }

            Response::json(Json::encode($response));
        }
        
        Tygh::display('backend/catalog/category/update');
    }

    public function update() {
        if ($this->requestMethod === 'POST') {
            Validation::validate([
                'name'          =>  'required',
                'meta_title'    =>  'required'
            ], $this->requestParam['category_description']);

            // get errors
            if (Validation::getErrors() !== true) {

                foreach (Validation::getErrors() as $key => $value) {
                    $this->error[$key] = $value;
                }
                if (isset($this->requestParam['is_ajax'])) {
                    $response = ['errors' => $this->error];
                }
            } else {

                $res = $this->model->updateCategory($this->requestParam);
                if ($res) {
                    
                    Notification::set(Notification::TYPE_OK, 'Success', $this->language['text_success']);

                    $response = ['success' => true, 'redirect_url' => $this->redirect->link("admin.php?dispatch=catalog.category.update&category_id={$this->requestParam['category_id']}")];
                } else {
                    $response = ['errors' => sprintf($this->language['text_error'],'update category')];
                }
            }

            Response::json(Json::encode($response));
        }
        $category_id = !empty($this->requestParam['category_id']) ? $this->requestParam['category_id'] : 0;
        
        if (isset($this->requestParam['category_description'])) {
			$data['category_description'] = $this->requestParam['category_description'];
		} elseif (isset($this->requestParam['category_id'])) {
			$data['category_description'] = $this->model->category(['category_id' => $category_id]);
		} else {
			$data['category_description'] = [];
		}

        if (isset($this->requestParam['seo_url'])) {
			$data['seo_url'] = $this->requestParam['seo_url'];
		} elseif (isset($this->requestParam['category_id'])) {
			$data['seo_url'] = $this->common->getSeoUrlsByQuery("category_id=$category_id");
		} else {
			$data['seo_url'] = '';
		}

        Tygh::assign('category_description', $data['category_description']);
        Tygh::assign('seo_url', $data['seo_url']);
        
        Tygh::assign('category_id', $category_id);
        Tygh::display('backend/catalog/category/update');
    }
}