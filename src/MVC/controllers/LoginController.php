<?php
class LoginController
{
  public function login(): void
  {
    // JS link
    $jsLink = "form.js";
    require_once "../src/MVC/views/login.php";
  }
}