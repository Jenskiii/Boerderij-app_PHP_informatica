<?php
//  checks user
function user()
{
  return $_SESSION["user"] ?? null;
}
// check if logged in 
function isLoggedIn()
{
  return isset($_SESSION["user"]);
}

// check if employee
function isEmployee()
{
  return isset($_SESSION["user"]) && $_SESSION["user"]["rol"] === "medewerker";
}

// checks if admin
function isAdmin()
{
  return isset($_SESSION["user"]) && $_SESSION["user"]["rol"] === "admin";
}


// check if request is POST
function isPosted(string $redirect = '/?error=no_post'): void
{
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: $redirect");
    exit;
  }
}

