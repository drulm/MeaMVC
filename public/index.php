<?php
/**
 * A front controller.
 */


// Remove for testing, or set a DEBUG const in settings file.
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);


// echo "Url specified: [" . $_SERVER['QUERY_STRING'] . "]";

require '../Core/Router.php';


/**
 * Routing code.
 */

$router = new Router();

$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
$router->add('posts/new', ['controller' => 'Posts', 'action' => 'new']);

echo '<pre>';
var_dump($router->getRoutes());
echo '<pre>';
