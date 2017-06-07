<?php

/**
 * A basic router class.
 */

class Router {
  
  // Array of routes.
  protected $routes = [];
  
  // Array of parameters, controller => to action.
  protected $params = [];

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
  
  
  /**
   * Finds a url match in routing table and sets the parameter array if true.
   * Check if this needs re-written.
   * 
   * @param string $url
   * @return boolean
   */
  public function match($url) {
    // @TODO Why not just match and return a boolean of the match.
    foreach ($this->routes as $route => $params) {
      if ($url == $route) {
        // Needed?
        $this->params = $params;
        return true;
      }
    }
    return false;
  }
  
  
  /**
   * Return the parameters array for the route.
   * 
   * @return array
   */
  public function getParams() {
    return $this->params;
  }
  
  
  
}


