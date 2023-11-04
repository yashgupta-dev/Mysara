<?php

namespace core;

use app\core\Route;

/**
 * Routing
 */
Route::add('', ['controller' => 'Home', 'action' => 'index']);


// route hit
Route::dispatch();