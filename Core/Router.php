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
  
  
  /**
   * Dispatch the route, creating the controller object and running the
   * action method
   *
   * @param string $url The route URL
   *
   * @return void
   */
    public function dispatch($url)
    {
        if ($this->match($url)) {
            $controller = $this->params['controller'];
            $controller = $this->convertToStudlyCaps($controller);

            if (class_exists($controller)) {
                $controller_object = new $controller();

                $action = $this->params['action'];
                $action = $this->convertToCamelCase($action);

                if (is_callable([$controller_object, $action])) {
                    $controller_object->$action();

                } else {
                    echo "Method $action (in controller $controller) not found";
                }
            } else {
                echo "Controller class $controller not found";
            }
        } else {
            echo 'No route matched.';
        }
    }

    /**
     * Convert the string with hyphens to StudlyCaps,
     * e.g. post-authors => PostAuthors
     *
     * @param string $string The string to convert
     *
     * @return string
     */
    protected function convertToStudlyCaps($string)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    /**
     * Convert the string with hyphens to camelCase,
     * e.g. add-new => addNew
     *
     * @param string $string The string to convert
     *
     * @return string
     */
    protected function convertToCamelCase($string)
    {
        return lcfirst($this->convertToStudlyCaps($string));
    }
}
  
  


