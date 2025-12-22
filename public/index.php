<?php
session_start();
// import users
require_once "../src/helpers/auth.php";
require_once "../src/helpers/alertMessageHandler.php";
require_once "../src/helpers/handleImageUpload.php";
require_once "../src/router/router.php";
require_once "../src/MVC/controllers/HomeController.php";
require_once "../src/MVC/controllers/ProductController.php";
require_once "../src/MVC/controllers/AboutController.php";
require_once "../src/MVC/controllers/StatisticsController.php";
require_once "../src/MVC/controllers/EntrepreneursController.php";
require_once "../src/MVC/controllers/LoginController.php";
require_once "../src/MVC/controllers/ContactController.php";
require_once "../src/MVC/controllers/SlotManagementController.php";

// AUTOMATICLY LOG OFF AFTER 15 MIN
// 15 min timer
$inactivity_time = 15 * 60;
// Check if the last_timestamp is set

// then unset $_SESSION variable & destroy session data
if (isset($_SESSION['last_timestamp']) && time() - $_SESSION['last_timestamp'] > $inactivity_time) {
  session_unset();
  session_destroy();
} else {
  // Regenerate new session id and delete old one to prevent session fixation attack
  session_regenerate_id(true);
  // Update the last timestamp
  $_SESSION['last_timestamp'] = time();
}

// PATHS
// get URL
$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$router = new Router;

// PAGE ROUTES

// HOME
$router->add("/", ["HomeController", "home"], ["public"]);

// ABOUT page
$router->add("/over-ons", ["AboutController", "about"], ["public"]);

// ENTREPRENEURS page
$router->add("/ondernemers", ["EntrepreneursController", "entrepreneurs"], ["public"]);

// STATISTICS page
$router->add("/statistieken", ["StatisticsController", "statistics"], ["admin"]);

// LOGIN page
$router->add("/login", ["LoginController", "loginForm"], ["public"]);
// login validate
$router->add("/login/validate", ["LoginController", "validate"], ["public"]);
// log out
$router->add("/logout", ["LoginController", "logout"], ["public"]);

// CONTACT page
$router->add("/contact", ["ContactController", "contact"], ["public"]);

// SLOTMANAGEMENT page
$router->add("/vakkenbeheer", ["SlotManagementController", "slotManagement"], ["medewerker", "admin"]);
$router->add("/vakkenbeheer/add", ["SlotManagementController", "slotManagementAddProduct"], ["medewerker", "admin"]);
$router->add("/vakkenbeheer/delete", ["SlotManagementController", "slotManagementEmptyVak"], ["medewerker", "admin"]);
$router->add("/vakkenbeheer/edit", ["SlotManagementController", "slotManagementEditVak"], ["medewerker", "admin"]);
$router->add("/vakkenbeheer/edit/safe", ["SlotManagementController", "slotManagementEditSafe"], ["medewerker", "admin"]);

// PRODUCT page
$router->add("/product", ["ProductController", "product"], ["medewerker", "admin"]);
$router->add("/product/buy", ["ProductController", "buyProduct"], ["public"]);
$router->add("/product/add_new_product", ["ProductController", "addProduct"], ["medewerker", "admin"]);
$router->add("/product/edit/{id}", ["ProductController", "editProduct"], ["medewerker", "admin"]);
$router->add("/product/delete", ["ProductController", "deleteProduct"], ["medewerker", "admin"]);
$router->add("/product/safe_edit", ["ProductController", "safeEditProduct"], ["medewerker", "admin"]);


// sends url to dispatch
$router->dispatch($path);