<?php
class LoginController
{
  public function login(): void
  {
    $title = "Login";
    $content = "This is the login page. Here you can write details about your company.";
    require_once "../src/MVC/views/login.php";
  }
}