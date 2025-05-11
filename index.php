<?php
require_once './vendor/autoload.php'; // Path to Composer autoloader
use core\Web;
use core\engine\init;

date_default_timezone_set('UTC'); // Replace 'Your_Timezone' with your desired timezone

// error reporting 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);

require_once 'config.php';
require_once './core/engine/init.php';
// startup call when url intialize
$router = new init();
