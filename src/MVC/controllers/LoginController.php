<?php
require_once "../src/MVC/models/UserModel.php";
class LoginController
{
  public function loginForm(): void
  {
    // JS link
    $jsLink = "form.js";

    require_once "../src/MVC/views/login.php";
  }




  // HANDLE LOGIN
  public function validate()
  {
    // login credentials / if set then form values / else empty
    $username = $_POST['login_username'] ?? '';
    $password = $_POST['login_password'] ?? '';


    // find user in db
    $userModel = new UserModel();
    $user = $userModel->findUsername($username);

    // Succes? bind params to user
    if ($user && password_verify($password, $user['wachtwoord'])) {

      $_SESSION['user'] = [
        'id' => $user['id'],
        'username' => $user['gebruikersnaam'],
        'rol' => $user['rol']
      ];

      // return to home
      header("Location: /");
      exit;


      // Fail? show error
    } else {
      $_SESSION['login_error'] = "Gebruikersnaam of wachtwoord is verkeerd.";
      header("Location: /login");
      exit;
    }
  }


  // LOGOUT
  public function logout(): void
  {
    // delete session data
    session_unset();
    // destroy session
    session_destroy(); 
    // redirect to home
    header("Location: /"); 
    exit;
  }
}