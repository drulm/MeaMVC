<?php

/**
 * Front controller
 *
 * PHP version 5.4
 */

// Remove if needed
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

/**
 * Composer
 */
require '../vendor/autoload.php';

/**
 * Twig
 */
//require_once dirname(__DIR__) . '/vendor/twig/twig/lib/Twig/Autoloader.php';
Twig_Autoloader::register();


/**
 * Autoloader
 */
spl_autoload_register(function ($class) {
    $root = dirname(__DIR__);   // get the parent directory
    $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
    if (is_readable($file)) {
        require $root . '/' . str_replace('\\', '/', $class) . '.php';
    }
});


/**
 * Routing
 */
$router = new Core\Router();

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);
    
$router->dispatch($_SERVER['QUERY_STRING']);
