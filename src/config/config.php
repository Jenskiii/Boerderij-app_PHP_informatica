<?php
// make .env work with composer
require __DIR__ . "/../../vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

[
  'database' => [
    'host' => $_ENV["DB_HOST"],
    'port' => $_ENV["DB_PORT"],
    'dbname' => $_ENV["DB_NAME"],
    'charset' => 'utf8mb4',
  ],

  'gebruiker' => [
     'host' => $_ENV["DB_HOST"],
    'port' => $_ENV["DB_PORT"],
    'dbname' => $_ENV["DB_NAME"],
    'charset' => 'utf8mb4',
    'user' => $_ENV["DB_USER"],
    'password' => $_ENV["DB_PASSWORD"]
  ],

  'services' => [
    'prerender' => [
      'token' => '',
      'secret' => ''
    ]
  ]
];