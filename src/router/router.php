<?php
declare(strict_types=1);

class Router
{
  private array $routes = [];

  // handler is [Controller, functie]
  // get url path
  public function add(string $path, array $handler): void
  {
    $this->routes[$path] = $handler;
  }

  // DISPATCH
  public function dispatch(string $path): void
  {
    foreach ($this->routes as $route => $handler) {
      // MATCH URL TO ROUTE
      // convert url path into regular expression
      $pattern = preg_replace("#\{\w+\}#", "([^/]+)", $route);

      if (preg_match("#^$pattern$#", $path, $matches)) {
        array_shift($matches);

        [$controllerName, $method] = $handler;

        $controller = new $controllerName();
        call_user_func_array([$controller, $method], $matches);
        return;
      }
    }

    // if no valid page show error
    http_response_code(404);
    echo "<h1>404 Not Found<h1>";
  }
}