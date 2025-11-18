<?php
require_once "../src/router/router.php";
require_once "../src/MVC/controllers/HomeController.php";
require_once "../src/MVC/controllers/ProductController.php";
require_once "../src/MVC/controllers/AboutController.php";
require_once "../src/MVC/controllers/StatisticsController.php";
require_once "../src/MVC/controllers/EntrepreneursController.php";
require_once "../src/MVC/controllers/LoginController.php";
require_once "../src/MVC/controllers/ContactController.php";


// get URL
$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);


$router = new Router;
// PAGE ROUTES
// home
$router->add("/", ["HomeController", "home"]);

// about page
$router->add("/over-ons", ["AboutController", "about"]);

// entrepreneurs page
$router->add("/ondernemers", ["EntrepreneursController", "entrepreneurs"]);

// statistics page
$router->add("/statistieken", ["StatisticsController", "statistics"]);

// login page
$router->add("/login", ["LoginController", "login"]);

// contact page
$router->add("/contact", ["ContactController", "contact"]);

// product page
$router->add("/product/{id}", ["ProductController", "product"]);

// handle product payment
$router->add("/product/buy/{id}", ["ProductController", "buyProduct"]);

// sends url to dispatch
$router->dispatch($path);