<?php

/**
 * A basic router class.
 */

class Router {
  
  // Array of routes.
  protected $routes = [];

  /**
   * Add to the routing table a new route.
   * 
   * @param string $route : The URL or route
   * @param array $params : the parameters - controller / action
   * 
   * return void
   */
  public function add($route, $params = []) {
    $this->routes[$route] = $params;
  }
  
  /**
   * Return the routing table array.
   * @return array
   */
  public function getRoutes() {
    return $this->routes;
  }
  
  
}


