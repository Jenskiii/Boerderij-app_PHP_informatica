<?php
require_once "../src/config/database.php";
class SlotManagement
{
  
  // DB
  private $pdo;
  public function __construct()
  {
    $db = new Database();
    $this->pdo = $db->getConnection();
  }
}