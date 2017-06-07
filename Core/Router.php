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
    public function match($url)
    {
        /*
        foreach ($this->routes as $route => $params) {
            if ($url == $route) {
                $this->params = $params;
                return true;
            }
        }
        */

        // Match to the fixed URL format /controller/action
        $reg_exp = "/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/";

        if (preg_match($reg_exp, $url, $matches)) {
            // Get named capture group values
            $params = [];

            foreach ($matches as $key => $match) {
                if (is_string($key)) {
                    $params[$key] = $match;
                }
            }

            $this->params = $params;
            return true;
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


