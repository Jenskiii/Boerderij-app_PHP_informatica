<?php
declare(strict_types=1);

class Router
{
  private array $routes = [];

  // $handler = [Controller, functie]
  // $path = url
  // $role = access role to pages
  public function add(string $path, array $handler, $roles = ["public"]): void
  {
    $this->routes[$path] = [
      "handler" => $handler,
      "roles" => $roles
    ];

  }

  // DISPATCH
  public function dispatch(string $path): void
  {
    foreach ($this->routes as $route => $data) {

      // get handler and roles from values set in index page
      $handler = $data["handler"];
      $allowedRoles = $data["roles"];

      // MATCH URL TO ROUTE
      // convert url path into regular expression
      $pattern = preg_replace("#\{\w+\}#", "([^/]+)", $route);

      if (preg_match("#^$pattern$#", $path, $matches)) {
        array_shift($matches);


        // CHECK ACCESS, else return home
        if (!$this->hasAccess($allowedRoles)) {
          header("Location: /");
          exit;
        }

        // HANDLER
        [$controllerName, $method] = $handler;

        $controller = new $controllerName();
        call_user_func_array([$controller, $method], $matches);
        return;
      }
    }

    // if no valid page show error
    http_response_code(404);
    echo "<h1>404 Page Not Found<h1>";
  }


  // Checks if user has access based on role
  private function hasAccess(array $allowedRoles): bool
  {
    // PUBLIC = no login needed
    if (in_array("public", $allowedRoles)) {
      return true;
    }

    // Niet ingelogd = geen toegang
    if (!isset($_SESSION["user"]["rol"])) {
      return false;
    }

    // checking role
    return in_array($_SESSION["user"]["rol"], $allowedRoles);
  }
}