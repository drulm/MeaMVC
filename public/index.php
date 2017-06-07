<?php
/**
 * A front controller.
 */

require '../Core/Router.php';

// @TODO - make a config file for these.
// Debug mode
define('DEBUG',true);


// Remove for testing, or set a DEBUG const in settings file.
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);


/**
 * Routing code.
 */

$router = new Router();

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
//$router->add('posts/new', ['controller' => 'Posts', 'action' => 'new']);
$router->add('{controller}/{action}');
$router->add('admin/{action}/{controller}');
    
if (DEBUG) {
  // Display the routing table
  echo '<pre>';
  //var_dump($router->getRoutes());
  echo htmlspecialchars(print_r($router->getRoutes(), true));
  echo '</pre>';
}


// Match the requested route
$url = $_SERVER['QUERY_STRING'];

if ($router->match($url)) {
  if (DEBUG) {
    echo '<pre>';
    var_dump($router->getParams());
    echo '</pre>';
  }
} else {
  echo "No route found for URL '$url'";
}

