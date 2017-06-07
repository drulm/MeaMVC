<?php

/**
 * A basic router class.
 */

// @TODO - make a config file for these.
// Debug mode
define('DEBUG2',false);

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
public function add($route, $params = [])
  {
      // Convert the route to a regular expression: escape forward slashes
      $route = preg_replace('/\//', '\\/', $route);
      // Convert variables e.g. {controller}
      $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
      // Convert variables with custom regular expressions e.g. {id:\d+}
      $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
      // Add start and end delimiters, and case insensitive flag
      $route = '/^' . $route . '$/i';
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
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                // Get named capture group values
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }
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


