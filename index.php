<?php
use core\engine\init;
use core\Web;
// use core\engine\Startup;

// error reporting 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config.php';
require_once './core/engine/init.php';

// startup call when url intialize
$router = new init();