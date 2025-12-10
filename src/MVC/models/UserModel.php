<?php
require_once "../src/config/database.php";
class UserModel
{
  private $pdo;
  public function __construct()
  {
    // connection
    $db = new Database();
    $this->pdo = $db->getConnection();
  }

  public function findUsername(string $username)
  {
    // query
    $stmt = $this->pdo->prepare("SELECT * FROM gebruikers WHERE gebruikersnaam = ?");
    // bind param
    $stmt->execute([$username]);
    // return
    return $stmt->fetch();
  }
}