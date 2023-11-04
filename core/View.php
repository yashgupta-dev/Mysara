<?php

/** in core php view file syntax */
// $this->view->view('frontend/index');
// $this->view->assign([
//     'title' => 'Home Page'
// ]);  
// $this->view->renderTemplate();
/** end */

namespace core;

class View
{
    /**
     * data
     *
     * @var array
     */
    private $data = [];

    /**
     * render
     *
     * @var bool
     */
    private $render = false;

    /**
     * view
     *
     * @var string
     */
    protected $view = RESOURCES;

    public function __construct()
    {
        session_start();
    }

    public function view($template)
    {
        $file = $this->view . strtolower($template) . '.php';
        if (file_exists($file)) {
            return $this->render = $file;
        } else {
            die('404 page not found');
        }
    }

    public function assign($assign = [])
    {
        return $this->data = $assign;
    }

    public function renderTemplate()
    {
        if (!$this->render) {
            return; // No template to render
        }

        extract($this->data);
        ob_start();
        include $this->render;
        echo ob_get_clean();
    }

    public function setError($errors)
    {

        $_SESSION['errors'] = $errors;
    }

    public function getError()
    {

        if (!empty($_SESSION['errors'])) {
            $errors = $_SESSION['errors'];
            unset($_SESSION['errors']);
            return $errors;
        }
    }
}
