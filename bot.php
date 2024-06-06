<?php
// bot.php
require_once 'config.php';
// Define the command-line arguments
$command = isset($argv[1]) ? $argv[1] : '';
$name = isset($argv[2]) ? $argv[2] : '';


// Check if the command is valid
if (!in_array($command, ['make:controller', 'make:model', 'make:middleware', 'make:view', 'make:language'])) {
    echo "Invalid command. Usage: php artisan [make:controller|make:model|make:middleware] [name]\n";
    exit(1);
}

// Execute the corresponding action
switch ($command) {
    case 'make:controller':
        makeController($name);
        break;
    case 'make:model':
        makeModel($name);
        break;
    case 'make:middleware':
        makeMiddleware($name);
        break;
    case 'make:view':
        makeView($name);
        break;
    case 'make:language':
        makeLanguage($name);
        break;
}

// Function to create a controller
function makeController($name)
{
    $basename = basename($name);


    $namespace = getNameSpace($name);
    $controllerTemplate = "<?php\n\n
    namespace app\controllers\\{$namespace};
    \n
    use app\controllers\BaseController;
    \n
    class {$basename}Controller  extends BaseController {\n\n
        /**
         * __construct
         *
         * @return void
         */
        public function __construct()
        {
            parent::__construct();
            \$this->executeMiddleware(\$this->requestParam, ['AuthMiddleware','PermissionMiddleware','NotificationMiddleware']);
            
        }
    \n\n
    }\n";
    $filename = APP . 'controllers/' . $name . 'Controller.php';
    createFile($filename, $controllerTemplate, "Controller {$name}Controller created successfully.");
}

function makeView($name)
{
    $viewTemplate = '
    {assign var="title" value=$lang.heading_title}

    {include file="backend/layouts/header.tpl"}
    
    {block name="backend_page"}
        <!-- Layout wrapper -->
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                {* {$menu} *}
                {block name="menu"}
                    {include file="backend/common/menu.tpl"}
                {/block}
                <!-- Layout container -->
                <div class="layout-page">
                    {block name="nav"}
                        {include file="backend/layouts/nav.tpl"}
                    {/block}
    
                    <!-- Content wrapper -->
                    <div class="content-wrapper">
                        <!-- Content -->
    
                        <div class="container-xxl flex-grow-1 container-p-y">
                            {include file="backend/common/breadcrumb.tpl" route=$smarty.request.dispatch}
    
                        </div>
                        <!-- / Content -->
    
                        <!-- Footer -->
                        {block name="footer_note"}
                            {include file="backend/layouts/footer_note.tpl"}
                        {/block}
                        <!-- / Footer -->
    
                        <div class="content-backdrop fade"></div>
                    </div>
                    <!-- Content wrapper -->
                </div>
                <!-- / Layout page -->
            </div>
    
            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
        <!-- / Layout wrapper -->
    {/block}
    
    {include file="backend/layouts/footer.tpl"}
    ';

    $filename = RESOURCES . $name . '.tpl';
    createFile($filename, $viewTemplate, "View {$name} created successfully.");
}

// Function to create a model
function makeModel($name)
{
    $basename = basename($name);
    $namespace = getNameSpace($name);
    $modelTemplate =  "<?php\n
    namespace app\model\\{$namespace};    
    \n
    use app\model\BaseModel;
    \n\n
    class {$basename}Model extends BaseModel {\n\n\n\n
        /**
         * __construct
        *
        * @return void
        */
        public function __construct()
        {
            parent::__construct();
        }

    \n\n
    }\n";
    $filename = APP . 'model/' . $name . 'Model.php';
    createFile($filename, $modelTemplate, "Model {$name}Model created successfully.");
}

// Function to create a middleware
function makeMiddleware($name)
{
    $basename = basename($name);
    $namespace = getNameSpace($name);
    $middlewareTemplate =   "<?php\n
    namespace app\controllers\middleware\\{$namespace};    
    \n
    class {$basename}Middleware {\n\n\n\n
        public function handle(\$request) {
    
            return \$request;
        }

    \n\n
    }\n";
    $filename = APP . 'controllers/middleware/' . $name . 'Middleware.php';
    createFile($filename, $middlewareTemplate, "Middleware {$name}Middleware created successfully.");
}

function makeLanguage($name)
{
    $basename = basename($name);
    $namespace = getNameSpace($name);
    $middlewareTemplate =   "<?php\n
    \n
    return [
        'heading_title' => '{$basename}'
    ];
    \n";
    $filename = RESOURCES . 'lang/' . $name . '.php';
    createFile($filename, $middlewareTemplate, "Langugae {$name} created successfully.");
}

// Function to create a file with content and provide feedback
function createFile($filename, $content, $successMessage)
{
    if (file_exists($filename)) {
        echo "File already exists.\n";
        exit(1);
    }

    if (!is_dir(dirname($filename))) {
        mkdir(dirname($filename), 0755, true);
    }

    if (file_put_contents($filename, $content) !== false) {
        echo "$successMessage\n";
    } else {
        echo "Error creating file.\n";
        exit(1);
    }
}

function getNameSpace($input)
{
    // Split the string into an array
    $parts = explode('/', $input);
    // Remove the last element
    array_pop($parts);
    // Rejoin the array into a string
    $output = implode('/', $parts);

    return str_replace('/', '\\', $output);
}
